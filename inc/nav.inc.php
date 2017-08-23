<?php

// code de déconnexion
if(isset($_GET['action']) && $_GET['action'] =='deconnexion' )
{
  session_destroy();
  header("location:index.php");
}


/*---------------------------------------------------------------------
                      CODE DE VERIFICATION
---------------------------------------------------------------------*/
    // LOGIN-----------------------------------------------------------
    //Vérification de l'existence des indices du formulaire de login
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
        //Création de la session
        $info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = array();
        $_SESSION['utilisateur']['id'] = $info_utilisateur['id'];
        $_SESSION['utilisateur']['lastname'] = $info_utilisateur['lastname'];
        $_SESSION['utilisateur']['firstname'] = $info_utilisateur['firstname'];
        $_SESSION['utilisateur']['gender'] = $info_utilisateur['gender'];
        $_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
        $_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
        $_SESSION['utilisateur']['status'] = $info_utilisateur['status'];
               
        
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
    //FIN LOGIN-------------------------------------------------------

    //INSCRIPTION-----------------------------------------------------
    // déclaration de cariables vides pour affichage dans les values du formulaire
    $lastname="";
    $firstname="";
    $gender="";
    $pseudo="";
    $email="";
    $password="";
    $passwordcheck="";


    //variable de contrôle
    $erreur = "";
    $message = "";

    // contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
    if(isset($_POST['lastname']) && 
    isset($_POST['firstname']) && 
    isset($_POST['gender']) && 
    isset($_POST['pseudo']) && 
    isset($_POST['email']) && 
    isset($_POST['password']) && 
    isset($_POST['passwordcheck']))
    {
      
      //le formulaire a été validé, on place dans ces variables, les saisies correspondantes.
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $gender = $_POST['gender'];
      $pseudo = $_POST['pseudo'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $passwordcheck = $_POST['passwordcheck'];

      //Contrôle sur le nom
      // contrôle sur la taille du lastname (entre 2 et 50 caractères inclus)
      if (iconv_strlen($lastname)< 2 || iconv_strlen($lastname)>50 )
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, la taille du nom est incorrecte.<br />le nom  doit avoir entre 2 et 50  caractères inclus</div>';
        $erreur= true; // si l'on rentre dans cette condition alors il y a une erreur.
      }

      // Vérification des caractères autorisés pour le nom
      $verif_caracteres =preg_match('#^[a-zA-Z._-]+$#',$lastname);

      if(!$verif_caracteres && !empty($lastname))
      {
        $message .='<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, caractères non autorisés dans le nom.<br />Caractères autorisés : A-Z </div>';
        $erreur= true;
      }
            
      //Contrôle sur le prénom
      // contrôle sur la taille du lastname (entre 2 et 50 caractères inclus)
      if (iconv_strlen($firstname)< 2 || iconv_strlen($firstname)>50 )
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, la taille du prénom est incorrecte.<br />le prénom  doit avoir entre 2 et 50  caractères inclus</div>';
        $erreur= true; // si l'on rentre dans cette condition alors il y a une erreur.
      }

      // Vérification des caractères autorisés pour le nom
      $verif_caracteres =preg_match('#^[a-zA-Z._-]+$#',$firstname);

      if(!$verif_caracteres && !empty($firstname))
      {
        $message.='<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, caractères non autorisés dans le prénom.<br />Caractères autorisés : A-Z</div>';
        $erreur= true;
      }

      //contrôle du Pseudo
      // contrôle sur la taille du pseudo (entre 4 et 14 caractères inclus)

      if (iconv_strlen($pseudo)< 4 || iconv_strlen($pseudo)>14 )
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, la taille du pseudo est incorrecte.<br />En effet, le pseudo  doit avoir entre 4 et 14  caractères. inclus</div>';
        $erreur= true; // si l'on rentre dansq cette condition alors il y a une erreur.
      }

      $verif_caracteres =preg_match('#^[a-zA-Z0-9._-]+$#',$lastname);

      if(!$verif_caracteres && !empty($pseudo))
      {
        $message.='<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, caractères non autorisés dans le nom.<br />Caractères autorisés : A-Z et 0-9, - _ </div>';
        $erreur= true;
      }
      //Vérification de l'email
      //vérification de la saisie de l'email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email))
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, le format de email est invalide<br />Veuillez vérifier votre saisie</div>';
        $erreur= true;
      }
      
      // Vérification de la disponibilité de l'email en BDD.
      $verif_email =$pdo->prepare("SELECT * FROM users WHERE email =:email");
      $verif_email->bindParam(":email", $email, PDO::PARAM_STR);
      $verif_email->execute();
      var_dump($verif_email->rowcount());
      if($verif_email->rowcount() > 0)
      {
        //si l'on obtient au moins 1 ligne de résultat alors le pseudo est déjà pris.
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, l\'email n\'est pas disponible<br />Veuillez utiliser un autre email</div>';
        $erreur= true;		
      }
      
      

      //Vérification de la disponibilité du pseudo en BDD.
      $verif_pseudo =$pdo->prepare("SELECT * FROM users WHERE pseudo =:pseudo");
      $verif_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
      $verif_pseudo->execute();
      var_dump($verif_pseudo->rowcount());
      if($verif_pseudo->rowcount() > 0)
      {
        //si l'on obtient au moins 1 ligne de résultat alors le pseudo est déjà pris.
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, le pseudo n\'est pas disponible<br />Veuillez utiliser un autre email</div>';
        $erreur= true;		
      }
      
      //Vérification du mot de passe
      if($password !=$passwordcheck)
      {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, le mot de passe de confirmation n\'est pas identique au mot de passe initiale<br />Veuillez vérifier votre mot de passe</div>';
        $erreur= true;		
      }
      
      //Insertion dans la BDD
      if($erreur !== true) // si $erreur est différent de true alors les contrôles préalables sont ok !
      {          
        $enregistrement =$pdo->prepare("INSERT INTO users (lastname, firstname, gender, pseudo, email, password, status) VALUES (:lastname, :firstname, :gender, :pseudo, :email, :password, 0)");
        $enregistrement->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $enregistrement->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $enregistrement->bindParam(":gender", $gender, PDO::PARAM_STR);
        $enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $enregistrement->bindParam(":email", $email, PDO::PARAM_STR);
        $enregistrement->bindParam(":password", $password, PDO::PARAM_STR);
        $enregistrement->execute();
          
        $message='<div class="alert alert-success" role="success" style="margin-top:20px;">L\'enregistrement s\'est effectué<br /></div>';

        // On redirige sur index.php
        // EN MODE CONNECTE CE SERAIT BIEN
        ?>
          <script>
          window.location.assign('index.php');
          </script>
        <?php
      }
    }


    //fin INSCRIPTION-------------------------------------------------

