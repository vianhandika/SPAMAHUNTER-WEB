import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes'

import axios from 'axios';
import VueAxios from 'vue-axios';

import App  from './components/App'
// import index from './components/Index'
import Controller from './httpController'

// es modules
import Editor from '@tinymce/tinymce-vue';

Vue.use(VueRouter)
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://localhost:8000/api';

const router = new VueRouter({
    mode: 'history',
    routes,
});

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
 });

// const app = new Vue({
//     el: '#app',
//     components: { App },
//     router,
// });
Vue.component('loginform', {
    template:
    `
        <div class="col-5" >
            <div class="homeLogin container  h-75 text-center ">
            <h1 class="mt-5">SIGN IN</h1>
            <h6>Sign in to continue to member page</h6>

            <div class="bg-danger text-white" 
            v-if="error.failedLogin"> 
                {{ errorMessage }} 
            </div>
                <form autocomplete="off" @submit.prevent="login" id="login" method="POST">
                    <div class=" form-inline justify-content-center mt-5 mb-4 ">
                        <input type="text" class="form-control w-75" v-model="username"  placeholder="Enter username" required>
                        <input type="password" class="form-control  mt-2 w-75" v-model="password"  placeholder="Password" required>
                        <button type="submit" class="btnLogin btn btn-primary  mt-4 w-75 font-weight-bold">SIGN IN</button>
                    </div>
                </form>
        
            </div>
        </div>
    `,
    props: {
        value : {
            type : Boolean,
            required : true,
        }
    },
    data() {
        return{
            username : '',
            password : '',
            user:[],
            error : {
                failedLogin : false,
            },
            errorMessage : 'Username & Password Not Found',
        }
    },
    methods:{
        async login(){

            var app = this
            try{
                this.user=await Controller.getuserbylogin(this.username)
                if(this.user != null)
                {
                    if(this.user.status==0)
                    {
                        this.errorMessage = "Please Verify Your Email First"
                        return this.error.failedLogin= true
                    }
                    else{
                        this.$auth.login({
                            params: {
                                username: app.username,
                                password: app.password
                            }, 
                            success: function () {
                                this.error.failedLogin = false
                            },
                            error: function (resp) {
                                this.error.failedLogin = "Username & Password Not Found"
                                this.error.failedLogin = true
                            },
                            rememberMe: true,
                            redirect: '/user',
                            fetchUser: true,
                        });     
                    }
                }
                else{
                    this.errorMessage = "Username & Password Not Found"
                    this.error.failedLogin= true    
                }    
            } catch(err){
                this.errorMessage = "Username & Password Not Found"
                this.error.failedLogin= true
            }
                    

        },
        // async authenticate () {
        //     try {
        //         await Controller.authenticate(this.username, this.password)
        //         this.$emit('input', true)
        //         this.error.failedLogin = false
        //         // this.$parrent.close()
        //         this.$router.push({ path: "/user"})
        //         // window.location = "/user"
        //     } catch (err) {
        //         this.error.failedLogin = true
        //     }
        // }
        
    }
    
});

Vue.component('signupform', {
    template:
    `   
    <div id="signup">
        <div class="container-fluid h-100" >
        <div class="subTitle pt-5 pl-5 pb-5">
            <h2 class="font-weight-bold">Sign <u>Up</u></h2>
        </div>
        <div class="text-center mt-2">
            <h2 class="sublineTitle">Something Special is <u>Coming</u></h2>
            <h2>Join Now</h2>
            <div class="form-inline justify-content-center">
                
                <div class="formregister container w-25 form-inline justify-content-center mt-5 mb-4 ">
                    
                    <div class="bg-danger text-white w-75"
                    v-if="alert.on && !alert.status"> 
                        {{ alert.message }} 
                    </div>
                    <div class="bg-success text-white w-75" 
                    v-if="alert.on && alert.status"> 
                        {{ alert.message }} 
                    </div>
                    <form @submit.prevent="register">
                        <input v-model="username" type="text" class="form-control  mt-2 w-75" name="username" placeholder="Username" required>
                        <input v-model="email" type="email" class="form-control mt-2 w-75" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <input v-model="password"  minlength="6" type="password" class="form-control  mt-2 w-75" name="password" placeholder="Password" required>
                        <input v-model="cmfpassword" minlength="6" @keyup="passwordCheck" type="password" class="form-control  mt-2 w-75" name="cmfpassword" placeholder="Confirm Password" required>
                        <button type="submit" class="btnSignup btn btn-warning mt-5 w-50 font-weight-bold" name="signup">SIGN UP</button>
                    </form>   
                    </div>
            </div>
        </div>
        </div>
    </div>
        `,
    data() {
        return{
            username : '',
            email    : '',
            password : '',
            cmfpassword : '',
            alert : {
                on      : false,
                status  : false,
                message : '',
            },
            errorMessage : 'Username / Email Already Registered',
            successMessage : 'Success Register Please Check Your Email',
            createduser:[],
        }
    },
    methods:{
        passwordCheck () {
            if (this.password !== this.cmfpassword) {
                this.alert.on = true
                this.alert.status = false
                this.alert.message = 'Confirmation Password Doesnt Match'
                return this.alert
            }

            this.alert.on = false
            this.alert.status = false
            this.alert.message = ''
            return this.alert
        },
        async register () {
        // register () {
            if(this.password != this.cmfpassword){
                this.alert.message = "Confirmation Password Doesnt Match"
                this.alert.on = true
                this.alert.status = false
            }else{
                try {
                    this.createduser= await Controller.register(this.username, this.email, this.password)

                    const response = await Controller.addprofile(this.createduser.data.id)
   
                    this.alert.on = true
                    this.alert.status = true    
                    this.alert.message = this.successMessage
                    // window.location = "/vueapp"
                } catch (err) {
                    this.alert.on = true
                    this.alert.status = false
                    this.alert.message = this.errorMessage
                }
            }
        
        },
    }
    
});

Vue.component('messageform', {
    template:
    `
        <div class="col-8 form-inline">
            <div class="bg-success text-white w-100 text-center" 
            v-if="status"> 
                {{ alertmessage }} 
            </div>
            <form @submit.prevent="sendmessage">
                <div class="row">
                    <div class="col-6 form-group  container form-inline justify-content-center mt-2 mb-4 ">
                        <input v-model="name" type="text" class="form-control w-100 " name="CUname" placeholder="Name" required>
                        <input v-model="email" type="email" class="form-control w-100 mt-3" name="CUemail" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <input v-model="subject" type="text" class="form-control w-100 mt-3" name="CUsubject" placeholder="Subject" required>
                    </div>

                    <div class=" col-6 form-group container form-inline justify-content-md-end mt-2 mb-3">
                        <textarea v-model="message" class=".formSet w-100 form-control pt-3" name="CUmessage" rows="3" placeholder="Message" required></textarea>
                        <button type="submit" name="send" class="btnSendMail btn btn-primary w-25 mt-2 font-weight-bold" id="send">SEND</button>
                    </div>
                </div>
            </form>
        </div>


    `,
    props: {
    },
    data() {
        return{
            name    : '',
            email   : '',
            subject : '',
            message : '',
            status : false, 
            alertmessage : "Success send message to us, we will send the answer for your email later"
        }
    },
    methods:{
        async sendmessage () {
            try {
                await Controller.sendmessage(this.name, this.email, this.subject ,this.message)
                this.status = true
            } catch (err) {
                this.status = false
            }
        }
        
    }
    
});  

  
new Vue({
    el: '#app',
    router,
    render: h => h(App)
})
.$mount('#app');