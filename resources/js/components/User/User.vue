<template>
    <div class="user">
        <nav class="navbarTop navbar navbar-expand-sm sticky-top">
            <router-link to="/user" exact >
                <a class="navbar-brand mw-100 d-flex justify-content-center">
                <img class="navLogo iconLarge" src="/images/Logo.png">
                <span class="ml-4 fontMedium font-weight-bold">SPAMA HUNTER</span>
                <span class="mt-2 ml-4 fontSmall font-weight-bold userpage">Member Page</span>
                </a>
            </router-link>
            <ul class="navbarLeft navbar-nav ml-auto">
            <li class="nav-item  pr-4">
                <router-link to="/event" exact >
                    <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Event
                    </a>
                </router-link>
            </li>
            <li class="nav-item dropdown pr-4">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$auth.user().username}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <router-link to="/profile"><a class="dropdown-item" href="profile.php">Edit Profile</a></router-link>
                    <router-link to="/manageevent"><a class="dropdown-item" href="eventuser.php">Your Event</a></router-link>
                </div>
            </li>
            <li class="nav-item pr-4">
                <a @click.prevent="logout" href="#" class="nav-link">Log Out</a>
            </li>
            </ul>
        
        </nav>

        <router-view v-bind:key="$route.fullPath"></router-view>

        <hr class="mb-5">
        <div id="footer">
            <div class="container-fluid h-100">
            <div class="container pt-5"> 
                <div class="row">
                    <div class="col-4">
        
                        <h2 class="font-weight-bold">SPAMA HUNTER</h2>
                        <h5 class="text-justify">Spama Hunter Are Website That Can Share Information
                            About An Event And It Can Be
                            From Us Or From You For Each Other.</h5>
                        <h5 class="text-center">"More information about event
                            more SPAMA POINT you can get"</h5>
        
                    </div>
                    <div class="col-4 pl-5" >
                        <h2 class="font-weight-bold">Features</h2>
                
                        <router-link to="/event"><a style="color:black !important; text-decoration:none;" href=""><h5><u>Seminar</u></h5></a></router-link>
                        <router-link to="/event"><a style="color:black !important; text-decoration:none;" href=""><h5><u>Workshop</u></h5></a></router-link>
                        <router-link to="/event"><a style="color:black !important; text-decoration:none;" href=""><h5><u>Social</u></h5></a></router-link>
                        <router-link to="/event"><a style="color:black !important; text-decoration:none;" href=""><h5><u>Contest</u></h5></a></router-link>
                
            
                    </div>

                    <div class=" medsos col-4" >
                        <div class="mt-2">
                            <a href="https://www.facebook.com/">
                                <img class="iconMedsos" src="/images/facebook.png">
                                <span> Facebook</span>
                            </a> 
                        </div>
                        <div class="mt-2">
                            <a href="https://www.instagram.com/">
                                <img class="iconMedsos" src="/images/instagram.png">
                                <span> Instagram</span>
                            </a> 
                        </div>
                        <div class="mt-2">
                            <a href="https://twitter.com/">
                                <img class="iconMedsos" src="/images/twitter.png">
                                <span> Twitter</span>
                            </a> 
                        </div>        
                    </div>        
                </div>
                
                <h5 class="text-center  pt-4">©2018 Copyright: SpamaHunter.com alright reserved.</h5>
                <hr>
            </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
   data(){
        return {
            // parsingdata:20,
        }
   },
  methods:{

    checkrole(){
        if(this.$auth.user().role==1){
            this.$router.replace('/admin')
        }
    },
    logout(){
        this.$auth.logout({
            redirect:'/'
        });
    },


  },
  created(){
      this.checkrole()
  }
}
</script>

