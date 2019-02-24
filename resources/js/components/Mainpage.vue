<template>
	<div class='contain'>
		<div id="addpost">
            <div class="newone">
            <div id="loadingpic">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
                <form id="uploadimage" enctype="multipart/form-data">
                    <textarea id="ucmnt" name='cmnt' v-model="cmnt" maxlength='200' placeholder="add a caption..."></textarea>
                    <div style="position:absolute; top:135px; left:0; width:50%; height:30px; text-align:center; border-right:solid 1px #2c3e50; padding-top:10px;"><a>Upload Image</a></div>
                    <input ref="myFileInput" id="file" type="file" name='image' @change="onFileChange" accept="image/*" required>
                    <div style="position:absolute; top:135px; right:0; width:50%; height:30px; text-align:center; padding-top:10px;"><a>Post</a></div>
                    <button id="postpic" @click.prevent="upload" value='Post' class='submit' ></button>
                    <!--<div id="message" style="position:absolute; top:-19px; left:150px; width:496px; height:15px; background:white; padding:2px; text-align:center;"></div>-->
                </form>
            </div>
        </div>
        
        <div id='menu' class='menu'>
        	<transition-group name="list">
            <div v-for="postDetails in posts" v-bind:key="postDetails.id" class='post'>
                <div id='user'><img :src="postDetails.avatar" /><a :id="'user'+ postDetails.user_id" :href="'user/' + postDetails.user_name">{{postDetails.user_name}}</a></div>
                <div class='postm'>
                    <p>{{postDetails.cmnt}}</p>
                    <div class="thumbnail"><img :id="'pre ' + postDetails.id" :src='mainUrl+"/design/imgs/loading.gif"' v-on:click="popup('popUpDiv',postDetails.piclink);" v-on:load="loadmyimg(postDetails.piclink,postDetails.id);"/></div>
                    <div class="actions">
                        <div :class="[{happy: postDetails.liked , broken: !postDetails.liked}]" @click="love(postDetails,postDetails.id,postDetails.user_id)" class="heart" :id="'heart' + postDetails.id"><i class="fa fa-heart"></i></div>
                        <div :id="postDetails.id" class="postlikes">{{postDetails.like_count}} Likes</div>
                    </div>
                </div>
            </div>
        	</transition-group>
        	<div v-show="loadMore" class='loadmore' id="morebtn"><button @click='loadmore()'>Load More</button></div>
            <h1 v-show="noPic" id='nocmnt' class='nocmnt'>No Pictures Yet.</h1>
        </div>

    </div>
</template>

<script>
	export default {
        data(){
            return{
            token : localStorage.getItem('access_token'),
            image:null,
            cmnt:'',
            loadMore:false,
            noPic:false,
            selectedFile:{
            	name:'',
            },
            posts:[],
            postDetails:{
                id:'',
                user_id:'',
                piclink:'',
                cmnt:'',
                like_count:'',
				user_name:'',
				avatar:'',
				liked:false,
            },
            current_page:1,
            last_page:1,
            next_page_url:'',
            lastPost:1,
            }
        },
        created() {
		    this.getAllNews();
		    this.getNew();
		},
        methods:{
        	//start to upload post images
        	onFileChange(event) {
                this.selectedFile = event.target.files[0]
            },
            upload(){
	            if (this.selectedFile.name != ''){
	                document.getElementById("loadingpic").style.display = 'block'
	                const fd = new FormData();
	                fd.append('image',this.selectedFile,this.selectedFile.name)
	                fd.append('cmnt',this.cmnt)
	                axios.post(this.mainUrl+'/new_post',fd)
	                .then(response => {
	                	var result = response.data.status
	                	var newPost = response.data.data
	                	if (result == true){
	                		this.noPic = false
	                		this.$refs.myFileInput.type = 'text';
	                		this.$refs.myFileInput.type = 'file';
	      					this.selectedFile = { name:''}
	                		this.cmnt = ''
	                		document.getElementById("loadingpic").style.display = 'none'
	                		this.posts.unshift({
	                			"id": newPost.id, 
	                			"user_id": newPost.user_id, 
	                			"piclink": newPost.piclink,
	                			"cmnt": newPost.cmnt,
	                			"like_count": newPost.like_count,
	                			"user_name": newPost.user_name,
	                			"avatar": newPost.avatar
	                		});
	                	}else{
	                		console.log(reponse)
	                	}
	                });
	            }
            },
            //get news update
	        getNew(){
	            let vm = this;
	            setInterval(() => {
		            axios.get(this.mainUrl+'/getfrom/'+this.lastPost)
		            .then((response) => {
		            var result = response.data.status
		            if(result == true){
		                var newPosts = response.data.data
		                this.posts.unshift(...newPosts);
		                this.lastPost = newPosts[0].id
		            }
		            })
		        }, 60000);
	        },
	        //get all news in main page
	        getAllNews(){
		     	let vm = this;
		     	axios.get(this.mainUrl+'/getnews')
			    .then((response) => {
			    var result = response.data.data.total
				    if(result === 0){
				    	this.noPic = true
				    }else if(result > 0){
				    	this.lastPost = response.data.data.data[0].id
				    	this.posts = response.data.data.data
				    	this.current_page = response.data.data.current_page
				    	this.last_page = response.data.data.last_page
				    	this.next_page_url = response.data.data.next_page_url
				    	response.data.data.last_page == 1?this.loadMore = false:this.loadMore = true
				    }else{
		                console.log(reponse)
		            }
				})
	        },
	        //load more pics
	        loadmore(){
	        	if(this.current_page == this.last_page){
	        		this.loadMore = false
	        	}else{
			     	axios.get(this.next_page_url)
				    .then((response) => {
				    	var result = response.data.data.data
				    	this.current_page = response.data.data.current_page
				    	this.last_page = response.data.data.last_page
				    	this.next_page_url = response.data.data.next_page_url
				    	this.posts.push(...result);
				    	if(this.current_page == this.last_page){
	        				this.loadMore = false
	        			}
				    })
	        	}
	        },
	        //to send data for like unlike
	        love(postDetails,id,reciver_id){
	        	this.postDetails.liked = postDetails.liked
	        	this.postDetails.like_count = postDetails.like_count
	        	let vm = this;
		     	axios.post(this.mainUrl+'/like',{id:id,reciver_id:reciver_id})
			    .then((response) => {
			    var result = response.data.status
			    var newCounter = response.data.newCounter
				    if(result == 1){
				    	postDetails.liked = false
				    	postDetails.like_count = newCounter
				    }else if(result == 0){
				    	postDetails.liked = true
				    	postDetails.like_count = newCounter
				    }else{
		                console.log(result)
		            }
				})
	        },

	        //javascript functions
	        loadmyimg : function(link,pl) {
	        	document.getElementById('pre '+pl).src = link
				document.getElementById('pre '+pl).setAttribute("id", "pre")
	        },
	        toggle: function (div_id) {
				var el = document.getElementById(div_id);
				if ( el.style.display == 'none' ) {	el.style.display = 'block';}
				else {el.style.display = 'none';}
			},
			popup:function (windowname,link) {
				var video = document.getElementById('popimg');
				blanket_size(windowname);
				window_pos(windowname);
				toggle('blanket');
				toggle(windowname);
				video.setAttribute("src", link);
			},
	        //end of javascript functions

        },
        mounted() {
        }
    }
</script>