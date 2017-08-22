<?php
// code de déconnexion
if(isset($_GET['action']) && $_GET['action'] =='deconnexion' )
{
  session_destroy();
  header("location:index.php");
}

// Menu supp réservé aux admins
$nav_admin = '
<div id="navbar-collapse" class="collapse navbar-collapse">
  <ul class="nav navbar-nav navbar navbar-inverse">
      <li><a href="' . URL . 'admin/stats.php"> STATS</a></li>
      <li><a href="' . URL . 'admin/gestion_users.php"> GESTION UTILISATEURS</a></li>
      <li><a href="' . URL . 'admin/gestion_galeries.php"> GESTION GALERIES</a></li>
      <li><a href="' . URL . 'admin/gestionphotos.php"> GESTION PHOTOS</a></li>
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
               <a href="<?php echo URL; ?>index.php">Accueil</a>
            </li>
            <li>
               <a class="page-scroll" href="#portfolio">Galeries</a>
            </li>
            <li>
              <a class="page-scroll" href="#about">About</a>
            </li>
            <li>
              <a class="page-scroll" href="#team">&#201;quipe</a>
            </li>
            <li>
              <a class="page-scroll" href="#contact">Contact</a>
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
            <!-- ul différente selon que l'on est connecté ou pas -->
            <ul class="nav navbar-nav navbar-right navbar-btn">             
              <?php 
                    if(!utilisateur_est_connecte())
                    {
              ?>
                <div class="btn-group">
                  <button data-toggle="modal" data-target="#login-modal" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span>
                  <a href="#"> Connexion</a></button>
                  <button href="<?php echo URL; ?>inscription.php" data-toggle="modal" data-target="#login-modal" type="submit" class="btn btn-default" >Inscription</button>
                </div>
            </ul><!-- fermeture ul si user non connecté -->
<!-- // pb headers already sent by (output started at C:\xampp\htdocs\pictmachine\inc\nav.inc.php:75) -->
              <?php
                    } else { // si user connecté
              ?>
                  <a  href="<?php echo URL; ?>users.php" class="btn btn-basic" type="submit"><span class="glyphicon glyphicon-user"></span> Mon compte</a>
                  <a href="<?php echo URL; ?>?action=deconnexion" class="btn" type="submit"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a>
            </ul><!-- fermeture ul si user connecté -->
                <?php // Menu supp réservé aux admins
                    if(utilisateur_est_admin())
                    {
                      echo $nav_admin;
                    }
                ?>
             <?php } //fin du else user connecté ?>
          </ul>
        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!-- fin NAVIGATION -->
                   


    <!-- MODAL CONNEXION -->
    <!-- code connexion -->
    <?php //require('connexion.php'); 
    // CODE DE VERIFICATION


    //Vérification de l'existence des indices du formulaire
    if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['login']))
    {
      $pseudo = $_POST['pseudo'];
      $password = $_POST['password'];
      
      $verif_connexion =$pdo->prepare("SELECT * FROM users WHERE pseudo= :pseudo AND password= :password");
      $verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
      $verif_connexion->bindParam(":password", $password, PDO::PARAM_STR);
      $verif_connexion->execute(); 
      
      
      if($verif_connexion->rowCount() > 0)
      {
        //si nous avons 1 ligne alors le pseudo et le mdp sont corrects
        $info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = array();
        $_SESSION['utilisateur']['id'] = $info_utilisateur['id'];
        $_SESSION['utilisateur']['lastname'] = $info_utilisateur['lastname'];
        $_SESSION['utilisateur']['firstname'] = $info_utilisateur['firstname'];
        $_SESSION['utilisateur']['gender'] = $info_utilisateur['gender'];
        $_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
        $_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
        $_SESSION['utilisateur']['status'] = $info_utilisateur['status'];
               
        //header("location:index.php");
        ?>
        <script>
        window.location.assign('index.php');
        </script>
        <?php
        //$message='<div class="alert alert-success" role="success" style="margin-top:20px;">L\'enregistrement s\'est effectué<br /></div>';

      }
      else
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention les informations saisies sont erronées<br />Veuillez recommencer</div>';
      }	
    }
    ?>
    <!-- affichage modal connexion -->
    <div class="row">
        <div class="col-sm-4" >
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="loginmodal-container">
                        <h3><span style="color:#337ab7; text-align=center;"><i>Connectez-vous</i></h3><br>
                            <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="PSEUDO" style="font-style:italic;" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="MOT DE PASSE" style="font-style:italic;"/> <!-- type="password" -->
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" class="btn btn-primary" >Connexion</span>
                                </div>
                            </form>
                    </div>
                </div>
            </div><!-- fin div.modal fade -->
        </div>
    </div><!-- fin modal connexion -->