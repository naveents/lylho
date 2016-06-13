<?php
include 'includes/db_connect.php';
include 'includes/functions.php';
sec_session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Lylho - En Citatsamling</title>
    <!-- CSS  -->
    <link rel="stylesheet" type="text/css" href="css/style_p.css" media="screen and (orientation: portrait)">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css"  rel="stylesheet"/>
    <link href="css/style2.css" type="text/css"  rel="stylesheet"/>
        <style type="text/css">
.content_wrapper{width:500px;margin-right:auto;margin-left:auto;}
/*voting style */
.voting_wrapper {display:inline-block;margin-left: 20px;}
.voting_wrapper .down_button {background: url(img/thumbs.png) no-repeat;float: left;height: 14px;width: 16px;cursor:pointer;margin-top: 3px;}
.voting_wrapper .down_button:hover {background: url(img/thumbs.png) no-repeat 0px -16px;}
.voting_wrapper .up_button {background: url(img/thumbs.png) no-repeat -16px 0px;float: left;height: 14px;width: 16px;cursor:pointer;}
.voting_wrapper .up_button:hover{background: url(img/thumbs.png) no-repeat -16px -16px;;}
.voting_btn{float:left;margin-right:5px;}
.voting_btn span{font-size: 11px;float: left;margin-left: 3px;}
</style>
<!--Script-->
<script type="text/javascript">
$(document).ready(function() {
  
  //####### on page load, retrive votes for each content
  $.each( $('.voting_wrapper'), function(){
    
    //retrive unique id from this voting_wrapper element
    var unique_id = $(this).attr("id");
    
    //prepare post content
    post_data = {'unique_id':unique_id, 'vote':'fetch'};
    
    //send our data to "vote_process.php" using jQuery $.post()
    $.post('vote_process.php', post_data,  function(response) {
    
        //retrive votes from server, replace each vote count text
        $('#'+unique_id+' .up_votes').text(response.vote_up); 
        $('#'+unique_id+' .down_votes').text(response.vote_down);
      },'json');
  });

  
  
  //####### on button click, get user vote and send it to vote_process.php using jQuery $.post().
  $(".voting_wrapper .voting_btn").click(function (e) {
    
    //get class name (down_button / up_button) of clicked element
    var clicked_button = $(this).children().attr('class');
    
    //get unique ID from voted parent element
    var unique_id   = $(this).parent().attr("id"); 
    
    if(clicked_button==='down_button') //user disliked the content
    {
      //prepare post content
      post_data = {'unique_id':unique_id, 'vote':'down'};
      
      //send our data to "vote_process.php" using jQuery $.post()
      $.post('vote_process.php', post_data, function(data) {
        
        //replace vote down count text with new values
        $('#'+unique_id+' .down_votes').text(data);
        
        //thank user for the dislike
        alert("Tack! Varje röst räknas, även om det är tummen ner.");
        
      }).fail(function(err) { 
      
      //alert user about the HTTP server error
      alert(err.statusText); 
      });
    }
    else if(clicked_button==='up_button') //user liked the content
    {
      //prepare post content
      post_data = {'unique_id':unique_id, 'vote':'up'};
      
      //send our data to "vote_process.php" using jQuery $.post()
      $.post('vote_process.php', post_data, function(data) {
      
        //replace vote up count text with new values
        $('#'+unique_id+' .up_votes').text(data);
        
        //thank user for liking the content
        alert("Tack! För att du gillar just det gär citatet.");
      }).fail(function(err) { 
      
      //alert user about the HTTP server error
      alert(err.statusText); 
      });
    }
    
  });
  //end 
  
});

</script>     

</head>
<!--Navigation-->
<body>
<?php if (login_check($mysqli) == true) : ?>
<ul id="dropdown1" class="dropdown-content">    
      <li><a class="black-text" href="inspirerande_logged.php">Inspirerande</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="humor_logged.php">Humor</a></li>
      <li class="divider"></li>
  <li><a class="black-text" href="ovrigt_logged.php">Övrigt</a></li>