/*---------------------------------------------------------------------
                      FIN CODE DE VERIFICATION
---------------------------------------------------------------------*/

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

        <!-- AFFICHAGE DES LIENS QUAND PAS DE SCROLL A FAIRE -->
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
               <a class="page-scroll" href="index.php#galeries">Galeries</a>
            </li>
            <li>
              <a class="page-scroll" href="<?php echo URL; ?>index.php#story">Story</a>
            </li>
            <li>
              <a class="page-scroll" href="<?php echo URL; ?>index.php#team">&#201;quipe</a>
            </li>
            <li><!-- va devenir un modal -->
              <a class="page-scroll" href="#contact">Contact</a>
            </li>

            <!-- ul différente selon que l'on est connecté ou pas -->
            <ul class="nav navbar-nav navbar-right navbar-btn">             
              <?php 
                    if(!utilisateur_est_connecte())
                    {
              ?>                
                <div class="btn-group">                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">Connexion</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sign-in-modal">Inscription</button>
                </div>
            </ul><!-- fermeture ul si user non connecté -->

              <?php
                    } else { // si user connecté
              ?>
                  <a href="<?php echo URL; ?>users.php" class="btn btn-basic" type="submit"><span class="glyphicon glyphicon-user"></span> Mon compte</a>
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

    <!-- code connexion - A METTRE EN HAUT DU FICHIER -->
    <?php 
    
    ?>
    
    <!-- affichage modal connexion -->
    <!-- mettre $message -->
    <div class="row">
        <div class="col-sm-4" >
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="loginmodal-container">
                        <h3><span style="color:#337ab7; text-align=center;"><i>Connectez-vous</i></span></h3><br>
                            <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="PSEUDO" style="font-style:italic;" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="MOT DE PASSE" style="font-style:italic;"/> <!-- type="password" -->
                                </div>
                                <div class="form-group">
                                    <!-- rajout form-control -->
                                    <button type="submit" name="login" class="btn btn-primary form-control" >Connexion</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div><!-- fin div.modal fade -->
        </div>
    </div><!-- fin modal connexion -->


    <!-- affichage modal inscription id="sign-in-modal-->
    <!-- mettre $message -->
    <div class="row">
        <div class="col-sm-4" >
            <div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="loginmodal-container">
                        <h3><span style="color:#337ab7; text-align=center;"><i>Inscrivez-vous</i></span></h3><br>

                            <!-- début formulaire -->
                            <form method="post" action="">

                                <div class="form-group">
						                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Votre nom" value="<?php echo $lastname; ?>" style="font-style:italic;">	
                                </div>

                                <div class="form-group">
                                  <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>" style="font-style:italic;">
                                </div>

                                <div class="form-group">
                                  <select name="gender" id="gender" class="form-control" style="font-style:italic;">
                                    <option value="m">Homme</option>
                                    <option value="f" <?php if($gender =='f'){echo 'selected';} ?> >femme</option>
                                  </select>
                                </div>

                                <div class="form-group">            
                                  <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Votre pseudo" value="<?php echo $pseudo; ?>" style="font-style:italic;">
                                </div>

                                <div class="form-group">
                                  <input type="text" name="email" id="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>" style="font-style:italic;">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="MOT DE PASSE" style="font-style:italic;">
                                </div>

                                <div class="form-group">
                                  <input type="password" name="passwordcheck" id="passwordcheck" class="form-control" placeholder="Confirmez votre mot de passe" style="font-style:italic;">
                                </div>

                                <div class="form-group">              
                                    <button type="submit" name="sign-in" class="btn btn-primary form-control" >Inscription</button>
                                </div>
                            </form><!-- fin formulaire -->
                    </div>
                </div>
            </div><!-- fin div.modal fade -->
        </div>
    </div><!-- fin modal inscription -->