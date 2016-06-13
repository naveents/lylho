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
    /* .input-field input[type="search"] {
			
			padding-left: 2rem;
			width: calc(100% - 2rem);
     }
     .input-field input[type="search"] + label {
			left: 12rem;
			color:#ffffff;
	  } */
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
      <?php if(isset($_SESSION['is_admin'])): if($_SESSION['is_admin'] == 1): ?>
       <li class="divider"></li>       
       <li><a class="black-text" href="manageposts.php">Publish Posts</a></li>
        <?php endif; endif; ?>
</ul>
<div class="navbar-fixed">
    
    <?php if(isset($_SESSION['username'])) : ?>
           <?php include_once("logged_in_menu.php"); ?>    
    <?php else:?>
         <?php include_once("default-menu.php"); ?>    
    <?php endif; ?>

</div><!--Navigation End-->

<!--Quotes wall -->
<br>
<h4 class="container row center">Humor</h4>

<?php

include_once("includes/db_two.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$nr     = 0;

//get the total count of humors
$rows      = getTotalHumors($conn);
//how many to show per page
$page_rows = 6;
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

$sql = "SELECT * FROM quotes WHERE topic='Humor' AND published=1 ORDER BY date DESC $limit";
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
	
	$sql   = "SELECT count(*) as total FROM quotes WHERE topic='Humor' AND published='1' ORDER BY date DESC";
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
	  <!--
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active grey"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li> -->
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
      © 2016 Copyright Lylho
      Made by <a class="brown-text text-lighten-3" href="">Kristoffer Thun</a>
      </div>
    </div>
  </footer>
  </body>
</html>
