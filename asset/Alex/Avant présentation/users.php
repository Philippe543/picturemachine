<?php
require("inc/init.inc.php");

// Vérification si users est connecté sinon on le redirige sur connexion
if(!utilisateur_est_connecte())
{
    header("location:index.php");
}

$id = "";
$pseudo = "";
$password = "";
$lastname = "";
$firstname = "";
$email = "";
$gender = "";
$status = "";
$erreur = "";
$message .= "";

// RECUPERATION DES INFOS ARTICLE A MODIFIER
 if(isset($_GET['action'])&&$_GET['action'] == 'modification'&&!empty($_GET['id'])&&is_numeric($_GET['id']))

 { 
     
   $id = $_GET['id'];
   $users_modif = $pdo->prepare("SELECT * FROM users WHERE id = :id");
   $users_modif->bindParam(":id", $id, PDO::PARAM_STR);
   $users_modif->execute();
   $users_actuel = $users_modif->fetch(PDO::FETCH_ASSOC);

         $id = $users_actuel['id'];
         $lastname = $users_actuel['lastname'];
         $firstname = $users_actuel['firstname'];
         $password =  $users_actuel['password'];
         $email =  $users_actuel['email'];

 }

 if( isset($_POST["password"]) &&isset($_POST["email"]))
{
    
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $password =  $_POST["password"];
    $email = $_POST["email"];
    
	
	
	// contrôle sur la disponibilité de la reference en BDD si on est dans le cas d'un ajout lors de la modification la reference existera toujours.
	$verif_mem = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$verif_mem->bindParam(":password", $password, PDO::PARAM_STR);
	$verif_mem->bindParam(":email", $email, PDO::PARAM_STR);
	$verif_mem->execute();	
	if($verif_mem->rowCount() > 0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
       {
           // Si le users existe alors la ligne est de 1 
          $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! Cet utilisateur existe déjà !!!</div>';
          $erreur = true ; 
       }
        
         if(empty($password))
       {
         $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! Le pseudo est obligatoire !!! <br />';
         $erreur = true; // Erreur
       }

         if(empty($email))
       {
         $message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! L\' adresse email est obligatoire !!! <br />';
         $erreur = true; // Erreur
       }
         /*
         Récupération de l'ancienne photo dans les cas d'une modification
         if(isset($_GET['action'])&&$_GET['action'] == "modification")
         {
             if(isset($_POST['ancienne_photo']))
             {
                 $photo_BDD = $_POST['ancienne_photo'];
             }
         }
         

       // Vérification upload image
       if(!empty($_FILES['photo']['name']))
       {
         // Si load OK 

        //On concatène la référence sur le titre afin de ne jamais avoir un fichier avec un lastname déjà existant sur le serveur.

        $photo_BDD = $reference.'-'.$_FILES['photo']['name'];

        //Vérification de l'extenion de l'image (extension ok: jpg jpeg png gif)

        $extension = strrchr($_FILES['photo']['name'], '.'); // Cette fonction prédéfinie permet de découper une chaine de caractère fourni en second argument. Renvoie la chaine de caractère après le dernier point.
        
        // On transforme $extension afin que tous les caractères soient en minuscule
        $extension = strtolower($extension); // A l'inverse strtoupper() // On enlève le .

        $extension = substr($extension, 1);  //ex .jpg => jpg

        // Les extension acceptées 
        
        $tab_extension_valide = array("jpg", "jpeg", "png", "gif"); // Nous pouvons donc vérifier si l extension est valide

        $verif_ext = in_array($extension, $tab_extension_valide); // vérifie si les valeurs fournies en 1er argument sont contenues dans le tableau en 2nd argument font partie de celui ci.

        if($verif_ext&&!$erreur)
        {
          // $verif_ext = true et que erreur = false ( il n'y a pas d'erreur au préalable)

          $photo_doc = RACINE_SERVEUR.'photo/'.$photo_BDD;
          copy($_FILES['photo']['tmp_name'], $photo_doc); // copy() permet de copier un fichier depuis un emplacement fournie vers un autre fourni en second. 

        } 
        elseif($verif_ext)
        {
          $message .= '<div class="alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! EXTENSION VALIDE  ( .jpg, .jpeg, .png, .gif )  !!! <br />';
         $erreur = true; // Erreur

        }

       }
       */
        
       // Insertion dans la BDD
        if(!$erreur) // Si $erreur est différent de true alors les contrôles préalables sont ok ! équivaut à if ($erreur == false )

        {  
            
           if(isset($_GET['action'])&&$_GET['action'] == 'ajout')
           {
               
           // Insertion des userss
           $save = $pdo->prepare("INSERT INTO users (password, lastname, firstname, email, status) VALUES (:password, :lastname, :firstname, :email)");

           

           }
           elseif(isset($_GET['action'])&&$_GET['action'] == 'modification' && !empty($id))
           {
               $save = $pdo-> prepare("UPDATE users SET email = :email,  password = :password WHERE id = :id");
               //$id = $_POST['id'];
               $save->bindParam(":id", $id, PDO::PARAM_STR);
               $message .= '<div class="alert-success" role="alert" style="margin-top:20px; text-align:center";> Vos paramètres on bien été modifié</div>';
               
           }
           // echo 'id:';
           // echo '<pre>'; var_dump($id); echo '</pre>';
           // echo '<pre>'; print_r($_POST); echo '</pre><br/>';  

           $save->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
           $save->bindParam(":password", $password, PDO::PARAM_STR);
           $save->bindParam(":lastname", $lastname, PDO::PARAM_STR);
           $save->bindParam(":firstname", $firstname, PDO::PARAM_STR);
           $save->bindParam(":email", $email, PDO::PARAM_STR);
           $save->bindParam(":gender", $gender, PDO::PARAM_STR);
           $save->bindParam(":status", $status, PDO::PARAM_STR);  
           $save->execute();
   
                    
           }
            
           
       }
       
require("inc/header.inc.php"); // la ligne suivante commence les affichage de la page
require("inc/nav.inc.php");

?>
    <!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">
                <?php echo $_SESSION['utilisateur']['pseudo']; ?>
            </div>
            <img src="img/avatar.png" class="img-responsive" style="display: inline-block; width: 140px;" alt="avatar"> <a href="#services" class="fa fa-camera"></a>
            <div class="">
                <div>
                    <?php echo $_SESSION['utilisateur']['lastname'].'&nbsp&nbsp'.$_SESSION['utilisateur']['firstname']; ?>
                </div>
            </div         
        </div>
    </div>
    <?= $message; // balise php inclus un echo ?>
</header>
        <div class="container">
            <section id="tabs">
                <input type="radio" name="tabs" id="story" checked />
                <input type="radio" name="tabs" id="galerie"/>
                <input type="radio" name="tabs" id="photo"/>
                <input type="radio" name="tabs" id="info"/>

                <div class="tabs" >
                    <label for="story" class="tab"><span>Ma story</span></label>
                    <label for="galerie" class="tab"><span>Galeries</span></label>
                    <label for="photo" class="tab"><span>Photos</span></label>
                    <label for="info" class="tab"><span>Mes infos</span></label>
                </div>

                <div class="tabsContents">
                    <div class="tabsContents__content tabsContents__content--story">
                        <!-- TIMELINE -->
                        <section id="story">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <h2 class="section-heading">Ma story</h2>
                                        <h3 class="section-subheading text-muted"></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="timeline">

                            <?php // afficher toutes les photos dans cette page par exemple: un block avec image + titre + prix produit

                        $id = $_SESSION["utilisateur"]['id'];

$query = <<<EOS
SELECT * FROM pictures p
JOIN users u ON p.users_id = u.id
WHERE p.users_id = $id
ORDER BY p.date_picture
EOS;

                            $liste_article = $pdo->query($query);

                            //echo '<div class="row">';
                            
                            $compteur = 0;
                            while($article = $liste_article->fetch(PDO::FETCH_ASSOC))
                            {
                                
                            echo '<li>';
                                echo '<div class="timeline-image">';
                                        echo '<img style="height: 100%; max-width: 100%;" class="img-circle img-responsive" src="' . URL . 'photo/' . $article['photo'] . '" alt="">';
                                echo '</div>';
                                echo '<div class="timeline-panel">';
                                    echo '<div class="timeline-heading">';
                                        echo '<h4>' . $article['date_picture'] . '</h4>';
                                        echo '<h4 class="subheading">' . $article['title'] . '</h4>';
                                    echo '</div>';
                                    echo '<div class="timeline-body">';
                                        echo '<h5 class="subheading">' . $article['header'] . '</h5>';
                                        echo '<p class="text-muted">' . $article['content'] . '<p>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</li>';

                            }				
                            
                            // echo '</div>';		 


                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tabsContents__content tabsContents__content--galerie">
                        <h2>Galeries</h2>
                        <p>123456789AZERTYUIOP</p>   
                    </div>
                    <div class="tabsContents__content tabsContents__content--photo">
                        <h2>Photos</h2>
                    <p>blablabla</p>
                    </div>
                    <div class="tabsContents__content tabsContents__content--info">
                        <h2>Mes infos</h2>
                        <br>
                        <div class="row">
                        <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span style="display: inline-block; width: 70px; font-style: italic;">Pseudo: </span><?php echo $_SESSION['utilisateur']['pseudo'];?>
                                    </li>
                                    <li class="list-group-item">
                                        <span style="display: inline-block; width: 70px; font-style: italic;">Nom: </span><?php echo $_SESSION['utilisateur']['lastname'];?>
                                    </li>
                                    <li class="list-group-item">
                                        <span style="display: inline-block; width: 70px; font-style: italic;">Prénom: </span><?php echo $_SESSION['utilisateur']['firstname'];?>
                                    </li>
                                    <li class="list-group-item">
                                        <span style="display: inline-block; width: 70px; font-style: italic;">Email: </span><?php echo $_SESSION['utilisateur']['email'];?>
                                    </li>	
                                    <li class="list-group-item" style="text-align:center;"> 
                                        <a onclick="return(confirm(\'MODIFIER VOTRE PROFIL ?\'));" href="?action=modification&id='.$users['id'].'" type="button" class="btn btn-primary">Modifier compte</a>  
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4"></div>
		                </div>
                    </div>
                </div>
            </section>
           
		
	</div><!-- /.container -->
	
	 <?php // Affichage du formulaire d'enregistrement users  
        
        if(isset($_GET['action']) && ($_GET['action'] == 'ajout'|| $_GET['action'] == 'modification'))
        {
    ?>

              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">Modification de votre compte</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>"/>
                            <input type="hidden" name="pseudo" id="pseudo" class="form-control" value="<?php echo $pseudo; ?>"/>
                                <div class="form-group">
                                    <label for="email" >Adresse email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="EMAIL"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" >Mot de passe actuel</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="MOT DE PASSE ACTUEL"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" >Nouveau mot de passe </label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="NOUVEAU MOT DE PASSE"/>
                                </div>
                                <div class="form-group">
                                    <label for="password" >Comfirmer le nouveau mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="COMFIRMER LE NOUVEAU MOT DE PASSE"/>
                                </div>
                        </form>
                            <button type="button" class="form-control btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"style="color:white;text-align:center;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        }  // Accolade: if(isset($_GET['action'])&&$_GET['action'] == 'ajout');
    ?>

<?php 
require("inc/footer.inc.php");