</ul>
<div class="navbar-fixed">
    <nav class=" grey darken-4">
    <div class="nav-wrapper container">
    
      <div class="row">
         <div class="col s12 m12 l4">            
             <div class="row">
                 <div class="col s7 m7  l6">
                     <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons white-text">menu</i></a> &nbsp;
                     <a href="index_logged.php" id="logo-container" class="brand1logo size white-text" style=" font-size: 3.1rem;">Lylho</a>
                 </div>            
                <div class="col s5 m5  l6">
                    <div class="row">
                    <div class="col s10 col m9 col l9">
                       <form method="post" action="search_logged.php" id="search-form">     
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
      <li><a class="btn grey darken-2 waves-green btn-small" href="post.php">Lägg upp citat</a></li>
        <li><a class="dropdown-button white-text" href="#!" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a></li>
        <li ><a class="white-text" href="senaste.php">Senaste Citaten</a></li> 
        <li><a class="btn grey darken-2 waves-green btn-small" href="includes/logout.php">Logga ut</a></li>
      </ul>
      <ul id="slide-out" class="side-nav">
      <li><a href="index_logged.php">Hem</a></li>
      <!-- Search function when you are on small devices -->
      <li><a href="post.php">Lägg upp citat</a></li>  
        <li><a href="#!">Kategori</a></li>
          <li><a href="senaste.php">Senaste Citaten</a></li>
          <li><a href="includes/logout.php">Logga ut</a></li>
      </ul>
           
      </div>
    </div>
    </div>
  </nav>
</div><!--Navigation End-->

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center white-text text-darken-1">Välkommen till Lylho - En citatsamling</h1>
        <div class="row center">
          <a href="register.php" id="download-button" class="btn grey darken-2 waves-green btn-large">Gå med</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="img/background3.jpg" alt="Unsplashed background img 1"></div>
  </div>

<!--Quotes wall -->
<br>
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

<?php

$servername     = "localhost";
$username       = "thun_lylho";
$password       = "TN&Mpnl;GOB!";
$dbname         = "thun_lylho";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nr     = 0;

$sql = "SELECT * FROM quotes, voting_count WHERE quotes.id = voting_count.unique_content_id ORDER BY vote_up DESC limit 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output     = "";
    while($row  = $result->fetch_assoc() ) {
        $topic   = trim($row["topic"]);
        $quote   = trim($row["quote"]);
        $author  = trim($row["author"]);
        $id      = trim($row["id"]);

        $output .= injectNColumnWrapper(3, $nr, "container row", $nr);
        $output .="<div class='col s12 m6 l4 z-depth-1'>";
        $output .="<div class='card-panel grey darken-4 white-text center'>";
        $output .=" <h5>Citat: {$id}</h5>";
        $output .="</div>";
        $output .="<pre class='flow-text black-text' wrap='soft'>";        
        $output .="<p class='flow-text-p citat'>&#34{$quote}&#34</p>";
        $output .="<p style='font-weight:bold; class='flow-text-p author'>{$author}</p>";
        $output .="<p class='flow-text-p topic'>{$topic}</p>";
        $output .="</pre>";
        $output .="<div class='content_wrapper'>";
        $output .="<h4></h4>";
        $output .="<div class='voting_wrapper' id='vote-{$id}'>";
        $output .="<div class='voting_btn'>";
        $output .="<div class='up_button'>&nbsp;</div>";
        $output .="<span class='up_votes'>0</span>";
        $output .="</div>";
        $output .="<div class='voting_btn'>";
        $output .="<div class='down_button'>&nbsp;</div>";
        $output .="<span class='down_votes'>0</span>";
        $output .="</div>";
        $output .="<br>";
        $output .="</div>";
        $output .="</div>";
        $output .="</div>";
        $nr++;

    }
    $output    .= "</div>";
    echo $output;
}else {
    echo "0 results";
}

$conn->close();

function injectNColumnWrapper($cols_per_row, $closePoint, $cssClass="container row", $nthElem=""){
    $blockDisplay       = "";
    if( ($closePoint == 0) ){
        $blockDisplay   = "<div class='" . $cssClass . " container_nr_" . $nthElem . "'>"  . PHP_EOL;
    }else if( ($closePoint % $cols_per_row) == 0 && ($closePoint != 0) ){
        $blockDisplay   = "</div><div class='" . $cssClass . " container_nr_" . $nthElem . "'>"  . PHP_EOL;
    }
    return $blockDisplay;
}
?>

    
  <!--Footer-->

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
<?php else : ?>
            <h4>Du har inga rättigheter att besöka den här sidan, var vänlig logga in. <a href="index.php">login</h4>.</p>
        <?php endif; ?>
  </body>
</html>
