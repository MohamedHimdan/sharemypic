<template>
<div id='contain'>
	<div id='scrollnothig' style="position:relative; height:1px; left:0; top:0; margin:0; padding:0; width:100%;"></div>
	<div id="headeru" class="headeru">
		<div id='totop' class='totop'><img class='to-top' :src='mainUrl+"/public/design/imgs/icon-top.png"'/></div>
		<div id="logoimg"><img :src='mainUrl+"/public/design/imgs/logo.png"' width="26" height="35"><span class="logotxt" style="color:#2ecc71;">h<font color="#e74c3c">4</font><font color="#ecf0f1">r</font><font color="#f1c40f">e </font><font color="#3498db">M</font><font color="#e67e22">y </font><font color="#bdc3c7">P</font><font color="#9b59b6">!</font><font color="#1abc9c">c</font></span></img></div>
		<form id="userinfo">
			<a style="text-decorAtion:none; margin-right:20px;" :href='mainUrl'><i class="fa fa-home fa-fw" style="font-size:30px;"></i></a>
			<a style="text-decorAtion:none; margin-right:20px;" @click.prevent="getNoti" id='noti_Button'><div id='noti_counter' class="noti_Counter">2</div><i class="fa fa-bell" style="font-size:23px; margin-top:7px;"></i></a>
			<a style="text-decorAtion:none; margin-right:20px;" :href="mainUrl+'/user/'+user.username"><i class="fa fa-user" style="font-size:26px; margin-top:5px;"></i></a>
			<a @click="settings" style="text-decorAtion:none;"><i class="fa fa-ellipsis-v" style="font-size:26px; margin-top:5px;"></i></a>
			<a @click.prevent="logout" style="text-decorAtion:none;"><i class="fa fa-sign-out" style="font-size:26px; margin-top:5px;"></i></a>
		</form>
	</div>
	<div v-show="notiActive" id="notifications">
		<h3>Notifications</h3>
		<div class="noti_cont">
			<div class="new_noti">
				<div v-for="notiDetails in notifications" v-bind:key="notiDetails.id" id="newnoti">
					<div id="imgusr"><img v-bind:src="notiDetails.avatar"/></div>
					<p>{{notiDetails.liker_id}} Liked your photo</p>
					<div id="imgliked"><img :src="notiDetails.img"/></div>
				</div>
			</div>
			<h1 id="notiPanel" style="cursor:default; color:rgba(100,100,100,0.3); margin-top:70px; font-size:30px;"></h1>
		</div>
	</div>
	<div v-show="ifSettings" id="settings">
		<div class="settings_cont">
			<div class="list">
				<div id="choose">
					<a :href='mainUrl+"/restapi"'>API</a>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
	export default {
        data(){
            return{
	            user:{
	            	username:'',
	            },
	            notifications:[],
	            notiDetails:{
	                id:'',
	                liker_id:'',
	                post_id:'',
	                avatar:''
	            },
	            notiActive:false,
	            ifSettings:false,
            }
        },
        created() {
		    this.get_info();
		    this.getNoti_counter();
		},
        methods:{
        	get_info(){
        		let vm = this;
		     	axios.get(this.mainUrl+'/loggedUser')
			    .then((response) => {
			    var result = response.data
					this.user = result
				})
        	},
	        logout(){
	        	let vm = this;
	            axios.post(this.mainUrl+'/logout','')
	            .then(function (response) {
	            	window.location = goUrl+"/login"
	            })
	            .catch(function (error) {
	                console.log(error)
	            });
	        },
	        getNoti_counter(){
	            let vm = this;
	            setInterval(() => {
		            axios.get(this.mainUrl+'/noti_counter')
		            .then((response) => {
		            var result = response.data.status
		            if(result == false){
		                document.getElementById("noti_counter").innerHTML = 0
		                document.getElementById("noti_counter").style.opacity = '0'
		            }else if(result == true){
		                document.getElementById("noti_counter").innerHTML = response.data.data
		                document.getElementById("noti_counter").style.opacity = '1'
		            }else{
		                console.log(reponse)
		            }
		            })
		            .catch(function (error) {
		                console.log(error)
		            });
		        }, 5000);
	        },
	        getNoti(){
	        	if (this.notiActive === false){
		        	this.ifSettings = false
		        	this.notiActive = true
		        	let vm = this;
		        	axios.get(this.mainUrl+'/noti_get')
			        .then((response) => {
			        var result = response.data.status
				        if(result == false){
				            this.notifications = []
				            document.getElementById("notiPanel").innerHTML = 'Nothing new.'
				        }else if(result == true){
				        	this.notifications = response.data.data
				        	document.getElementById("notiPanel").innerHTML = ''
				        }else{
				            console.log(reponse)
				        }
				    })
				    axios.post(this.mainUrl+'/noti_update')
			        .then((response) => {
			        	document.getElementById("noti_counter").style.opacity = '0'
				    })
				    .catch(function (error) {
				        console.log(error)
				    });
				}else{
				    this.notiActive = false
				}
	        },
	        settings(){
	        	if (this.ifSettings === false){
		        	this.notiActive = false
		        	this.ifSettings = true
				}else{
				    this.ifSettings = false
				}
	        }
        },
        mounted() {
        }
    }
</script>