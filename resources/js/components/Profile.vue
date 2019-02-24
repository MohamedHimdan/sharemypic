<template>
	<div class='contain'>
		<div id="blanketimg" style="display:none;" onclick="editimg('editmyimg');"></div>
		<div id="editmyimg" style="display:none;">
		<div id="loadingupdate">
			<div class="spinner">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div>
			<form id="updateimage" enctype="multipart/form-data" >
				<div class="coverof"><div class="imghere"><h1>Preview image</h1></div><img id="previewing" :src="myImage" /></div>
				<div style="position:absolute; top:500px; left:10px; width:240px; height:30px; text-align:center; border-right:solid 1px #2c3e50; padding-top:10px;"><a>Choose Photo</a></div>
				<input id="editfile" type="file" name="file" ref="myFileInput" @change="onFileChange" accept="image/*" required/>
				<div style="position:absolute; top:500px; right:10px; width:240px; height:30px; text-align:center; padding-top:10px;"><a>Update Profile</a></div>
				<button @click.prevent='update' id="editpic" class='submit' ></button>
				<!--<div id="message" style="position:absolute; top:-19px; left:150px; width:496px; height:15px; background:white; padding:2px; text-align:center;"></div>-->
			</form>
		</div>
		<div v-show="ifProfile" class="profileinfo">
			<div id="moreback"></div>
			<div class="userimg">
				<div v-show="ifUser" id="editcont"><div id="editurpic" onclick="editimg('editmyimg');"><a>Edit</a></div></div>
				<img :src="userDetails.avatar" v-on:click="popup('popUpDiv',userDetails.avatar);" width='160' height='160'/></div>
			<h1>{{userDetails.username}}</h1>
			<div id="postcount"><a>{{userDetails.posts}} Posts</a></div>
			<div id="usersocial"><a>Social Here</a></div>
		</div>

		<div v-show="ifProfile" class='userposts'>
			<transition-group name="list">
				<div v-for="picsDetails in pics" v-bind:key="picsDetails.id" class="imagespost">
					<img :src="picsDetails.piclink" v-on:click="popup('popUpDiv',picsDetails.piclink);" />
				</div>
			</transition-group>
			<h1 v-show="!ifPics" class='noposts'>No Posts.</h1>
			<div v-show="loadMore" class='loadmore' id='morebtn'><button @click='loadmore()'>Load More</button></div>
		</div>
		<h1 v-show="!ifProfile" class='noprofile'>Cannot Find This User.</h1>
	</div>
</template>

<script>
	export default {
        data(){
            return{
            myImage:"",
            image:null,
            loadMore:false,
            selectedFile:{
            	name:'',
            },
            pics:[],
            picsDetails:{
                id:'',
                piclink:'',
            },
            userDetails:{
                id:'',
                username:'',
                avatar:'',
                posts:'',
            },
            current_page:1,
            last_page:1,
            next_page_url:'',
            lastPost:1,
            ifProfile:true,
            ifPics:false,
            ifUser:false,
            }
        },
        created() {
		    this.get_user();
		    this.get_pics();
		},
        methods:{
        	onFileChange(event) {
                this.selectedFile = event.target.files[0]
                this.myImage = URL.createObjectURL(event.target.files[0])
            },
            update(){
	            if (this.selectedFile.name != ''){
	                document.getElementById("loadingupdate").style.display = 'block'
	                const fd = new FormData();
	                fd.append('image',this.selectedFile,this.selectedFile.name)
	                axios.post(this.mainUrl+'/updatePic',fd)
	                .then(response => {
	                	var result = response.data.status
	                	if (result == true){
	                		this.$refs.myFileInput.type = 'text';
	                		this.$refs.myFileInput.type = 'file';
	      					this.selectedFile = {name:''}
	                		document.getElementById("loadingupdate").style.display = 'none'
	                		document.getElementById("blanketimg").style.display = 'none'
	                		document.getElementById("editmyimg").style.display = 'none'
	                		this.userDetails.avatar = response.data.new_link
	                	}else{
	                		console.log(reponse)
	                	}
	                });
	            }
            },
        	get_user(){
        		var id = window.location.href.split('/').pop();
        		let vm = this;
		     	axios.get(this.mainUrl+'/get_info/'+id)
			    .then((response) => {
			    var result = response.data.result
				    if(result === true){
				    	this.userDetails = response.data.data
				    	this.ifUser = response.data.data.loggedUser
				    	this.ifProfile = true
				    }else{
		                this.ifProfile = false
		            }
				})
        	},
        	get_pics(){
        		var id = window.location.href.split('/').pop();
        		let vm = this;
		     	axios.get(this.mainUrl+'/get_pics/'+id)
			    .then((response) => {
			    var result = response.data.status
				    if(result === true){
				    	this.pics = response.data.data.data
				    	this.ifPics = true
				    	this.current_page = response.data.data.current_page
				    	this.last_page = response.data.data.last_page
				    	this.next_page_url = response.data.data.next_page_url
				    	response.data.data.last_page == 1?this.loadMore = false:this.loadMore = true
				    }else if(result === false){
		                this.ifPics = false
		            }else{
		            	this.ifProfile = false
		            }
				})
        	},
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
				    	this.pics.push(...result);
				    	if(this.current_page == this.last_page){
	        				this.loadMore = false
	        			}
				    })
	        	}
	        },

        	popup:function (windowname,link) {
				var video = document.getElementById('popimg');
				blanket_size(windowname);
				window_pos(windowname);
				toggle('blanket');
				toggle(windowname);
				video.setAttribute("src", link);
			},
        },
    }
</script>