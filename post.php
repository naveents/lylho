<?php
include 'includes/db_connect.php';
include 'includes/functions.php';
if(!is_logged_in()){
      header("Location:login.php");exit;
}
?>

<!DOCTYPE html>
<html lang="">
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
      <li><a class="black-text" href="inspirerande_logged.php">Inspirerande</a></li>
      <li class="divider"></li>
      <li><a class="black-text" href="humor.php">Humor</a></li>
      <li class="divider"></li>
    <li><a class="black-text" href="ovrigt_logged.php">Övrigt</a></li>
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

<?php
include_once("includes/db_two.php");
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$author = $conn->real_escape_string($_POST["author"]);
$quote = $conn->real_escape_string($_POST["quote"]);
$topic = $conn->real_escape_string($_POST["topic_val"]);
$sql = "INSERT INTO quotes (author, quote, topic, published) VALUES ('$author', '$quote', '$topic','0')";


  if ($conn->query($sql) === TRUE) {
    echo "<h4 class='center'>Citatet har mottagits, och kommer att granskas!</h4>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>

  

   <h2 class="center black-text">Välkommen</h2>

        <!--Post-->    
        <h4 class="center black-text">Lägga upp dina citat här</h4>
        <h5 class="center black-text">Lylho är intresserad av citat och kommentarer från alla typer av källor. Allt som läggs upp granskas och vi accepterar inte rasistiskt eller stötande matrial.</h5>
        <div class="container">
        <form action="" method="post" name="quote_form">  

          Källa: <input class="black-text" type="text" name="author" id="author" minlength="4" maxlength="30" />
            Citat:    <textarea class="black-text" name="quote" minlength="15" spellcheck="true" maxlength="200"></textarea> 
            
            <div class="input-field field-wrap">

        <select class="browser-default" name="topic_val">
            <option value="" selected>Välj vilken kategori</option>
            <option value="Humor">Humor</option>
            <option value="Inspirerande">Inspirerande</option>
            <option value="Övrigt">Övrigt</option>
          </select>
    
            </div>
                       
            <button name ="submit" type="submit" value="submit" class="btn grey darken-2">Lägg upp citat</button>
    </form>

</div>
<!-- /form -->
<br>
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
            <li><a class="white-text" href="kontakt.html">Kontakt oss</a></li>
            <li><a class="white-text" href="anvandning.html">Användarvillkor</a></li>
            
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Anslut dig</h5>
          <ul>
       
            <div class="fb-share-button" data-href="http://www.lylho.org" data-layout="button"></div>            
         </ul>   
        </div>     
      </div>
      </div>
    <div class="divider"></div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Thun K</a>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
   <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>