<?php
require("inc/init.inc.php");

/*
ANCIENNEMENT INDEX DE PHILIPPE DEBUGGE PAR ALEXANDRE => FONCTIONNE
présent sur branche gestionphotosAF uniquement
*/

$liste_article = $pdo->query("SELECT * FROM pictures");

// requete de récupération de tous les produits
if($_POST) // équivaut à if(!empty($_POST))
{
	$condition = "";
	$arg_country = false;
	$arg_city = false;
	$arg_tag=false;
	$var1 = "pictures";
	$arg_year1=false;
	$arg_year2=false;
	$message="";

	if(!empty($_POST['country']))
	{
		$condition .= " WHERE country = :country ";
		$arg_country = true;		
		$filtre_country = $_POST['country'];
		
		/* $liste_article = $pdo->prepare("SELECT * FROM article WHERE country = :country");
		$liste_article->bindParam(":country", $filtre_country, PDO::PARAM_STR);
		$liste_article->execute();		*/ 
	}
	
	if(!empty($_POST['city']))
	{
		if($arg_country)
		{
			// vérifier la requete pour cette condition
			$condition .= " AND city = :city ";
		}
		else {
			$condition .= " WHERE city = :city ";
		}
		
		$arg_city = true;		
		$filtre_city = $_POST['city'];	
	}
	

	/*----------------------------------------------------*/
	/*----------------------------------------------------*/
	/*--------------------FILTRE ANNEE--------------------*/
	/*----------------------------------------------------*/
	/*----------------------------------------------------*/


	// Recherche des photos par année Philippe
	//année1	
	if(!empty($_POST['date_picture1'] && $_POST['date_picture1'] <= $_POST['date_picture2']))
	{
		$condition .= "WHERE date_picture BETWEEN :date_picture1 AND :date_picture2 ";
		$arg_year = true;		
		$filtre_year1 = $_POST['date_picture1'];
		$filtre_year2 = $_POST['date_picture2'];			
	} 
	
	
	/*
	// on test picture1
	if(!empty($_POST['date_picture1'])) {		
		$filtre_year1 = $_POST['date_picture1'];
		$condition .= "WHERE date_picture BETWEEN :date_picture1 AND :date_picture2 ";
		
		// uniquement date 1 de renseigné
		if(empty($_POST['date_picture2']))
			$filtre_year2 =$_POST['date_picture1'];

		// date 2 renseigné et supérieure à date 1 (cas normal)	
		elseif(!empty($_POST['date_picture2'] && $filtre_year1 <= $_POST['date_picture2'])){
			$arg_year = true;	
			$filtre_year2 = $_POST['date_picture2'];
			
		}else {
			$arg_year = false;
			//prévoir afficher le message
			$message ="Votre date de fin est inférieure à la date de début. Veuillez sélectionner une année supérieure ou égale à la date de début";
		}
		var_dump($condition);
		
		
		
		
	}
	*/
	
	
	//année 2
	//if(!empty($_POST['date_picture2']))
	//{
		//$condition .= " WHERE date_picture2 = :date_picture ";
		//$arg_year = true;		
		//$filtre_year = $_POST['date_picture'];	
	//}
	
	
	
	
	
	// Recherche des photos avec tags (en cours de développement (tags)
	
	if (!empty($_POST['tags']))
	{
		$arg_tag =true;
		// requete jointure table photos et tags
		$var1 .= ", tags_picture";
		$condition = " WHERE pictures.id = tags_picture.pictures_id AND tags_picture.tag_word = :tagspicture";
		$filtre_tag = $_POST['tags'];
	}
	
	$liste_article = $pdo->prepare("SELECT * FROM $var1 $condition");
	



	//$liste_article = $pdo->prepare("SELECT * FROM pictures $condition");
	//$liste_article = $pdo->prepare("SELECT * FROM tags_picture, pictures WHERE  pictures.id = tags_picture.pictures_id $condition");
	
	if($arg_country) // si $arg_country == true alors il faut fournir l'argument country
	{
		$liste_article->bindParam(":country", $filtre_country, PDO::PARAM_STR);
	}
	if($arg_city) // si $arg_city == true alors il faut fournir l'argument city
	{
		$liste_article->bindParam(":city", $filtre_city, PDO::PARAM_STR);
	}

	if($arg_year) // si $arg_year == true alors il faut fournir l'argument year
	{
		$liste_article->bindParam(":date_picture1", $filtre_year1, PDO::PARAM_STR);
		$liste_article->bindParam(":date_picture2", $filtre_year2, PDO::PARAM_STR);
	}	
	
	if($arg_tag) // si $arg_tag == true alors il faut fournir l'argument tag
	{
		$liste_article->bindParam(":tagspicture", $filtre_tag, PDO::PARAM_STR);
	}

	// en cours de développement (tags)
	
	echo '<pre>'; var_dump($liste_article); echo '</pre>';
	echo '<pre>'; var_dump($filtre_tag); echo '</pre>';
	$liste_article->execute();
}
/*
elseif(!empty($_GET['categorie']))
{
	$cat = $_GET['categorie'];
	$liste_article = $pdo->prepare("SELECT * FROM article WHERE categorie = :categorie");
	$liste_article->bindParam(":categorie", $cat, PDO::PARAM_STR);
	$liste_article->execute();
}
*/

// requete de récupération des différentes catégories en BDD
//$liste_categorie = $pdo->query("SELECT DISTINCT categorie FROM article");


