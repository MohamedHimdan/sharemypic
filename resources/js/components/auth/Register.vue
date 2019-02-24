<template>
    <div class='loginbox' id='box'>
        <form>
            <input type='text' id='username' name='username' maxlength="12" v-model="registerData.username" placeholder="Username" required autofocus>
            <input type='text' id='email' name='email' maxlength="50" v-model="registerData.email" placeholder="E-mail" required>
            <input type='password' id='password' name='password' v-model="registerData.password" placeholder="Password" required>
            <input type='password' id='password_confirmation' name='password_confirmation' v-model="registerData.password_confirmation" placeholder="Confirm password" required>
            <button id="login" @click.prevent="registerPost()" class="button button--aylen button--border-thick button--inverted button--text-upper button--size-s">Register</button>
        </form>
    </div>

</template>

<script>
    export default {
        data(){
            return{
            registerData:{
                username:'',
                email:'',
                password:'',
                password_confirmation:''
            },
            }
        },
        methods:{
        registerPost(){
            let vm = this;
            axios.post(this.mainUrl+'/register', this.registerData)
            .then(function (response) {
            var result = response.data
            if(result.status == true){
                window.location = goUrl+'/login'
            }
            })
            .catch(function (error) {
                var errors = error.response
                if(errors.statusText === 'Unprocessable Entity'){
                    if(errors.data.errors){
                        if(errors.data.errors.username){
                           document.getElementById("username").style.border = "2px solid #f64747"
                        }else{
                            document.getElementById("username").style.border = "2px solid #2ecc71"
                        }
                        if(errors.data.errors.email){
                           document.getElementById("email").style.border = "2px solid #f64747"
                        }else{
                            document.getElementById("email").style.border = "2px solid #2ecc71"
                        }
                        if(errors.data.errors.password){
                           document.getElementById("password").style.border = "2px solid #f64747"
                        }else{
                            document.getElementById("password").style.border = "2px solid #2ecc71"
                        }
                        if(errors.data.errors.password_confirmation){
                           document.getElementById("password_confirmation").style.border = "2px solid #f64747"
                        }else{
                            document.getElementById("password_confirmation").style.border = "2px solid #2ecc71"
                        }
                    }
                }
            });
        }
        },
        mounted() {
        }
    }
</script>
