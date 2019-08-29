<template>
  <div>
      
    <div id="contentadmin">
        <div class="tableeventadmin container w-100 ">
            <div class="mt-5">
            <input type="button" class="btn btn-primary" value="(+)ADD USER"  data-toggle="modal" data-target="#addUser">
                <span><div class="float-right infobtnrow">
                    <a href="#" class="btn btn-danger">✖</a><span> :  Delete </span>
                    <a href="#" class="btn btn-warning">A</a><span> :  Set Admin </span>
                    <a href="#" class="btn btn-secondary">U</a><span> :  Un Admin </span>
                </div></span>
            </div>
        
            <div class="tablecontainer">
                <table class="table  table-striped table-bordered mt-2">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            
                            <tr v-for="(user,index) of alluser.data" v-bind:key="index">
                                <td class="text-center">{{index+1}}</td>
                                <td>{{user.username}}</td>
                                <td>{{user.email}}</td>
                                <td>
                                    <p v-if="user.role == 1">Admin</p>
                                    <p v-else>User</p>
                                </td>
                                <td>
                                    <p v-if="user.verify == 0">Unverified</p>
                                    <p v-else>Verified</p>
                                </td>
                                <td class="text-center actioncol">

                                    <button v-if="user.role == 2" @click="changeroleuser(user.id)" 
                                    class="btn btn-warning" >A</button>

                                    <button v-else @click="changeroleuser(user.id)" class="btn btn-secondary" >U</button>
                                    
                                    <button @click="deluser(user.id)"  class="btn btn-danger">✖</button>

                                </td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUser">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class=" addeventmodal container w-100">
                    <div class="bg-danger text-white w-100 text-center"
                    v-if="alert.on && !alert.status"> 
                        {{ alert.message }} 
                    </div>
                    <div class="bg-success text-white w-100 text-center" 
                    v-if="alert.on && alert.status"> 
                        {{ alert.message }} 
                    </div>
                    <div class="form-inline justify-content-center">
                        <form @submit.prevent="register" class=" container w-75 form-inline justify-content-center mt-5 mb-4 ">
                            <input v-model="username" type="text" class="form-control  mt-2 w-75" name="username" placeholder="Username" required>
                            <input v-model="email" type="email" class="form-control mt-2 w-75" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <input v-model="password" type="password" class="form-control  mt-2 w-75" name="password" placeholder="Password" required>
                            <input v-model="cmfpassword" @keyup="passwordCheck" type="password" class="form-control  mt-2 w-75" name="cmfpassword" placeholder="Confirm Password" required>
                            <button type="submit" class="btnSignup btn btn-warning mt-5 w-50 font-weight-bold" name="signup">Add User</button>
                        </form>
                    </div>
                        
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="dismismodal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
            </div>
        </div>
    </div>

  </div>
</template>
<script>
import Controller from '../../httpController'
import Filter from '../../filter'

export default {
  data() {
        return{
            alluser: [],
            alert:{
                on      : true,
                status  : false,
                message : '',
            },
            username:'',
            email:'',
            password:'',
            cmfpassword:'',    
        }
    },
    methods:{
        async getalluser () {
            try {
                this.alluser = await Controller.getalluser()

                console.log("Success Get All User")
                // console.log(this.alluser.data)
        
            } catch (err) {
                console.log(err)
            }
        },
        async deluser (id) {
            try {
                await Controller.deluser(id)

                console.log("Success Dell User")
                this.getalluser()
            } catch (err) {
                console.log(err)
            }
        },
        async changeroleuser (id) {
            try {
               await Controller.changeroleuser(id)

                // console.log(response)
                console.log("Success Change Role User")
                this.getalluser()
            } catch (err) {
                console.log(err)
            }
        },
        async register () {

            if(this.password != this.cmfpassword){
                this.alert.message = "Confirmation Password Doesnt Match"
                this.alert.on = true
                this.alert.status = false
            }else{
                try {
                    await Controller.register(this.username, this.email, this.password)
   
                    
                    this.alert.on = true
                    this.alert.status = true    
                    this.alert.message ="Success Add user"
                    this.forminit ()
                    
                    // document.getElementById("dismismodal").click();
                    
                } catch (err) {
                    this.alert.on = true
                    this.alert.status = false
                    this.alert.message ="Username / Email Alerady Registerd"
                }
            }
            this.getalluser()
        },
        forminit (){
            this.password='',
            this.cmfpassword='',
            this.username='',
            this.email=''
        },
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

    },
    mounted(){
        this.getalluser()
    }
}
</script>

