<?php
// assets/alex
// Menu supp réservé aux admins

// code de déconnexion
if(isset($_GET['action']) && $_GET['action'] =='deconnexion' )
{
  session_destroy();
  header("location:index.php");
}

$nav_admin = '
<div id="navbar-collapse" class="collapse navbar-collapse">
  <ul class="nav navbar-nav navbar navbar-inverse">
      <li><a href="' . URL . 'admin/stats.php"> STATS</a></li>
      <li><a href="' . URL . 'admin/gestion_users.php"> GESTION UTILISATEURS</a></li>
      <li><a href="' . URL . 'admin/gestion_galeries.php"> GESTION GALERIES</a></li>
      <li><a href="' . URL . 'admin/gestion_avis.php"> GESTION PHOTOS</a></li>
      <li><a href="' . URL . 'admin/gestion_produit.php"> GESTION COMMENTAIRES</a></li>
  </ul>
</div>';
?>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
  <div class="container">
    <!-- Burger Menu pour l'affichage mobile -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
          <a class="navbar-brand page-scroll"  href="<?php echo URL; ?>index.php"><span class="fa fa-camera"></span> TimeMachine</a> <!-- href="#page-top" -->
        </div>


         <!-- Collecter the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="hidden">
              <a href="#page-top"></a>
            </li>
            <li>
               <a href="<?php echo URL; ?>index.php#page-top">Accueil</a>
            </li>
            <li>
              <a class="page-scroll" href="<?php echo URL; ?>index.php#services">Services</a>
            </li>
            <li>
               <a class="page-scroll" href="<?php echo URL; ?>index.php#galeries">Galeries</a>
            </li>
            <li>
              <a class="page-scroll" href="<?php echo URL; ?>index.php#story">Story</a>
            </li>
            <li>
              <a class="page-scroll" href="<?php echo URL; ?>index.php#team">&#201;quipe</a>
            </li>
            <li>
              <a class="page-scroll" href="#">Contact</a>
            </li>
             <!-- Barre de recherche -->  
            <!--  

            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Recherche">
              </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            
            --> 
            <ul class="nav navbar-nav navbar-right navbar-btn">
             
              <?php 
                    if(!users_co())
                    {
              ?>
                <!-- diff de code a analyser ->  pas de href dans les buttons -->
                <div class="btn-group">
                 <!-- Button trigger modal -->  
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#connexion">
                    Connexion
                  </button>
                  <button data-toggle="modal" data-target="#inscription" type="submit" class="btn btn-default" >Inscription</button>
                </div>
            </ul>

              <?php
                    }
                    else{ 
              ?>
                  <a href="<?php echo URL;?>users.php" class="btn btn-basic" type="submit"><span class="glyphicon glyphicon-user"></span> Mon compte</a>
                  <a href="<?php echo URL; ?>connexion.php?action=deconnexion" class="btn" type="submit"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a>
            </ul>
                <?php // Menu supp réservé aux admins
                    if(users_admin())
                    {
                    echo $nav_admin;
                    }
                ?>
              <?php  } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
     


     
                    
      