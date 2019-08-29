<template>
    <div class="homepage">
        <nav class="navbarTop navbar navbar-expand-sm sticky-top">

            <a class="navbar-brand mw-100 d-flex justify-content-center" href="#">
            <img class="navLogo iconLarge" src="images/Logo.png">
            <span class="ml-4 fontMedium font-weight-bold">SPAMA HUNTER</span>
            </a>

            <ul class="navbarLeft navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#features">Features</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#home">Member Page</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#contactus">Contact Us</a>
            </li>
            </ul>

        </nav>


        <div id="home">

            <div class="container-fluid h-100">
                <div class="row h-100 ">
                <div class="col-7">
                    <div class="homeContent container w-75 text-center" >

                    <h6>MOTTO FOR US</h6>
                    <h1 class="mt-4">More Information About Event</h1>
                    <h1>More SPAMA POINT You Can Get</h1>
                    <!-- <a href="#signup" type="submit" class="btnSignup btn btn-warning w-50 mt-5 font-weight-bold">SIGN UP</a> -->
                    <a href="#signup"><button type="submit" class="btnSignup btn btn-warning w-50 mt-5 font-weight-bold">SIGN UP</button></a>
                    
                    </div>
            
                </div>
                <loginform v-bind:value="false"></loginform>
                <!-- -->
                </div>
            </div>

        </div>

        <div id="features">

            <div class="container-fluid h-100">
            <div class="subTitle pt-5 pl-5 ">
                <h2 class="font-weight-bold">Feat<u>ures</u></h2>
            </div>
            <div class="text-center mt-5">
                <h2 class="sublineTitle">Something Special <u>Event List</u></h2>
            </div>

            <div class="row h-50 mt-5 pb-4">
                <div class="col-3 text-center pt-5" style="background-color: white;">
                <img class="iconFeatures " src="images/seminar.png">
                <h2 class="pt-3">Seminar</h2>
                </div>
                <div class="col-3 text-center pt-5" style="background-color: var(--bg_color2);">
                <img class="iconFeatures " src="images/workshop.png">
                <h2 class="pt-3">Workshop</h2>
                </div>
                <div class="col-3 text-center pt-5" style="background-color: white;">
                <img class="iconFeatures " src="images/social.png">
                <h2 class="pt-3">Social</h2>
                </div>
                <div class="col-3 text-center pt-5" style="background-color: var(--bg_color2);">
                <img class="iconFeatures" src="images/contest.png">
                <h2 class="pt-3">Contest</h2>
                </div>

            </div>
            </div>


        </div>

        <div id="about">

            <div class="container-fluid h-100" >
            <div class="subTitle pt-5 pl-5 pb-5">
                <h2 class="font-weight-bold">Ab<u>out</u></h2>
            </div>
            <div class="aboutContent container-fluid  pt-5 text-center">
                <div class="text-center mt-3">
                <h2 class="sublineTitle">Something Special <u>Website</u></h2>
                <h3 class="pt-5">"Spama Hunter Are Website That Can Share Information</h3> 
                <h3>About An Event And It Can Be</h3> 
                <h3> From Us Or From You For Each Other"</h3>
                <h3 class="pt-3"><i>By: Developer Team</i></h3>
                <img class="iconAbout" src="images/deal.png">
                </div>
            </div>
            </div>

        </div>

        <signupform></signupform>
        <!-- -->

        <div id="contactus">
            <div class="container-fluid h-100">
            <div class="row subTitle pt-5 pl-5 pb-5">
                <div class="col-7">
                    <h2 class="font-weight-bold">Contact <u>Us</u></h2>
                </div>
                <div class="col-5">
                    <h2 class="font-weight-bold">Follow <u>Us</u></h2>
                </div>       
                
            </div>
            <div class="container "> 
                <div class="row">
                    <!-- -->
                    <messageform></messageform>
                    <div class=" medsos col-4" >
                        <div class="mt-2">
                            <a href="https://www.facebook.com/">
                                <img class="iconMedsos" src="images/facebook.png">
                                <span> Facebook</span>
                            </a> 
                        </div>
                        <div class="mt-2">
                            <a href="https://www.instagram.com/">
                                <img class="iconMedsos" src="images/instagram.png">
                                <span> Instagram</span>
                            </a> 
                        </div>
                        <div class="mt-2">
                            <a href="https://twitter.com/">
                                <img class="iconMedsos" src="images/twitter.png">
                                <span> Twitter</span>
                            </a> 
                        </div>        
                    </div>          
                </div>
                
                <h5 class="text-center mt-5 pt-4">©2018 Copyright: SpamaHunter.com alright reserved.</h5>
            </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
   data(){
        return {
        
        }
   },
  methods:{
    checklogin(){
        if(this.$auth.check())
        {
            this.checkrole()
        }

    },
    checkrole(){
        if(this.$auth.user().role==1){
            this.$router.replace('/admin')
        }
        else if(this.$auth.user().role==2)
        {
            this.$router.replace('/user')
        }
    },
  },
  created(){
      this.checklogin()
  }
}
</script>