// requete de récupération des différentes country en BDD
$liste_country = $pdo->query("SELECT DISTINCT country FROM pictures ORDER BY country");


// requete de récupération des différentes city en BDD
$liste_city = $pdo->query("SELECT DISTINCT city FROM pictures ORDER BY city");

//if($_POST[date_picture1] < $_POST[date_picture2]){
	// requete de récupération des différentes années en BDD
	//$liste_year = $pdo->query("SELECT DISTINCT date_picture FROM pictures BETWEEN $_POST[date_picture1] AND $_POST[date_picture2] ORDER BY date_picture");
//}// todo le esle 


//requete de récupérations des différents tags en BDD
$liste_tags  = $pdo->query("SELECT DISTINCT tag_word FROM tags_picture, pictures WHERE  pictures.id = tags_picture.pictures_id ORDER BY tag_word ASC");


// la ligne suivant commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';

?>

    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon" style="color: NavajoWhite;"></span> Gallerie de photos</h1>
        <?php // echo $message; // messages destinés à l'utilisateur ?>
		<?= $message; // cette balise php inclue un echo // cette ligne php est equivalente à la ligne au dessus. ?>
      </div>
	  
	  <div class="row">
		
		<div class="col-sm-2">
			<?php // récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de lien a href avec une information GET par exemple: ?categorie=pantalon 
				/*
				echo '<ul class="list-group">';
				echo '<li class="list-group-item"><a href="index.php">Tous les articles</a></li>';
				while($categorie = $liste_categorie->fetch(PDO::FETCH_ASSOC))
				{
					echo '<li class="list-group-item"><a href="?categorie=' . $categorie['categorie'] . '">' . $categorie['categorie'] . '</a></li>';
				}
				
				echo '</ul>';
				echo '<hr />';*/
				echo '<form method="post" action="">';
				
				
					// affichage des country
					
					echo '<div class="form-group">
							<label for="country">pays</label>
							<select name="country" id="country" class="form-control">
								<option></option>';
					while($country = $liste_country->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option>' . $country['country'] . '</option>';
					}
					echo '  </select></div>';
					
					
					// affichage des villes
					
					echo '<div class="form-group">
							<label for="city">ville lieu</label>
							<select name="city" id="city" class="form-control">
								<option></option>';
					while($city = $liste_city->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option>' . $city['city'] . '</option>';
					}
					echo '  </select></div>';
		
					
	/*----------------------------------------------------*/
	/*----------------------------------------------------*/
	/*--------------------FILTRE ANNEE--------------------*/
	/*----------------------------------------------------*/
	/*----------------------------------------------------*/
					// affichage des années
					//année 1
					echo '<div class="form-group">
							<label for="date_picture1">Année de début</label>
							<select name="date_picture1" id="date_picture1" class="form-control">
							<option></option>';
								for($i= date('Y'); $i >= 1900; $i--){
									echo '<option>' . $i . '</option>';
								}
					/*while($date_picture1 = $liste_year->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option>' . $date_picture1['date_picture'] . '</option>';
					}*/
					echo '  </select></div>';
					
					//année 2
					echo '<div class="form-group">
							<label for="date_picture2">Année de fin</label>
							<select name="date_picture2" id="date_picture2" class="form-control">
							<option></option>';
								for($i = date('Y'); $i >= 1900; $i--){
									echo '<option>' . $i . '</option>';
								}
					/*while($date_picture2 = $liste_year->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option>' . $date_picture2['date_picture'] . '</option>';
					}*/
					echo '  </select></div>';
					
					
					
					// affichage des tags
					
					echo '<div class="form-group">
							<label for="tags">tags (mots clefs</label>
							<select name="tags" id="tags" class="form-control">
								<option></option>';
					while($tags = $liste_tags->fetch(PDO::FETCH_ASSOC))
					{
						echo '<option>' . $tags['tag_word'] . '</option>';
					}
					echo '  </select></div>';
					
					
					echo '<div class="form-group">
						<button type="submit"  name="filtrer" id="filtrer" class="form-control btn btn-primary">Valider</button>
					</div>';				
				
				echo '</form>';
			?>
		</div>
		
		<div class="col-sm-10">
			<?php // afficher tous les produits dans cette page par exemple: un block avec image + titre + prix produit
			
				echo '<div class="row">';
				$compteur = 0;
				while($article = $liste_article->fetch(PDO::FETCH_ASSOC))
				{
					
					// afin de ne pas avoir de souci avec le float, on ferme et on ouvre une ligne bootstrap (class="row") pour gérer les lignes d'affichage.
					if($compteur%4 == 0 && $compteur != 0) { echo '</div><div class="row">'; }
					$compteur++;
					
					echo '<div class="col-sm-3">';
					echo '<div class="panel panel-default">';
					//echo '<div class="panel-heading"><img src="' . URL . 'img/timestorrylogo.png" class="img-responsive" /></div>';
					echo '<div class="panel-body text-center">';
					echo '<h5>' . $article['title'] . '</h5>';
					echo '<img src="' . URL . 'photo/' . $article['photo'] . '"  class="img-responsive" />';
					
					echo '<hr />';
					//modification philippe : possibilité de voir la photo
					echo '<a href="affichage_photo.php?id=' . $article['id'] . '" class="btn btn-primary">Voir la photo</a>';
					
					echo '</div></div></div>';
				}				
				
				echo '</div>';		
			
			?>
		</div>
	  </div>
	  

    </div><!-- /.container -->
	
<?php
require("inc/footer.inc.php");

