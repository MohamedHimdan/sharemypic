<template>
    <div class='loginbox' id='box'>
        <form >
            <input id="username" type="text" name="username" v-model="loginDetails.username" placeholder="Username" required autofocus>
            <input id="password" type="password" v-model="loginDetails.password" name="password" placeholder="Password" required>
            <label>
                <input type="checkbox" v-model="loginDetails.remember" id='rememberme' name="rememberme" > Remember Me
            </label>
            <button type="submit" @click.prevent="loginPost" class="button button--aylen button--border-thick button--inverted button--text-upper button--size-s">Login!</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
            loginDetails:{
                username:'',
                password:'',
                remember:true
            },
            
            }
        },
        methods:{
        loginPost(){
            let vm = this;
            axios.post(this.mainUrl+'/login', this.loginDetails)
            .then(function (response) {
            var result = response.data.status
            if(result == false){
                document.getElementById("username").style.border = "2px solid #f64747"
                document.getElementById("password").style.border = "2px solid #f64747"
                document.getElementById("password").value = ""
            }else if(result == true){
                //console.log(response)
                //const token = response.data.access_token
                //localStorage.setItem('access_token',token)
                window.location = goUrl
            }else{
                //console.log(response.data.access_token)
            }
            })
            .catch(function (error) {
                console.log(error)
            });
        }
        },
        mounted() {
        }
    }
</script>
