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