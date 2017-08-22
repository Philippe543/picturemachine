<?php require("../inc/init.inc.php");

if(!utilisateur_est_connecte())
{
    header("location:index.php");
}

require("../inc/header.inc.php"); // la ligne suivante commence les affichage de la page
require("../inc/nav.inc.php");


// Mettre en place un controle quand l'admin veut une suppression de users
 if(isset($_GET['action'])&&$_GET['action'] == 'suppression'&&!empty($_GET['id'])&&is_numeric($_GET['id']))

 {
      // is_numeric est permet de savoir si l'information est bien une valeur numérique sans tenir compte de son type (les informations provenant de GET et de POST sont toujours de type string) 
      // on fait une requete pour récupérer les informations de l'article afin de connaitre la photo pour la supprimer
      
    
      $id = $_GET['id'];
      $users_sup = $pdo->prepare("SELECT * FROM users WHERE id = :id");
      $users_sup->bindParam(":id", $id, PDO::PARAM_STR);
      $users_sup->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
      $users_sup->execute();

      $users_suppr = $users_sup->fetch(PDO::FETCH_ASSOC); 
      

      $suppression = $pdo->prepare("DELETE FROM users WHERE id = :id");
      $suppression->bindParam(":id", $id, PDO::PARAM_STR);
      $suppression->execute();
      $message .= '<div class="alert-success" role="alert" style="margin-top:20px; text-align:center";>L\'utilisateur ayant l\'id '.$id.' et le pseudo '.$pseudo.' a bien été supprimé</div>';

        // On bascule sur l'affichage du tableau
        $_GET['action'] = 'affichage';
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

// RECUPERATION DES INFOS A MODIFIER
 if(isset($_GET['action'])&&$_GET['action'] == 'modification'&&!empty($_GET['id'])&&is_numeric($_GET['id']))

 { 
     
   $id = $_GET['id'];
   $users_modif = $pdo->prepare("SELECT * FROM users WHERE id = :id");
   $users_modif->bindParam(":id", $id, PDO::PARAM_STR);
   $users_modif->execute();
   $users_actuel = $users_modif->fetch(PDO::FETCH_ASSOC);

         $id = $users_actuel['id'];
         $pseudo =  $users_actuel['pseudo'];
         $password =  $users_actuel['password'];
         $lastname =  $users_actuel['lastname'];
         $firstname =  $users_actuel['firstname'];
         $email =  $users_actuel['email'];
         $gender =  $users_actuel['gender'];
         $status =  $users_actuel['status'];

 }

 if( isset($_POST["pseudo"]) && isset($_POST["password"]) && isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["email"]) && isset($_POST["gender"]) && isset($_POST["status"]))
{
    
	$id = isset($_POST["id"]) ? $_POST["id"] : "";
	$pseudo = $_POST["pseudo"];
    $password =  $_POST["password"];
	$lastname = $_POST["lastname"];
	$firstname = $_POST["firstname"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$status = $_POST["status"];
	
	
	// contrôle sur la disponibilitéBDD si on est dans le cas d'un ajout car lors de la modification la existera toujours.
	$verif_mem = $pdo->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND email = :email");
	$verif_mem->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
	$verif_mem->bindParam(":email", $email, PDO::PARAM_STR);
    $verif_mem->execute();
    
	if($verif_mem->rowCount() > 0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
       {
           // Si le users existe alors la ligne est de 1 
          $message .= '<div class="alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! Cet utilisateur existe déjà !!!</div>';
          $erreur = true ; 
       }
        
         if(empty($pseudo))
       {
         $message .= '<div class="alert-danger" role="alert" style="margin-top:20px; text-align:center";>!!! Le pseudo est obligatoire !!! <br />';
         $erreur = true; // Erreur
       }
        
       // Insertion dans la BDD
        if(!$erreur) // Si $erreur est différent de true alors les contrôles préalables sont ok ! équivaut à if ($erreur == false )

        {  
            
           if(isset($_GET['action'])&&$_GET['action'] == 'ajout')
           {
               
           // Insertion des utilisateurs
           $save = $pdo->prepare("INSERT INTO users (pseudo, password, lastname, firstname, email, gender, status) VALUES (:pseudo, :password, :lastname, :firstname, :email, :gender, :status, NOW())");

            if($status == 0)
               {
                   $message .= '<div class="alert-success" role="alert" style="margin-top:20px; text-align:center";>L\'utilisateur "'.$pseudo.'" a bien été crée et ajouté</div>';
               }
               else{
                   $message .= '<div class="alert-success" role="alert" style="margin-top:20px; text-align:center";>Nouvel Admin "'.$pseudo.'" a bien été crée et ajouté</div>';      
           }

           }
           elseif(isset($_GET['action'])&&$_GET['action'] == 'modification' && !empty($id))
           {
               $save = $pdo-> prepare("UPDATE users SET pseudo = :pseudo, lastname = :lastname, firstname = :firstname, email = :email,  password = :password, gender = :gender, status = :status WHERE id = :id");
               //$id = $_POST['id'];
               $save->bindParam(":id", $id, PDO::PARAM_STR);
               $message .= '<div class="alert-success" role="alert" style="margin-top:20px; text-align:center";>L\'utilisateur  '.$pseudo.' a bien été modifié</div>';
               
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
   
              
            
           // On redirige sur la page de gestion
           //header("location:gestion_boutique.php");
       }
       
   }




//echo '<pre>'; print_r($_POST); echo '</pre><br/>';  
?>

    <div class="container">
        <div class="starter-template">
            <div style="text-align:center">
                    <h1><span class="glyphicon glyphicon-cog" style="color:#fed136;"></span><i> GESTION DES UTILISATEURS </i><span class="glyphicon glyphicon-user" style="color:#fed136;"></h1>
            </div> 
            <?php // echo $message; //message destinés à l'utilisateur ?>
            <?= $message; // balise php inclue un echo ?>
             <br>  <br>  <br> 
        </div>   

<?php
      //$resultat = $pdo->query("SELECT * FROM users");

      $resultat = $pdo->query("SELECT id, pseudo, lastname, firstname, email, gender, status FROM users ORDER BY status DESC");

      echo'<br />';

        echo'<div class="row">';
            echo'<div class="col-xl" >';
                echo'<table class="table table-bordered" style="text-align:center;">';
                     echo'<tr style="background-color:#222;color:#fed136;">';
                     $nb_colonne = $resultat->columnCount(); // On récupère le nb de colonne 
                       
                     for($i = 0; $i < $nb_colonne; $i++)
                     {
                       $info_colonne = $resultat->getColumnMeta($i);

                           if($info_colonne['name'] != 'password')
                           
                           echo'<th style="text-align:center;">'.$info_colonne['name'].'</th>';
                       }
                      echo'<th style="text-align:center;">Actions</th>
                           </tr>';

                    while($users = $resultat->fetch(PDO::FETCH_ASSOC))
                    {
                        echo'<tr>';             
                                         foreach($users AS $indice=>$valeur)
                                         {
                                            if($indice != 'password')
                                            echo '<td>'.$valeur.'</td>';
                                         }
            
                          echo '<td style="text-align:center;">
                                    <a href="?action=voir&id='.$users['id'].'"<button class="btn btn-primary"> 
                                        <span class="glyphicon glyphicon-search"></span>
                                    </a>
                                    <a onclick="return(confirm(\'Modifier l\'utilisateur ?\'));" href="?action=modification&id='.$users['id'].'" <button class="btn btn-warning">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                    </a>
                                    <a onclick="return(confirm(\'ETES VOUS SUR ?\'));" href="?action=suppression&id='.$users['id'].'"<button class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>';                       
                        echo'</tr>';
                   }
                echo '</table>';
           
           ?> 
         <a href="?action=ajout"  class="btn btn-danger" >Ajouter un utilisateurs</a> 
      


    <?php // Affichage du formulaire d'enregistrement users  
        
           if(isset($_GET['action']) && ($_GET['action'] == 'ajout'|| $_GET['action'] == 'modification')) {?>
        
            <div class="col-sm-4">
                <form method="post" action="">
                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>"/>
                    <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" class="form-control" style="font-style:italic;" placeholder=" PSEUDO"  value="<?php echo $pseudo; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="password" >Mot de passe</label>
                        <input type="text" name="password" id="password" class="form-control" placeholder=" MOT DE PASSE " style="font-style:italic;" value="<?php echo $password; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="lastname" >Nom</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="NOM" style="font-style:italic;" value="<?php echo $lastname; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="firstname" >Prénom</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="PRENOM" style="font-style:italic;" value="<?php echo $firstname; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email" >Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="EMAIL" style="font-style:italic;" value="<?php echo $email; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="gender" >Sexe</label>
                        <select id="gender" name="gender" class="form-control">
                                <option value="m">Homme</option>
                                <option value="f" <?php if($gender == 'f') { echo 'selected'; } ?> >Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" >Statut</label>
                        <select id="status" name="status" class="form-control">
                                <option value="1">Admin</option>
                                <option value="0" <?php if($status == 0) { echo 'selected'; } ?> >Utilisateur</option>
                        </select>
                    </div>
                    
                     <button class="form-control btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"style="color:white;text-align:center;"></span>

    <?php }         // accolade correspondant à la condition sur l'affichage du formulaire 
                   //if(isset($_GET['action'])&&$_GET['action'] == 'ajout');
                ?>
            </div>
                </form>    
                 
        <?php echo'</div>
            </div>'; ?>
    </div><!-- /.container -->
     <!--
    <div class="container">
      <div class="starter-template">
        <h1><i><?php echo $role; ?><i></h1>
        <?php // echo $message; //message destinés à l'users ?>
        <?= $message; // balise php inclue un echo ?>
      </div>
       <div class="row">
		<div class="col-sm-7">
			<ul class="list-group">
			  <li class="list-group-item active">Vos informations</li>
			  <li class="list-group-item"><span style="display: inline-block; width: 140px; font-style: italic;">Pseudo: </span><?php echo $_SESSION['users']['pseudo']; ?></li>
			  <li class="list-group-item"><span style="display: inline-block; width: 140px; font-style: italic;">lastname: </span><?php echo $_SESSION['users']['lastname']; ?></li>
			  <li class="list-group-item"><span style="display: inline-block; width: 140px; font-style: italic;">Prélastname: </span><?php echo $_SESSION['users']['firstname']; ?></li>
			  <li class="list-group-item"><span style="display: inline-block; width: 140px; font-style: italic;">Sexe: </span><?php echo $_SESSION['users']['gender']; ?>
			  <li class="list-group-item"><span style="display: inline-block; width: 140px; font-style: italic;">Email: </span><?php echo $_SESSION['users']['email']; ?></li>			  
			</ul>
		</div>
		<div class="col-sm-5">
			<img src="img/profile.webp" />
		</div>
		<div class="col-sm-12">
    </div> .container -->

<?php 
require("../inc/footer.inc.php");



// Gestion des utilisateurs / utilisateurs du site 

/* $id ="";

if(isset($_GET['id'])&&is_numeric($_GET['id']))

{
    $id = $_GET['id'];
}

$liste_users = $pdo->query("SELECT id, pseudo FROM users");
$champ_users ="";
while($users = $liste_users->fetch(PDO::FETCH_ASSOC)

?>*/