<?PHP
/*
    Contact Form from HTML Form Guide
    This program is free software published under the
    terms of the GNU Lesser General Public License.
    See this page for more info:
    http://www.html-form-guide.com/contact-form/simple-php-contact-form.html
*/
require_once("contact/include/fgcontactform.php");

$formproc = new FGContactForm();


//1. Add your email address here.
//You can add more than one receipients.
$formproc->AddRecipient('thun.kristoffer@gmail.com'); //<<---Put your email address here


//2. For better security. Get a random tring from this link: http://tinyurl.com/randstr
// and put it here
$formproc->SetFormRandomKey('CnRrspl1FyEylUj');


if(isset($_POST['submitted']))
{
   if($formproc->ProcessForm())
   {
        $formproc->RedirectToURL("thank-you.php");
   }
}

?>


<?php
if(isset($_POST["submit"])){
// Checking For Blank Fields..
if($_POST["vname"]==""||$_POST["vemail"]==""||$_POST["sub"]==""||$_POST["msg"]==""){
echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
$email=$_POST['vemail'];
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
$subject = $_POST['sub'];
$message = $_POST['msg'];
$headers = 'From:'. $email2 . "\r\n"; // Sender's Email
$headers .= 'Cc:'. $email2 . "\r\n"; // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
$message = wordwrap($message, 70);
// Send Mail By PHP Mail Function
mail("thun.kristoffer@gmail.com", $subject, $message, $headers);
echo "Ditt meddelande har skickats! Tack för din feedback.";
}
}
}

?>




<!DOCTYPE html>
<html lang="sv">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Lylho</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet"/>
   <link href="css/style2.css" type="text/css" rel="stylesheet"/>
</head>
<!--Navigation-->
<body>
 <ul id="dropdown1" class="dropdown-content">
    
  <li><a class="black-text" href="inspirerande.html">Inspirerande</a></li>
  <li class="divider"></li>
  <li><a class="black-text" href="humor.html">Humor</a></li>
  <li class="divider"></li>
  <li><a class="black-text" href="rad.html">Råd</a></li>

  <li><a class="black-text" href="ovrigt.html">Övrigt</a></li>
</ul>

    <nav class="grey darken-4">

    <div class="nav-wrapper container">
      <a href="index.php" id="logo-container"class="brand-logo size white-text">Lylho</a>

      <ul class="right hide-on-med-and-down">
      <li><a href="sass.html"><i class="material-icons white-text">search</i></a></li>
        <li><a class="dropdown-button white-text" href="#" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a></li>
        <li ><a class="white-text" href="senaste.html">Senast inlaggda</a></li> 
        <li><a class="btn grey darken-2 waves-green btn-large" href="login.php">Logga in</a></li>
        <li><a class="btn grey darken-2 waves-green btn-large" href="register.php">Gå med</a></li>
      </ul>

      <ul id="slide-out" class="side-nav black-text">
      <li><a href="index.php">Hem</a></li>
        <li><a href="#">Söka</a></li>
          <li><a href="#">Kategori</a></li>
          <li><a href="senaste.html">Senast inlaggda</a></li>
          <li><a href="login.php">Logga in</a></li>
          <li><a href="register.php">Gå med</a></li>
      </ul>
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons white-text">menu</i></a>
    </div>
  </nav>


      </div><br><br>

      <div class="parallax"><img src="background3.jpg" alt="Unsplashed background img 1"></div>


<!--Contact form-->
    <h1 class="black-text">Kontakta oss</h1>
<div id="sa_contactdiv" class="container row z-depth-1" >
    <form  name=sa_htmlform style="margin:0px" onsubmit="return sa_contactform()">
      <table>
        <tr><td>E-mail Address: <span style="color:#D70000">*</span><br><input  class="black-text" type="text" name="vemail" required="true" /></td></tr>
          <tr><td>Subject: <span style="color:#D70000">*</span><br><input class="black-text" type="text" name="sub" required="true" /></td></tr>
          <tr><td>Message: <span style="color:#D70000">*</span><br><textarea class="black-text" name="msg" cols="42" rows="6" required="true"></textarea></td></tr>
        <tr><td>

        <input id="send" name="submit" class="btn grey darken-2" type="submit" value="Skicka"> 
      </table>
    </form><div style="padding-top:10px"></div>

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

  <script type='text/javascript'>

    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("message","maxlen=2048","The message is too long!(more than 2KB!)");
</script>
    
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  </body>
</html>
