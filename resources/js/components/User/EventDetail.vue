<template>
  <div>
      
        <div id="showevent">
            <div class="navigate w-100 container mt-3 pt-2">
                <span>
                    <router-link style="color:var(--uajy_blue);" to="/user"> <i class="fas fa-home"></i> </router-link> / 
                    <router-link style="color:var(--uajy_blue);" to="/event">Event</router-link>
                    / {{event.title}}
                </span>
            </div>
            <div class="upperevent container mt-3">
                <!-- <hr> -->
                <div class="row h-100">
                    <div class="col-5 imageevent p-3 text-center">
                        <img :src="event.image">
                    </div>
                    <div class="col-7 detailevent p-3">
                        <div class="detailtitle h-25">
                            <h2>{{event.title}}</h2>
                        </div>
                        <div class="detailtype h-15">
                            <h5 style="color:grey;"><i style="color:orange;" class="fas fa-star"></i> Type Event</h5>
                            <h5 class="ml-5">{{event.type}}</h5>
                        </div>
                        <div class="detaildate h-15">
                            <h5 style="color:grey;"><i style="color:blue;" class="far fa-calendar"></i> Date Event</h5>
                            <h5 class="ml-5">{{event.date_start}} Until {{event.date_end}}</h5>
                        </div>
                        <div class="detailtime h-15">
                            <h5 style="color:grey;"><i style="color:green;" class="far fa-clock"></i> Time Event</h5>
                            <h5 class="ml-5">{{event.time_start}} Until {{event.time_end}}</h5>
                        </div>
                        <div class="detailplace h-25">
                            <h5 style="color:grey;"><i style="color:red;" class="fas fa-map-marker-alt"></i> Location Event</h5>
                            <h6 class="ml-5 ">{{event.place}}</h6>
                        </div>     
                    </div>
                </div>
                <!-- <hr> -->
            </div>

            <!-- <div class="bottomevent container text-justify h-100 mt-5 p-3 mb-5">
                <hr>
                <h5 class="font-weight-bold">Description Event</h5>
                <hr>
                <div v-html="event.description"></div>
                <hr>
            </div> -->

            <div class="container">

                <div class="row">

                    <div class="col-8 bottomevent text-justify h-100 mt-5 p-3 mb-5">
                        <hr>
                        <h4 class="font-weight-bold">Description Event</h4>
                        <hr>
                        <div v-html="event.description"></div>
                        <hr>
                    </div>
                    
                    <div class="col-sm">

                        <div class="commentuser bottomevent text-justify h-5 ml-3 mt-5 p-3 mb-3">
                            <hr>
                            <div class="row">
                                <div class="col-2">
                                    <div class="profilecomment text-center mt-2">
                                        
                                        <img :src="user.picture">
                                        
                                    </div>
                                </div>
                                <div class="col text-left font-weight-bold pt-3">
                                    <span>{{user.username}}</span>
                                </div>
                                
                            </div>
                            <form @submit.prevent="addcomment">
                                <textarea v-model="dbcomment.comment" class="w-100 mt-2" placeholder="Add Comment" required ></textarea> 
                                <button type="submit" class=" btn btn-primary w-100">Comment</button>
                            </form>
                            <hr>

                        </div>

                        <div class="commentuser bottomevent text-justify ml-3 mt-2 p-3">
                            <hr>
                                <h4 class="font-weight-bold">Comment ({{allcomment.length}})</h4>
                            <hr>
                        </div>

                        <div class="commentuser listcomment bottomevent text-center ml-3 p-3 mb-1">
                
                            <div v-for="(comment,index) of allcomment" v-bind:key="index">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="profilecomment text-center mt-2">
                                            
                                            <img :src="comment.userpict">
                                            
                                        </div>
                                    </div>
                                    <div class="col text-left font-weight-bold pt-3">
                                        <span class="">{{comment.username}}</span>
                                    </div>
                                    
                                </div>
                                <span class="">{{comment.comment}}</span>
                                <hr>
                            </div>

                        </div>
                    </div>

                </div>
            
            </div>
    

        </div>

  </div>
</template>
<script>
import Controller from '../../httpController'

export default {
  data() {
      return{
          id : this.$route.params.id,
          event:[],
          user:[],
          allcomment:[],
          dbcomment:{
                username:'',
                userpict:'',
                comment:'',
                id_event:'',
                id_user:'',
          },
      }
  },
  methods:{
      async loaddata () {
        try {
            this.event = (await Controller.geteventbyid(this.id)).data
            this.allcomment = (await Controller.getcommentevent(this.event.id)).data
            this.allcomment = this.allcomment.reverse()
            this.user = this.$auth.user()
        
            // console.log(this.event)
            // console.log(this.allcomment)
            
        } catch (err) {
            console.log(err)
        }
    },
    async addcomment(){
        try {
            this.tocomment()
            // console.log(this.dbcomment)            
            const response = await Controller.addcomment(this.dbcomment)
            this.dbcomment.comment =""
            this.loaddata()
            // console.log(response)
        } catch (err) {
            console.log(err)
        }
    },
    tocomment(){
        this.dbcomment.username = this.user.username
        this.dbcomment.userpict = this.user.picture
        this.dbcomment.id_event = this.event.id
        this.dbcomment.id_user  = this.user.id
    }

  },
  mounted(){
      this.loaddata()
  }
  
}
</script>

