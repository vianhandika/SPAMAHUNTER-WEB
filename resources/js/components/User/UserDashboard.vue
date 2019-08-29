<template>
    <div>
        <div id="slideshow">
            <div class="container mt-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="images/slides/slide-1.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slides/slide-2.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="images/slides/slide-3.png" alt="Third slide">
                        </div>
                         <div class="carousel-item">
                        <img class="d-block w-100" src="images/slides/slide-4.png" alt="Fourth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>

        <div class="titlesubmenu">
            <hr>
            <h2 class="text-center font-weight-bold">Highlight Event</h2>
            <hr>
        </div>
        <div>
            <div id="highlight" class="pt-4">
                <div class="container h-100">
                    <div class="row  h-75 ">

                        
                            <div v-for="event of eventHighlight" v-bind:key="event['id']" class="col-sm-6 col-lg-4 mb-4 d-flex justify-content-center">
                                <div class="card shadow rounded" style="width: 18rem;">
                                    <div class="cardimgh">
                                        <router-link :to="'/event/'+event.id">
                                        <a href="">
                                            <img class="card-img-top" v-bind:src="event.image" alt="Card image cap">
                                        </a>   
                                        </router-link>
                                    </div>
                                    <div class="card-body">
                                        <div class="cardtitleh">
                                            <h5 class="card-title text-center font-weight-bold ">{{event.title}}</h5>
                                        </div>    
                                        <div class="card-text">
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

            <div class="titlesubmenu">
                <hr>
                    <h2 class=" text-center font-weight-bold">Event</h2>
                    <!-- <input type="text" v-model="search"/> -->
                <hr>
            </div>
            <div class="searchbar container-fluid row ">
                <div class="col-6 text-left container-fluid">
                    <span style="color:var(--uajy_blue);font-weight:bold;" >Search: </span><input type="text" v-model="search"/><span><i style="color:red;" class="fas fa-search ml-3"></i></span>
                   
                </div>
                
                <div class="col-6 container-fluid text-right">
                    <vue-ads-pagination v-if="eventcount!=0"
                        :page="0"
                        :itemsPerPage="12"
                        :total-items="eventcount"
                        :max-visible-pages="5"
                        @page-change="pageChange"
                    />
                
                </div>  
                 
            </div>
            <hr>

            <div id="event">
                <div class="container-fluid h-100">
                    <div class="row">

                       
                        <div v-for="event of filters"  v-bind:key="event['id']" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4 d-flex justify-content-center">
                            
                            <div class="card shadow rounded cardContent" style="width: 18rem;">
                                <div class="cardimg">
                                    <router-link v-bind:to="'/event/'+event.id">
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
    </div>
</template>
<script>
import Controller from '../../httpController'
import Filter from '../../filter'
import VueAdsPagination from 'vue-ads-pagination';

export default {
    components:{
        VueAdsPagination,
    },
    data() {
        return{
            allevent: [],
            eventOn: [],
            eventHighlight:[],
            search:'',

            eventcount:0,
            page: 0,
            start: 0,
            end: 0,
        }
    },
    methods:{
        pageChange(page, start, end) {
              this.page = page;
              this.start = start;
              this.end = end;
        },

        async getallevent () {
            // console.log(this.parsingdata)
            try {
                this.allevent = await Controller.getallevent()
                this.eventOn=this.allevent.data.filter(Filter.EventOn).reverse()
                this.eventHighlight=this.allevent.data.filter(Filter.EventHighlight).filter(Filter.EventOn)
                
                this.eventcount=this.eventOn.length
                
                console.log(this.allevent.data)
            } catch (err) {
                console.log(err)
            }
        }
    },
    mounted(){
        this.getallevent()   

    },
    computed: {
        filteredevent:function()
        // filteredevent()
        {
            var self = this;
            return this.eventOn.filter(function(event){
                return event.title.toLowerCase().indexOf(self.search.toLowerCase())>=0;
            });
            //return this.customers;
        },
        filters: function(){
            if(this.eventOn.length) {
                return this.eventOn.filter((event, index) => {
                    if(this.search != '') return event.title.toLowerCase().includes(this.search.toLowerCase());
                    if(index >= this.start && index < this.end) return true;
                });
            }
        },
    }
}
</script>
