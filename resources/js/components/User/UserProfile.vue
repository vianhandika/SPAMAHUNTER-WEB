<template>
    <div id="profile">
        <div class="profilecontent container-fluid text-center mt-5">
            <div class="row d-flex justify-content-center">

                <form @submit.prevent="updateprofile" class=" container form-inline justify-content-center mt-5 mb-4 " enctype="multipart/form-data">
                
                <div class="col-4 logininformation">
                    <hr>
                    <div class="profilepicture container mt-2">
                        <a href="#" onclick="document.getElementById('selectedFile').click();">
                            <img id="previewimage" v-if="picture" :src="picture">
                        </a>
                    </div>
                    
                    <div class="form-inline justify-content-center">
                        
        
                            <input type="file" ref="file" v-on:change="onFileChange" id="selectedFile" name="images" class="ml-5 pl-5 mt-2">
                            <input type="text" class="form-control  mt-2 w-75" name="username"  :value="$auth.user().username" placeholder="Username" disabled>
                            <input type="email" class="form-control mt-2 w-75" name="email"     :value="$auth.user().email" aria-describedby="emailHelp" placeholder="Enter email" disabled>
                            <input type="password" class="form-control  mt-2 w-75" name="password" :value="$auth.user().username" placeholder="Password" disabled>
                
        
                    </div>
                        <div class="bg-success text-white w-100 mt-3" 
                        v-if="alert.on"> 
                            {{ alert.message }} 
                        </div>  
                    <hr>

                </div>

                <div class="col-7 profileinformation ml-4">
                    <hr>
                    <h2>PROFILE</h2>
                    <hr>
                    
                    <div class="form-inline justify-content-center pr-5 pl-5">
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Firstname</label>
                                <input v-model="showprofile.firstname" type="text" class="form-control  mt-2 w-100" name="username"  placeholder="Firstname">
                            </div>
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Lastname</label>
                                <input v-model="showprofile.lastname" type="text" class="form-control  mt-2 w-100" name="username"   placeholder="Lastname">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Phone</label>
                                <input v-model="showprofile.phone" type="text" class="form-control  mt-2 w-100" name="username"   placeholder="Phone">
                            </div>
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Job Status</label>
                                <input v-model="showprofile.jobstatus" type="text" class="form-control  mt-2 w-100" name="username"  placeholder="Student, Employee, etc">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Job Place</label>
                                <input v-model="showprofile.jobplace" type="text" class="form-control  mt-2 w-100" name="username"  placeholder="University / Job Place">
                            </div>
                            <div class="col-6">
                                <label class="float-left font-weight-bold">Public Info</label>
                                <input v-model="showprofile.publicinfo" type="text" class="form-control  mt-2 w-100" name="username"   placeholder="Skill / Hobies">
                            </div>
                        </div>
                        
                            <button type="submit" class="btnUpdate btn btn-warning mt-3 w-50 font-weight-bold" name="update">UPDATE PROFILE</button>
                
                    </div>
                    <hr>
                </div>

                </form>

            </div>

        
        </div>
    </div>
</template>
<script>
import Controller from '../../httpController'

export default {
    data(){
        return{
            picture:'',
            url: null,
            images:'', 
            alert:{
                on: false,
                message: 'Success Update',
            },
            user:[],
            users:[],
            profile:[],
            showprofile:{
                firstname:'',
                lastname:'',
                phone:'',
                jobstatus:'',
                jobplace:'',
                publicinfo:'',
            },
            dbprofile:{
                firstname:'-',
                lastname:'-',
                phone:'-',
                jobstatus:'-',
                jobplace:'-',
                publicinfo:'-',
            }


        }
    },
    methods:{
        async loadData(){
          
            if(this.$auth.user().picture == ""){
               this.picture='/images/profile/defaultpp.png'
            }
            else{
                this.picture= this.$auth.user().picture
            }
            this.user= this.$auth.user()

            try {
                this.profile = await Controller.getprofile(this.user.id) 
                
                
            } catch (err) {
                console.log(err)
            }
            this.loadshowprofile()


          
        },
        async loadPicture(){

             try {
                this.users = await Controller.getuser(this.$auth.user().id) 
                this.picture = this.users.data.picture
                console.log(this.users.data)
                console.log(this.picture)
                
                
                
            } catch (err) {
                console.log(err)
            }

        },
        loadshowprofile(){
            const data = this.profile.data
            if(data.firstname!="-"){
                this.showprofile.firstname = data.firstname
            }
            if(data.lastname!="-"){
                this.showprofile.lastname = data.lastname
            }
            if(data.phone!="-"){
                this.showprofile.phone = data.phone
            }
            if(data.jobstatus!="-"){
                this.showprofile.jobstatus = data.jobstatus
            }
            if(data.jobplace!="-"){
                this.showprofile.jobplace = data.jobplace
            }
            if(data.publicinfo!="-"){
                this.showprofile.publicinfo = data.publicinfo
            }
  
        },
        toprofile(){
            const data = this.showprofile
           if(data.firstname!=""){
                this.dbprofile.firstname = data.firstname
            }
            if(data.lastname!=""){
                this.dbprofile.lastname = data.lastname
            }
            if(data.phone!=""){
                this.dbprofile.phone = data.phone
            }
            if(data.jobstatus!=""){
                this.dbprofile.jobstatus = data.jobstatus
            }
            if(data.jobplace!=""){
                this.dbprofile.jobplace = data.jobplace
            }
            if(data.publicinfo!=""){
                this.dbprofile.publicinfo = data.publicinfo
            }
  
        },
        onFileChange(e) {
            const file = e.target.files[0] 
            this.picture = URL.createObjectURL(file)

            this.images=this.$refs.file.files[0];
            // console.log(this.images)

        },
        async updatepicture(){
           
            try {
                let formData = new FormData();
                formData.append('images', this.images);
                // console.log(formData)
                await Controller.updatepicture(formData, this.$auth.user().id)
                // console.log(request)
                // this.alert.on=true
        
     
            } catch (err) {
                console.log(err)
               
            }
            // this.loadpicture()
        
        },
        async updateprofile(){
            try {
                this.toprofile()
                console.log(this.dbprofile)
                const response = await Controller.updateprofile(this.dbprofile, this.profile.data.id)
                console.log(response)
                if(this.images!='')
                {
                    this.updatepicture()
                }
                
                this.alert.on=true
                // this.loadData()
                // this.loadPicture()
     
            } catch (err) {
                console.log(err)
               
            }
        }
    },

    mounted(){
        this.loadData()
    }
}
</script>

