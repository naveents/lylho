<?php
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'vote_process.php';

?> 
  <!DOCTYPE html>
<html lang="">
<head>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css"  rel="stylesheet"/>
    <link href="css/style2.css" type="text/css"  rel="stylesheet"/>
    <style type="text/css">
    .voting_wrapper {display:inline-block;margin-left: 20px;}
    .voting_wrapper .down_button {background: url(img/thumbs.png) no-repeat;float: left;height: 14px;width: 16px;cursor:pointer;margin-top: 3px;}
    .voting_wrapper .down_button:hover {background: url(img/thumbs.png) no-repeat 0px -16px;}
    .voting_wrapper .up_button {background: url(img/thumbs.png) no-repeat -16px 0px;float: left;height: 14px;width: 16px;cursor:pointer;}
    .voting_wrapper .up_button:hover{background: url(img/thumbs.png) no-repeat -16px -16px;;}
    .voting_btn{float:left;margin-right:5px;}
    .voting_btn span{font-size: 11px;float: left;margin-left: 3px;}
    </style>
    <!-- Script  -->
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>

  <script>$(document).ready(function(){
      $('.parallax').parallax();
    }); </script>
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
<!-- End Script  -->

    <title>Lylho - En Citatsamling</title>
    </head>
    <body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '219431625110292',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

  <ul id="dropdown1" class="dropdown-content">    
      <li><a class="black-text" href="inspirerande.php">Inspirerande</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="humor.php">Humor</a></li>
      <li class="divider"></li>
  <li><a class="black-text" href="ovrigt.php">Övrigt</a></li>
</ul>
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
        <li><a class="dropdown-button white-text" href="#!" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a></li>
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
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center white-text text-darken-1">Välkommen till Lylho - En citatsamling</h1>
        <div class="row center">
        <br>
          <a href="register.php" id="download-button" class="btn grey darken-2 waves-green btn-large">Gå med</a>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="img/background7.jpg" alt="Unsplashed background img 1"></div>
  </div>  

<!--Quotes wall -->

<br>

<h4 class="container row center">Rampljuset - Topp 10</h4>

<?php

include_once("includes/db_two.php");


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
        $output .="<p class='flow-text-p author'>{$author}</p>";        
        $output .="<p class='flow-text-p topic'>{$topic}</p>";
        $output .="</pre>";
        $output .="<div class='content_wrapper'>";
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


  </body>
</html>
