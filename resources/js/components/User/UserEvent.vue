<template>
    <div>
        <div class="titlesubmenu">
            <hr>
            <h2 class="text-center font-weight-bold">Type Event</h2>
            <hr>
        </div>

        <div id="typeevent">
            <div class="container h-100">
                <div class="row h-100 text-center">
                
                    <div class="col-3 btnfilter" @click=" getEventByCat('Seminar')" >
                        <a style="text-decoration:none; color:black;">
                            <img src="/images/seminar.png">
                            <h4>Seminar</h4>
                        </a>
                    </div>
                    <div class="col-3 btnfilter" @click=" getEventByCat('Workshop')">
                        <a style="text-decoration:none; color:black;">
                            <img src="/images/workshop.png">
                            <h4>Workshop</h4>
                        </a>
                    </div>
                    <div class="col-3 btnfilter" @click=" getEventByCat('Social')">
                        <a style="text-decoration:none; color:black;">
                            <img src="/images/social.png">
                            <h4>Social</h4>
                        </a>    
                    </div>
                    <div class="col-3 btnfilter" @click=" getEventByCat('Contest')">
                        <a style="text-decoration:none; color:black;">
                            <img src="/images/contest.png">
                            <h4>Contest</h4>
                        </a>     
                    </div>
               
                </div>

            </div>
        </div>

        <div class="titlesubmenu">
            <hr>
            <h2 class="text-center font-weight-bold">List Event {{category}}</h2>
            <hr>
        </div>

        <div id="event">
            <div class="container-fluid h-100">
                <div class="row">

                   
                        <div v-for="event of eventcategory" v-bind:key="event['id']" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4 d-flex justify-content-center">
                            
                            <div class="card shadow rounded cardContent" style="width: 18rem;">
                                <div class="cardimg">
                                    <router-link :to="'/event/'+event.id">
                                    <a href="">    
                                        <img class="card-img-top" v-bind:src="event.image" alt="Card image cap">
                                    </a>
                                    </router-link>
                                </div>
                                <div class="card-body cardbody">

                                    <div class="cardtitle">
                                        <h5 class="card-title text-center font-weight-bold titleEvent">{{event.title}}</h5>
                                    </div>
                                    
                                    <div class="card-text carddesc">
                                        <div class="descEvent"><i style="color:orange;" class="fas fa-star"></i> {{event.type}}</div>
                                        <div class="descEvent"><i style="color:blue;" class="far fa-calendar"></i> {{event.date_start}}</div>
                                        <div class="descevent"><i style="color:red;" class="fas fa-map-marker-alt"></i> {{event.place}}</div>
                                    </div>
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
import Filter from '../../filter'


export default {
    
    data() {
        return{
            allevent: [],
            eventcategory: [],
            seminar:[],
            workshop:[],
            contest:[],
            social:[],
            category:'Seminar',

            // eventHighlight:[],
        }
    },
    methods:{
       
        async getallevent () {
            try {
                this.allevent = await Controller.getallevent()
                
                this.eventcategory=this.allevent.data.filter(Filter.Seminar).filter(Filter.EventOn).reverse()
                this.seminar = this.allevent.data.filter(Filter.Seminar).filter(Filter.EventOn).reverse()
                this.workshop = this.allevent.data.filter(Filter.Workshop).filter(Filter.EventOn).reverse()
                this.contest = this.allevent.data.filter(Filter.Contest).filter(Filter.EventOn).reverse()
                this.social = this.allevent.data.filter(Filter.Social).filter(Filter.EventOn).reverse()
                // this.eventHighlight=this.allevent.data.filter(Filter.EventHighlight || Filter.EventOn)

                console.log(this.eventcategory)
            } catch (err) {
                console.log(err)
            }
        },
        getEventByCat(category){
            if(category=="Seminar"){
                this.eventcategory=this.seminar
                this.category='Seminar'
            }
            if(category=="Workshop"){
                this.eventcategory=this.workshop
                this.category='Workshop'
            }
            if(category=="Social"){
                this.eventcategory=this.social
                this.category='Social'
            }
            if(category=="Contest"){
                this.eventcategory=this.contest
                this.category='Contest'                
            }
            // console.log(this.eventcategory)
        },
    },
    mounted(){
        this.getallevent()
    }
}
</script>