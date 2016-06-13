<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
//if (isset($_COOKIE['lylho_user'])) {
    //echo $_COOKIE['lylho_user'];
//}
if(!is_logged_in()){
      header("Location:login.php");exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Lylho - En Citatsamling</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css"  rel="stylesheet"/>
    <link href="css/style2.css" type="text/css"  rel="stylesheet"/>
    </head>
<ul id="dropdown1" class="dropdown-content">    
      <li><a class="black-text" href="inspirerande.php">Inspirerande</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="humor.php">Humor</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="ovrigt.php">Övrigt</a></li>
        <?php if($_SESSION['is_admin'] == 1): ?>
       <li class="divider"></li>       
       <li><a class="black-text" href="manageposts.php">Publish Posts</a></li>
        <?php endif; ?>
</ul>
<div class="navbar-fixed">    
    <?php include_once("logged_in_menu.php"); ?>        
</div><!--Navigation End-->
    <body>
    <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '219431625110292',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
<!-- Welcome-->
    <div class="row">
      <div class="container">
        <?php if (login_check($mysqli) == true) : ?>
        <h2 class="center">Välkommen <?php echo htmlentities($_SESSION['username']); ?>!</h2>
            <p>
                Lägg upp dina citat nu och tävla om en plats i rampljuset.
            </p>
            <h5>Skapa ett citat <a href="post.php">här</a></h5>
        <?php else : ?>
            <p>
                <span class="error">Du har inte rättigheter att besöka denna sidan.</span> Please <a href="login.php">login</a>.
            </p>
        <?php endif; ?>
        </div>
</div>
 <!--Footer-->
<div id="footer">
  <footer class="page-footer teal grey darken-4">
    <div class="container">
      <div class="row">
        <div class="col l4 s12">
          <h5 class="white-text">Lyhlo - En citatsamling</h5>

        </div>
           <div class="col l3 s12">
          <h5 class="white-text">Om</h5>
          <ul>
            <li><a class="white-text" href="om.html">Om Lylho</a></li>
            <li><a class="white-text" href="kontakt.php">Kontakt oss</a></li>
            <li><a class="white-text" href="anvandning.html">Användarvillkor</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <ul>
            <div class="fb-share-button" data-href="http://www.lylho.org" data-layout="button"></div>           
         </ul>   
        </div>    
      </div>
    
      </div>
    <div class="divider"></div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="">Kristoffer Thun</a>
      </div>
    </div>
  </footer>
</div>

  <!--  Scripts-->
   <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
