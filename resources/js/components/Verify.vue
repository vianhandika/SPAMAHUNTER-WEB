<template>
  <div>
    <nav class="navbarTop navbar navbar-expand-sm sticky-top">
      <router-link to="/">
      <a class="navbar-brand mw-100 d-flex justify-content-center" href="#">
        <img class="navLogo iconLarge" src="images/Logo.png">
        <span class="ml-4 fontMedium font-weight-bold">SPAMA HUNTER</span>
      </a>
      </router-link>
    </nav>

    <div id="signup">
      <div class="container-fluid h-100" >
        <div class="subTitle pt-5 pl-5 pb-5">
            <h2 class="font-weight-bold">Success <u>Verify</u></h2>
        </div>
        <div class="text-center mt-2">
            <h2 class="sublineTitle">You can login to the web now !! </h2>
            <div class="form-inline justify-content-center">  
              <router-link to="/">
              <button type="submit" class="btnSignup btn btn-warning mt-5 w-100 font-weight-bold" name="reset">Login</button>
              </router-link>
            </div>
        </div>
      </div>
    </div>

  </div>
</template>
