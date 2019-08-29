<template>
  <div>
    <nav class="navbarTop navbar navbar-expand-sm sticky-top">
        <a class="navbar-brand mw-100 d-flex justify-content-center">
            <img class="navLogo iconLarge" src="images/Logo.png">
            <span class="ml-4 fontMedium font-weight-bold">SPAMA HUNTER</span>
            <span class="mt-2 ml-4 fontSmall font-weight-bold userpage">Admin Page</span>
        </a>
    </nav>

    <div class="sidebar">
        
        <div class="container d-flex justify-content-center mt-3">
            <img class="w-75 h-25 img-fluid" src="images/Logo.png">
        </div>
        <router-link class="navside" to="/admin">
            <div class="box-menu mt-5 navside">
                <a style="text-decoration:none; color:black;"><h4>Dashboard</h4></a>
            </div>
        </router-link>
        <div class="box-menu-second">
            <router-link class="navside" to="/adminmanageuser" replace><div class="mb-2">Manage User</div></router-link>
            <router-link class="navside" to="/adminmanageevent" replace><div class="mb-2">Manage Event</div></router-link>
            <router-link class="navside" to="/adminmessage" replace><div class="mb-2">Inbox</div></router-link>
        </div>
        <div class="box-logout mt-5">
            <button @click="logout" type="button" class="btn btn-danger">Log Out</button>
        </div>
        
    </div>

    <router-view :key="$route.fullPath"></router-view>

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
        if(this.$auth.user().role==2){
            this.$router.replace('/user')
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
