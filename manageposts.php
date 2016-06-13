<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
//if (isset($_COOKIE['lylho_user'])) {
    //echo $_COOKIE['lylho_user'];
//}
if(!is_logged_in()){
      header("Location:login.php");exit;
}
if($_SESSION['is_admin'] == 0): 
     header("Location:index.php");exit;
endif;
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
  
               <h2 class="center">Välkommen <?php echo htmlentities($_SESSION['username']); ?>!</h2>       
               <h5 class="center">Approve Posts</h5>
               
               <?php

include_once("includes/db_two.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_GET['id'])){
    
     $action  = $_GET['action'];
      $q_id    = $_GET['id'];      
     if($action == "a") {
      $stmt = $conn->prepare("UPDATE quotes SET published=? WHERE id=?");
      if ($stmt === false) {
        trigger_error($this->mysqli->error, E_USER_ERROR);
      }
      $published = 1;
     
      $stmt->bind_param('ii', $published, $q_id);
      $status = $stmt->execute();
      if ($status === false) {
        trigger_error($stmt->error, E_USER_ERROR);
      }
    }
    
    if($action == "d"){
        
                //delete some some data
        $del = 'DELETE from quotes where id=?';
        $preparedStatement = $conn->prepare($del);
        $preparedStatement->bind_param('i', $q_id);
        $preparedStatement->execute();
        
    }
    
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$nr     = 0;

//get the total count of humors
$rows      = getTotalHumors($conn);
//how many to show per page
$page_rows = 25;
$last      = ceil($rows/$page_rows);
if($last < 1){
	$last = 1;
}
$pagenum = 1;
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$sql = "SELECT * FROM quotes WHERE published=0 ORDER BY date DESC $limit";
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
        $output .="";
        $output .="<a class='btn green darken-2 waves-green btn-small' href='manageposts.php?id={$id}&action=a'>Approve</a>";
        $output .="";
        $output .="";
        $output .="";
        $output .="<a class='btn red darken-2 waves-green btn-small' href='manageposts.php?id={$id}&action=d'>Delete</a>";
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
    echo "<div class='row'><div class='col s6  offset-s3'><div class='card-panel deep-orange darken-1'>Sorry No Results Found! </div></div></div>";
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

function getTotalHumors($conn){
	
	$sql   = "SELECT count(*) as total FROM quotes WHERE published='0' ORDER BY date DESC";
	$query = mysqli_query($conn, $sql);
	$row   = mysqli_fetch_row($query);	
	$rows  = $row[0];
	return $rows;
	
}

$paginationCtrls = '';
if($last != 1){

	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<li class="waves-effect"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"><i class="material-icons">chevron_left</i></a> </li>';
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-6; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li class="waves-effect"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> </li> ';
			}
	    }
    }
    else{
		$paginationCtrls .= '<li class="disabled"><a href="javascript:void(0);"><i class="material-icons">chevron_left</i></a> </li>';
	}
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active grey"><a href="javascript:void(0);">'.$pagenum.'</a></li>';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li class="waves-effect"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> </li> ';
		if($i >= $pagenum+6){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' <li class="waves-effect"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><i class="material-icons">chevron_right</i></a> </li>';
    }
}
	
	
?>

<div class="container">
  <ul class="pagination center">
    <?php echo $paginationCtrls; ?>
  </ul>        
</div>
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

  </body>
</html>