<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Success</title>
        <link rel="stylesheet" href="styles/main.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet"/>
    </head>
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
      <a href="index.html" id="logo-container"class="brand-logo size white-text">Lylho</a>

      <ul class="right hide-on-med-and-down">
      <li><a href="sass.html"><i class="material-icons white-text">search</i></a></li>
        <li><a class="dropdown-button white-text" href="#!" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a></li>
        <li ><a class="white-text" href="senaste.html">Senast inlaggda</a></li> 
        <li><a class="btn grey darken-2 waves-green btn-large" href="login.php">Logga in</a></li>
        <li><a class="btn grey darken-2 waves-green btn-large" href="register.php">Gå med</a></li>
      </ul>

      <ul id="slide-out" class="side-nav">
        <li><a href="index.html">Hem</a></li>
        <li><a href="#">Söka</a></li>
          <li><a class="dropdown-button black-text" href="#" data-activates="dropdown1">Kategorier<i class="material-icons left">arrow_drop_down</i></a></li>
          <li><a href="senaste_logged_in.php">Senast inlaggda</a></li>
          <li><a href="logout.php">Logga ut</a></li>
      </ul>
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
        <h2>Registrering lyckad!</h2>
        <p>Gå tillbaka och <a href="login.php">logga in</a> för att börja.</p>

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