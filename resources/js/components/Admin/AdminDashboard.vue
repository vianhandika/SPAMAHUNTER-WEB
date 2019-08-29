<template>
  <div>
    <div id="contentadmin">
        <div class="eventgraph mt-1">
            <div class="titlesubmenu">
                <hr>
                <h2 class="text-left font-weight-bold ml-5">Event</h2>
                <hr>
            </div>
            <div class="container h-100">

                <div class="row h-75 text-center">
                    
                    <div class="col-12 col-sm-6  col-lg-3 mb-5 btnfilter" >
                        <img src="images/seminar.png">
                        <h4>Seminar</h4>
                        <h4 style="background-color: var(--uajy_blue); color:white;">{{seminar}} EVENT</h4>
                    </div>
                    <div class="col-12 col-sm-6  col-lg-3 mb-5 btnfilter">            
                        <img src="images/workshop.png">
                        <h4>Workshop</h4>
                        <h4 style="background-color: var(--uajy_blue); color:white;">{{workshop}} EVENT</h4>
                    </div>
                    <div class="col-12 col-sm-6  col-lg-3 mb-5 btnfilter">                 
                        <img src="images/social.png">
                        <h4>Social</h4>
                        <h4 style="background-color: var(--uajy_blue); color:white;">{{social}} EVENT</h4>       
                    </div>
                    <div class="col-12 col-sm-6  col-lg-3 mb-5 btnfilter">                  
                        <img src="images/contest.png">
                        <h4>Contest</h4>
                        <h4 style="background-color: var(--uajy_blue); color:white;">{{contest}} EVENT</h4>
                    </div>


                </div>

            </div>
        </div> 
        <div class="eventgraph mt-1">
            <div class="titlesubmenu">
                <hr>
                <h2 class="text-left font-weight-bold ml-5">User</h2>
                <hr>
            </div>
            <div class="container h-100">

                <div class="row h-75 text-center">
                    
                    <div class="col-12 col-sm-6  col-lg-3 mb-5 btnfilter" >
                        <img src="images/share.png">
                        <h4>Member</h4>
                        <h4 style="background-color: var(--uajy_blue); color:white;">{{user}} MEMBER</h4>
                    </div>


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
            allevent: [],
            alluser: [],
            eventcategory: [],
            user:0,
            seminar:0,
            workshop:0,
            contest:0,
            social:0,
            category:'Seminar',

            // eventHighlight:[],
        }
    },
    methods:{
        async getalldata () {
            try {
                this.allevent = await Controller.getallevent()
                this.alluser = await Controller.getalluser()
                this.user = this.alluser.data.length
                this.seminar = this.allevent.data.filter(Filter.Seminar).filter(Filter.EventOn).length
                this.workshop = this.allevent.data.filter(Filter.Workshop).filter(Filter.EventOn).length
                this.contest = this.allevent.data.filter(Filter.Contest).filter(Filter.EventOn).length
                this.social = this.allevent.data.filter(Filter.Social).filter(Filter.EventOn).length
                // this.eventHighlight=this.allevent.data.filter(Filter.EventHighlight || Filter.EventOn)

                console.log(this.eventcategory)
            } catch (err) {
                console.log(err)
            }
        },
    },
    mounted(){
        this.getalldata()
    }
}
</script>

