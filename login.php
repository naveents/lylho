<?php
include 'includes/db_connect.php';
$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error center">Den här mailadressen är felaktig, var vänlig försök igen.</p>';
    }
    
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="center error center">Ogiltligt lösenord, var vänlig försök igen.</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
    
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error center">En användare med den här mailadressen finns redan, var vänlig försök igen.</p>';
        }
    }
    
    // TODO:
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512',
          uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {

            $insert_stmt->bind_param('ssss',
            $username,
            $email,
            $password,
            $random_salt);

            // Execute the prepared query.
            $insert_stmt->execute();
        }
        header('Location: ./register_success.php');
    }
}
if((isset($_COOKIE['lylho_user']) && $_COOKIE['lylho_user'] != '') || isset($_SESSION['username']) ){
        header("Location:protected_page.php"); exit;
}
?>

  <!DOCTYPE html>
<html lang="">
<head>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    

    <title>Lylho - En Citatsamling</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css"  rel="stylesheet"/>
    <!-- <link href="css/style2.css" type="text/css"  rel="stylesheet"/> -->
    </head>
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

  
<div class="navbar-fixed">
    <nav class=" grey darken-4">
    <div class="nav-wrapper container">
    
      <div class="row">
         <div class="col s12 m12 l4">            
             <div class="row">
                 <div class="col s7 m7  l6">
                     <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons white-text">menu</i></a> &nbsp;
                     <a href="index.php" id="logo-container" class="brand1logo size white-text" style=" font-size: 3.1rem;">Lylho</a>
                 </div>            
                <div class="col s5 m5  l6">
                    <div class="row">
                    <div class="col s10 col m9 col l9">
                       <form method="post" action="search.php" id="search-form">     
                          <input id="search" type="search" name="search" required>                          
                      </form>
                    </div>
                    <div class="col s2 col m3 col l3">
                        <a href="javascript:void(0);" id="search-start" onclick="document.getElementById('search-form').submit();"><i class="material-icons white-text">search</i></a>
                    </div>
                    </div>  
                </div> 
              </div> 
         </div>
   
      <div class="col s12 m12 l8">
      <ul class="right hide-on-med-and-down">
    <!--  <li> <a href="sass.html"><i class="material-icons white-text">search</i></a>     
      
      </li> -->
      <!-- Dropdown Trigger -->
        <li><a class="dropdown-button white-text" href="#!" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a>
         <ul id="dropdown1" class="dropdown-content">    
      <li><a class="black-text" href="inspirerande.php">Inspirerande</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="humor.php">Humor</a></li>
      <li class="divider"></li>
  <li><a class="black-text" href="ovrigt.php">Övrigt</a></li>
</ul>
        
        </li>
        <li ><a class="white-text" href="senaste.php">Senast inlaggda</a></li> 
        <li><a class="btn grey darken-2 waves-green btn-small" href="login.php">Logga in</a></li>
        <li><a class="btn grey darken-2 waves-green btn-small" href="register.php">Gå med</a></li>
      </ul>
      <ul id="slide-out" class="side-nav">
      <li><a href="index.php">Hem</a></li>
      <!-- Search function when you are on small devices -->  
        <li><a href="#">Söka</a></li>
        <li><a href="#!">Kategori</a></li>
          <li><a href="senaste.php">Senast inlaggda</a></li>
          <li><a href="login.php">Logga in</a></li>
          <li><a href="register.php">Gå med</a></li>
      </ul>
           
      </div>
    </div>
    </div>
  </nav>
</div><!--Navigation End-->
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <br>
        <h2 class="center black-text">Logga in</h2>
      <!--Login form-->
    <div class="container">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Ogiltlig inloggning, var vänlig försök igen.</p>';
        }
        ?> 
        <br>
     
        <form action="includes/process_login.php" method="post" name="login_form">      
            E-post: <input class="black-text" type="text" name="email" />
            Lösenord: <input class="black-text" type="password" 
                             name="password" 
                             id="password"/>
            
            <p>
                <input type="checkbox" class="filled-in black-text" id="remember" name="remember" value="true" />
               <label for="remember" style="color:#000000;">Remember Me</label>
             </p>
             
             
            <button class="btn grey darken-2" type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);">Login </button> 
                   <p>Eller logga in via Facebook</p>
                   <fb:login-button data-size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button>
                    <div id="status"></div>
        </form>
        <p>Om du saknar ett login på Lylho så kan du <a class="btn disabled" href="register.php">registrera här</a></p>
        

      </div> 
    
<!--End Login form-->       
<!--Footer-->
<br>
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
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>




  </body>
</html>