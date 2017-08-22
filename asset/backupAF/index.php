<?php
// racine
require("inc/init.inc.php");

$liste_article = $pdo->query("SELECT * FROM pictures");

// A MIEUX COMMENTER
// PARTIE FILTRE RECHERCHE
// requete de récupération de tous les produits
if($_POST) // équivaut à if(!empty($_POST))
{
	$condition = "";
	$arg_country = false;
	$arg_city = false;
	$arg_tag=false;
	$var1 = "pictures";


	if(!empty($_POST['country']))
	{
		$condition .= " WHERE country = :country ";
		$arg_country = true;		
		$filtre_country = $_POST['country'];
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
		
	if($arg_country) // si $arg_country == true alors il faut fournir l'argument country
	{
		$liste_article->bindParam(":country", $filtre_country, PDO::PARAM_STR);
	}
	if($arg_city) // si $arg_city == true alors il faut fournir l'argument city
	{
		$liste_article->bindParam(":city", $filtre_city, PDO::PARAM_STR);
	}
	if($arg_tag) // si $arg_tag == true alors il faut fournir l'argument tag
	{
		$liste_article->bindParam(":tagspicture", $filtre_tag, PDO::PARAM_STR);
	}


	$liste_article->execute();		
}

// requete de récupération des différentes country en BDD
$liste_country = $pdo->query("SELECT DISTINCT country FROM pictures ORDER BY country");


// requete de récupération des différentes city en BDD
$liste_city = $pdo->query("SELECT DISTINCT city FROM pictures ORDER BY city");


//requete de récupérations des différents tags en BDD
$liste_tags  = $pdo->query("SELECT DISTINCT tag_word FROM tags_picture, pictures WHERE  pictures.id = tags_picture.pictures_id ORDER BY tag_word ASC");

// la ligne suivante commence les affichage de la page
require("inc/header.inc.php"); 
require("inc/nav.inc.php");
echo '<pre>$_SESSION[\'utilisateur\'] : '; var_dump($_SESSION['utilisateur']); echo '</pre>';
?>

 	<!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">It's Nice To Meet You</div>
                <div class="intro-heading">TimeMachine</div>
                <a href="#services" class="page-scroll btn btn-xl">Where past and present mingle</a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="starter-template">
        <h1><span class="glyphicon" style="color: NavajoWhite;"></span> Gallerie de photos</h1>
		<?= $message; ?>
      </div>
	  
	  <div class="row">
		
		<div class="col-sm-2">
			<?php
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
					
					// affichage des tags si on veut combiner les recherches
					
					
					
					
					
					
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
			<?php // afficher toutes les photos dans cette page par exemple: un block avec image + titre + prix produit
			
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
					//echo '<a href="fiche_article.php?id=' . $article['id'] . '" class="btn btn-primary">Voir la photo</a>';
					
					echo '</div></div></div>';
				}				
				
				echo '</div>';		
			
			?>
		</div>
	  </div>
	  

    </div><!-- /.container -->
<?php 
require("inc/footer.inc.php");