<template>
  <div>
      
    <div id="eventadmin">
        <div class="tableeventadmin container w-100 ">
            <div class="mt-5">
                <input type="button" class="btn btn-primary" value="(+)ADD EVENT" data-toggle="modal" data-target="#addEvent">
                <span><div class="float-right infobtnrow">
                    <a href="#" class="btn btn-primary">✓</a><span> :  Verify </span>
                    <a href="#" class="btn btn-danger">✖</a><span> :  Delete </span>
                    <a href="#" class="btn btn-warning">H</a><span> :  Hightlight </span>
                    <a href="#" class="btn btn-secondary">U</a><span> :  UnHightlight </span>
                </div></span>
            </div>
        
            <div class="tablecontainer">
                <table class="table  table-striped table-bordered mt-2">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Place</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                            <tr v-for="(event,index) of allevent.data" v-bind:key="index">
                                <td class="text-center">{{index+1}}</td>
                                <td>{{event.title}}</td>
                                <td>{{event.place}}</td>
                                <td>
                                    <p v-if="event.verify==1">Verified</p>
                                    <p v-else>Unverified</p>                                        
                                </td>
                                <td class="text-center actioncol">
                                    
                                    <button v-if="event.verify==0"
                                    @click="verifyEvent(event.id)"
                                    class="btn btn-primary" >✓</button>
                            
                                
                                    <button v-if="event.highlight==0" 
                                    @click="changeHighlightEvent(event.id)"
                                    class="btn btn-warning" >H</button>
                                
                            
                                    <button v-if="event.highlight==1" 
                                    @click="changeHighlightEvent(event.id)"
                                    class="btn btn-secondary" >U</button>
                                  
                                    <button @click="delEvent(event.id)"
                                    class="btn btn-danger">✖</button>

                                </td>
                            </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div ref="modalbox" class="modal fade" id="addEvent">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <div class=" addeventmodal container w-100">
                    <form @submit.prevent="addEvent" method="POST" enctype="multipart/form-data">
                        <br>
                        <div class="form-group imagePreview text-center p-3">
                            <a href="#" onclick="document.getElementById('selectedFile').click();">
                                <img id="previewimage" v-if="picture" :src="picture">
                            </a>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Image</label>
                            <div class="col-sm-8">
                                <input id="selectedFile" type="file" v-on:change="onFileChange" name="picture" placeholder="Image" accept=" image/jpeg, image/png , image/jpg" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Event Name</label>
                            <div class="col-sm-8">
                            <input v-model="title" id="title" type="text" class="form-control mt-2 w-85" name="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Event Type</label>
                            <div class="col-sm-8">
                            <select v-model="type" id="type" class="form-control mt-2 w-85" name="type">
                                <option value="Seminar">Seminar</option>
                                <option value="Workshop">Workshop</option> 
                                <option value="Social">Social</option>
                                <option value="Contest">Contest</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Date Event (Start & End)</label>
                            <div class="col-sm-4">
                                <input v-model="date_start" id="date_start" type="date" class="form-control mt-2 w-85" name="date_start" required>
                            </div>
                            <div class="col-sm-4">
                                <input v-model="date_end" id="date_end" type="date" class="form-control mt-2 w-85" name="date_end" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Time Event (Start & End)</label>
                            <div class="col-sm-4">
                                <input v-model="time_start" id="time_start" type="time" class="form-control mt-2 w-85" name="time_start" required>
                            </div>
                            <div class="col-sm-4">
                                <input v-model="time_end" id="time_end" type="time" class="form-control mt-2 w-85" name="time_end" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Location</label>
                            <div class="col-sm-8">
                                <input v-model="place"  id="place" type="text" class="form-control mt-2 w-85" name="place" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Description </label>
                            <!-- <textarea class="textarea h-100" id="txtEditor" name="description"></textarea>  -->
                            <editor v-model="description" api-key="e1tp2k17fp9nruqrqryf1ex6xuismeleyd9kp9kv6w6pd1o4" :init="{plugins: 'wordcount',height : '480'}"></editor>
                        </div>
                        <button type="submit" class="btn btn-warning" name="addevent">Add Event</button>
                    </form>
                    <br>
                    <br>
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
import Editor from '@tinymce/tinymce-vue';

export default {
    
    data() {
        return{
            allevent: [],
            alert:{
                on:false,
                message:"Success Adding Event, Please Wait For Verify Admin"
            },
            picture:'',

            title:'',
            type:'',
            place:'',
            image:'',
            description:'',
            date_start:'',
            date_end:'',
            time_start:'',
            time_end:'',

        }
    },
    components: {
        'editor': Editor // <- Important part
    },
    methods:{
        async getallevent () {
            try {
                this.allevent = await Controller.getallevent()
                this.allevent.data = this.allevent.data.reverse()
                // console.log(this.eventbyuser)
            } catch (err) {
                console.log(err)
            }
        },
        onFileChange(e) {
            const file = e.target.files[0] 
            this.picture = URL.createObjectURL(file)

            this.image=e.target.files[0] 
            // console.log(this.images)

        },
        async addEvent(){
            try {
                let formData = new FormData();

                formData.append('title',this.title,);
                formData.append('type',this.type,);
                formData.append('place',this.place,);
                formData.append('image', this.image,);
                formData.append('description',this.description,);
                formData.append('date_start',this.date_start,);
                formData.append('date_end',this.date_end,);
                formData.append('time_start',this.time_start,);
                formData.append('time_end',this.time_end,);
                formData.append('id_user',this.$auth.user().id,);

                console.log(formData)
                await Controller.addevent(formData)
                document.getElementById("dismismodal").click();
                this.getallevent()
                this.initform()
                
                console.log("Success")
            } catch (err) {
                console.log(err)
            }
        this.getallevent() 
        },async delEvent(id){
            try {
                await Controller.delevent(id)
                this.getallevent()
                
            } catch (err) {
                console.log(err)
            }
            this.getallevent() 
        },
        async verifyEvent(id){
            try {
                await Controller.verifyevent(id)
                this.getallevent()

                
            } catch (err) {
                console.log(err)
            }
            this.getallevent() 
        },
        async changeHighlightEvent(id){
            try {
                await Controller.changehighlightevent(id)
                this.getallevent()

                
            } catch (err) {
                console.log(err)
            }
            this.getallevent() 
        },
        initform(){
            this.picture=''
            this.title='',
            this.type=''
            this.place=''
            this.image=''
            this.description=''
            this.date_start=''
            this.date_end=''
            this.time_start=''
            this.time_end=''
        }
    },
    mounted(){
        this.getallevent()   

    }
}
</script>






