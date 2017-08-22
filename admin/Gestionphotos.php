<?php
require("../inc/init.inc.php");
/*
Gestionphoto.php est accessible à tous les utilsateurs enregistrés, Les simples users ont accès à leurs photos et les admins à toutes les photos stockées


Il faut que je reprenne une partie des contrôles d'anciennement index.php (que j'ai copié dans boutique.php) car bien entendu le controle de la requete par tags se fait via l'affichage...Je dois attendre d'avoir un affichage d'index.php validé pour continuer la gestion des tags.

*/

//Restriction d'accès, si l'utilisateur n'est pas CONNECTE alors il ne doit pas accéder à cette page
if(!utilisateur_est_connecte())
{
	header("location:../connexion.php");
	exit(); //permet d'arrêter l'exécution du script au cas où une persnne malveillante ferait des injections via GET
}

// SUPPRESSION

// Récupération de l'ID de l'utilisateur
///  Il faut récupérer l'id de l'utilisateur et le mettre dans la table.

if(isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	// on fait une requête pour récupérer les informations de l'article afin de connaître la photo pour la supprimer.
	$photo_a_supprimer=$pdo->prepare("SELECT * FROM pictures WHERE id =:id");
	$photo_a_supprimer->bindParam(":id", $id, PDO::PARAM_STR);
	$photo_a_supprimer->execute();
	
	$photo_a_suppr =$photo_a_supprimer->fetch(PDO::FETCH_ASSOC);
	//On vérifie si la photo existe
	if(!empty($photo_a_suppr['photo']))
	{
		// on vérifie le chemin si le fichier existe
		$chemin_photo = RACINE_SERVEUR . 'photo/'. $photo_a_suppr['photo'];
		$message .=$chemin_photo;
		if(file_exists($chemin_photo))
		{
			unlink($chemin_photo); // unlink() permet de supprimer un fichier sur le serveur. ici on supprime la photo
		}
	}
	$suppression= $pdo->prepare("DELETE FROM pictures WHERE id =:id");
	$suppression->bindParam(":id", $id, PDO::PARAM_STR);
	$suppression->execute();
	$message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">La photo n°' .$id . 'a bien été supprimée</div>';
	
	// on bascule sur l'affichage du tableau
	$_GET['action'] = 'affichage';
}



$id="";
$title="";
$header="";
$content="";
$date_record="";
$date_picture="";
$country="";
$city="";
$photo_bdd="";

//déclaration d'une variable de contrôle
$multitags="";
$erreur="";
$message="";
$status="";
$lastId="";
//*********************************************************
// RECUPERATION DES INFORMATIONS D'UNE PHOTO A MODIFIER - GESTION DES PHOTOS
//********************************************************


if(isset($_GET['action']) && $_GET['action'] == 'modification' && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	$id= $_GET['id'];
	$photo_a_modif =$pdo->prepare("SELECT * FROM pictures WHERE id =:id");
	$photo_a_modif->bindParam(":id", $id, PDO::PARAM_STR);
	$photo_a_modif->execute();
	$photo_actuel = $photo_a_modif->fetch(PDO::FETCH_ASSOC);
	
	$id = $photo_actuel['id'];
	$title = $photo_actuel['title'];
	$header= $photo_actuel['header'];
	$content = $photo_actuel['content'];
	$date_record = $photo_actuel['date_record'];
	$date_picture = $photo_actuel['date_picture'];
	$country = $photo_actuel['country'];
	$city = $photo_actuel['city'];
	// on récupère la photo de l'article dans une nouvelle variable
	$photo_actuelle = $photo_actuel['photo'];
}





//*************************************************************************************************************
// ENREGISTREMENT DES PHOTOS
//*************************************************************************************************************

// contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['id']) && 
isset($_POST['title']) && 
isset($_POST['header']) && 
isset($_POST['content']) && 
isset($_POST['date_picture']) && 
isset($_POST['country']) && 
isset($_POST['city']) &&
isset($_POST['keywords']))
{

	//le formulaire a été validé, on place dans ces variables, les saisies correspondantes.
	$id = $_POST['id'];
	$title = $_POST['title'];
	$header = $_POST['header'];
	$content = $_POST['content'];
	//$date_record = $_POST['date_record'];
	$date_picture = $_POST['date_picture'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$keywords=strtoupper($_POST['keywords']);
	

	var_dump($message.'test3', $erreur,$id);
//*************************************************************************************************************
// FIN GESTION DES PHOTOS ?? PAS VRAIMENT
//*************************************************************************************************************	
	

//**
//	CONTROLE DES ERREURS DANS LE FORMULAIRE
//**

			
			// vérification si le titre n'est pas vide
			if(empty($title))
			{
				$message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, le titre est obligatoire.</div>';
				$erreur = true;
			}

			//Récupération de l'ancienne photo dans le cas d'une modification
			if(isset($_GET['action']) && $_GET['action'] =="modification")
			{
				// /!\ Je ne vois pas où est récupéré le $_POST['ancienne_photo'] peut-être dans index.php ??
				// Je ne comprends pas - A VOIR MARDI
				if(isset($_POST['ancienne_photo']))
				{
					$photo_bdd=$_POST['ancienne_photo'];
				}
			}
						
			// vérification si l'utilisateur a chargé une image
			if(!empty($_FILES['photo']['name']))
			{
				//si ce n'est pas vide alors un fichier a bien été chargé via le formulaire.
				//On concatène l'id sur le titre afin de ne jamais avoir un fichier avec un nom existant sur le serveur. JE CROYAIS QUE CA NE MARCHAIS PAS DANS LE CADRE D'UNE INSERTION -> A TESTER / VERIFIER DANS LE CODE D'INSERTION
				$photo_bdd = $id . '_'. $_FILES['photo']['name'];

				//vérification de l'extension de l'image (extensions acceptées: jpg,jpeg, png, if)
				$extension = strrchr($_FILES['photo']['name'], '.'); // On récupère l'extension du fichier soumis
				
				//On transforme $extension afin que tous les caractères soient en minuscule
				$extension =strtolower($extension); // inverse strtroupper()

				// on enlève le .
				$extension=substr($extension,1); // exemple: .jpg ->jpg

				// tableau des extensions autorisées
				$tab_extension_valide =array("jpg","jpeg", "png", "gif");
				// nous pouvons donc vérifier si $extension fait partie des valeurs autorisées  dans $tab_extension_valide
				$verif_extension = in_array($extension, $tab_extension_valide);
				
				//Copîe du fichier dans photo/
				if($verif_extension && !$erreur)
				{
					//si $verif_extension est égal à true et que $erreur n'est pas égal à true (il n'y a pas eu d'erreurs au préalable)
					$photo_dossier = RACINE_SERVEUR . 'photo/' .$photo_bdd;
					copy($_FILES['photo']['tmp_name'], $photo_dossier);
					// copy() permet de copier un fichier depuis un emplacement vers un autre emplacement fourni en deuxième argument.
				}
				elseif(!$verif_extension )
				{
					
					$message .= '<div class="alert alert-danger" role="alert" style="margin-top:20px;">Attention, la photo n\'a pas une extension valide(extension acceptées : jpg / jpeg / png / gif)</div>';
					$erreur = true;
				}
				
				
			}
	
	//relation avec la table keywords


	//explosion de la chaine keywords avec ', ' comme séparateur
	// $keywords est définie ligne 123 lors de l'enregistrement d'une photo 
	$multitags= explode(", ",$keywords);
	// NE S'AFFICHE NULLE PART QUAND ON EST PAS EN INSERTION ?? A VOIR
	echo '<pre>$multitags :'; var_dump($multitags); echo '</pre>';

	//Insertion des photos
	if(!$erreur)		
	{
		if(isset($_GET['action']) &&  $_GET['action'] == 'ajout' )
		{
			$enregistrement =$pdo->prepare("INSERT INTO pictures (title, header, content, date_record, date_picture, country, city, photo, users_id) VALUES (:title, :header, :content, now(), :date_picture, :country, :city, :photo, :users_id)");		
		}
		elseif(isset($_GET['action']) && $_GET['action'] == 'modification')
		{
			$enregistrement = $pdo->prepare("UPDATE pictures SET title = :title, header= :header, content =:content, date_picture= :date_picture, country =:country, city =:city, photo=:photo WHERE id=:id");
			$id =$_POST['id'];
			$enregistrement->bindParam(":id", $id, PDO::PARAM_STR);
		}
	
	
	
		$enregistrement->bindParam(":title", $title, PDO::PARAM_STR);
		$enregistrement->bindParam(":header", $header, PDO::PARAM_STR);
		$enregistrement->bindParam(":content", $content, PDO::PARAM_STR);
		$enregistrement->bindParam(":date_picture", $date_picture, PDO::PARAM_STR);
		$enregistrement->bindParam(":country", $country, PDO::PARAM_STR);
		$enregistrement->bindParam(":city", $city, PDO::PARAM_STR);
		$enregistrement->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
		$enregistrement->bindParam(":users_id", $_SESSION['utilisateur']['id'], PDO::PARAM_INT);
		$enregistrement->execute();

		// on est toujours dans l'insertion : INSERTION TAGS
		$lastId = $pdo->lastInsertId ();
		
		foreach($multitags AS $multitag) {
			$enregistrement2 =$pdo->prepare("INSERT INTO tags_picture (tag_word, pictures_id) VALUES( :multitags, :id)");
			$enregistrement2->bindParam(":multitags", $multitag, PDO::PARAM_STR);
			$enregistrement2->bindParam(":id", $lastId, PDO::PARAM_STR);
			$enregistrement2->execute();
		}
	} // fin insertion PHOTO

}//fin du MEGA isset ligne 112



// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
echo'<pre>$_GET : '; print_r($_GET); echo '</pre>';
echo'<pre>$_POST : '; print_r($_POST) ;echo '</pre>';
echo'<pre>$_FILES : '; print_r($_FILES); echo '</pre>';
echo'<pre>$_SESSION[\'utilisateur\' : '; print_r($_SESSION['utilisateur']); echo '</pre>';
?>
  

    <div class="container">

      <div class="starter-template">
        <h1>Gestion photo</h1>
		<?= $message; ?>
		<hr />
		<a href="?action=ajout" class="btn btn-info">Ajouter une photo</a>
		<a href="?action=affichage" class="btn btn-info">Afficher les photos</a>
      </div>
		<?php // AFFICHAGE DES PHOTOS
					if(isset($_GET['action']) && $_GET['action'] =='affichage' )
			{
			
			// récupération de l'id utilisateur dans une variable
			$ida=$_SESSION['utilisateur']['id'];
			// récupération du status de l'user dans une variable
			$statusUser = $_SESSION['utilisateur']['status'];

			if ($statusUser == 1 ){
				$resultat = $pdo->query("SELECT * FROM pictures");
			}
			else{				
				$resultat = $pdo->query("SELECT * FROM pictures WHERE users_id=$ida");			
			}
			// a effacer plus tard echo '<pre>$resultat : '; var_dump($resultat); echo'</pre>';
			
						echo '<hr>';
						// première ligne du tableau pour le nom des colonnes
						echo'<table class="table table-bordered">';
							echo '<tr>';
								// récupération du nombre de colonnes dans la requête:
								$nb_col = $resultat->columnCount();

								for($i = 0; $i< $nb_col; $i++)
								{
								//echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
								$colonne = $resultat->getColumnMeta($i); // on récupère les informations de la, colonne en cours afin ensuite de dem	ander le name.
								echo '<th style="padding:10px;">' . $colonne['name'] . '</th>';
								
								}
							echo'</tr>';
						
						// affichage des éléments du tableau
						While($ligne =$resultat->fetch(PDO::FETCH_ASSOC))
						{
							echo '<tr>';
								foreach($ligne AS $indice => $info)
								{
										if($indice == 'photo')
										{
											echo '<td style="padding:10px;"><img src=" '. URL . 'photo/'.$info .'" width="140" /></td>';
											
										}elseif($indice == "content") {
											// lier la vue de la photo quand elle sera dsiponible
											echo '<td>' . substr($info,0,40) . '..<a href="#">Voir la fiche de la photo</a></td>';
										}
										else
										{
											echo '<td style="padding:10px;">' .$info .'</td>';
										}								
								}
								echo '<td><a href="?action=modification&id=' . $ligne['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span></a></td>';
								echo '<td><a onclick="return(confirm(\'Etes vous sûr de vouloir supprimer cette photo\'));"  href="?action=suppression&id=' . $ligne['id'] . '" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span></a></td>';	
							echo '</tr>';
						}	

						echo '</table>';
			}
		/* pas indispensable, je crois
		?>	  
		<?php
		*/
			if(isset($_GET['action']) && ($_GET['action'] =='ajout' || $_GET['action'] == 'modification'))
			{
		?>
	  
	    <div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<form method="post" action="" enctype="multipart/form-data">  <!-- on rajoute enctype parce que l'on va demander de joindre une pièce jointe-->
				
					<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>">
					
					<div class="form-group">
						<label for="title">title<span style="color:red;"></span></label>
						<input type="text" name="title" id="title" class="form-control" placeholder="title" value="<?php echo $title; ?>">
					</div>								
					<div class="form-group">
						<label for="header">header<span style="color:red;"></span></label>
						<input type="text" name="header" id="header" class="form-control" placeholder="header" value="<?php echo $header; ?>">
					</div>
					<div class="form-group">
						<label for="content">content</label>
						<input type="text" name="content" id="content" class="form-control" placeholder="content" value="<?php echo $content; ?>">
					</div>
					<div class="form-group">
						<label for="date_picture">date de la photo</label>
						<input type="date" name="date_picture" id="date_picture" class="form-control" placeholder="date de la photo" value="<?php echo $date_picture; ?>">
					</div>
					<div class="form-group">
						<label for="country">pays</label>
						<input type="text" name="country" id="country" class="form-control" placeholder="country" value="<?php echo $country; ?>">
					</div>
					<div class="form-group">
						<label for="city">ville / lieu</label>
						<input type="text" name="city" id="city" class="form-control" placeholder="ville / lieu" value="<?php echo $city; ?>">
					</div>
					
					<?php
					//affichage de la photo actuelle dans le cas d'une modification d'article
						if(isset($photo_actuel)) //si cette variable existe alors nous sommes dans le cas d'une modification
						{
							echo '<div class="form-group">';
							echo '<label>Photo actuelle</label>';
							echo '<img src="'.URL . 'photo/' . $photo_actuelle .'" class="img-thumbnail" width="210" />';
							// On crée un champs caché qui contiendra le nom de la photo afin de le récupérer lors de la validation du formulaire.
							echo '<input type="hidden" name="ancienne_photo" value="' .$photo_actuelle . '"/>';
							echo '</div>';
						}					
					?>
										
					
					<div class="form-group">
						<label for="photo">photo</label>
						<input type="file" name="photo" id="photo" class="form-control" value="">
					</div>	
					
					
					<div class="form-group">
						<label for="keywords">entrer des mots clefs séparés par ", "  (virgule espace)</label>
						<input type="text" name="keywords" id="keywords" class="form-control" value="<?php
						/* Je vais imploder $keywords et rajouter des ", " - ca va le faire
						ou peut-être les appeler par une requête (reflexion reflexion) */		 
						?>">
					</div>			
					
					
					
					<div class="form-group">
						<button class="form-control btn btn-success">valider</button>					
					</div>	
				
				</form>
			</div>
	  
	  
		</div>
	  <?php
			} // fin if(isset($_GET['action']) && $_GET['action'] =='ajout' )
		?>	  
	  
    </div><!-- /.container -->

<?php
require("../inc/footer.inc.php");
?>
