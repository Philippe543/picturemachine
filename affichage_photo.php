<?php
require("inc/init.inc.php");

//On verifie si l'indice id_article existe dans GET ou s'il n'est pas vide || on teste auusi si la valeur est bien un chiffre

if(empty($_GET['id']) || !is_numeric($_GET['id']))
{
	header("location:index.php#galeries");
}

$id = $_GET['id'];
$recup_photo = $pdo->prepare("SELECT * FROM pictures WHERE id = :id");
$recup_photo->bindParam(":id", $id, PDO::PARAM_STR);
$recup_photo->execute();

// Verification si on a bien recuperér une photo ou si nous avons un reponse vide (exemple changement d'id dans l'url par l'utilisateur.)

if($recup_photo->rowCount() < 1)
{
	// S'il y a moin d'une ligne alors la reponse de la bdd est vide donc on redirige vers l'accueil
	header("location:index.php#galeries");
}

$photo = $recup_photo->fetch(PDO::FETCH_ASSOC);

/* ///////////////////////////////  Codes à supprimer
if($article['sexe'] == "m")
{
	$sexe = "Masculin";
}
else{
	$sexe = "Feminin";
}
*////////////////////////////////////////////////////


// La ligne suivant commnce les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
// Dans cette page affichez les informations de l'article sauf le stock
// Mettre egalement en place un lien retour vers votre selection sur la boutique



?>


 
    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-th-list" style="color: lime;"></span>Fiche Photo</h1>
        <?php //echo $message; // messages destines a l'utilisateur ?>
		<?= $message; // cette balise php inclue un echo et est equivalent a la ligne au dessus ?>
      </div>
	  <div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<!--<div class="panel-heading" style="background:white;"><img src="<?php echo URL; ?>img/logo-boutique.gif" class="img-responsive"/></div>-->
			
					<div class="panel-body">
					<div class="col-md-12" style="text-align:left;">
						<?php
							echo '<h2>' . $photo['title'] . '</h2><hr />';
							echo '<img src="' . URL . 'photo/' . $photo['photo'] . '" class="img-responsive" />';
							echo '<p>' . $photo['header'] . '</p>';
							echo '<p><b class="label-fiche">Descritpion	: </b>' . $photo['content'] . '</p>';
							echo '<p><b class="label-fiche">Année : </b>' . $photo['date_picture'] . '</p>';
							echo '<p><b class="label-fiche">Pays : </b>' . $photo['country'] . '</p>';
							echo '<p><b class="label-fiche">Ville : </b>' . $photo['city'] . '</p>';
						?>	
					</div>
					
					<div class="col-md-12">
						<?php
							/*
							echo '<hr /><p>' . $photo['description'] . '</p>';
							echo '<hr />';
							
							// on affiche le formulaire d'ajout si le stock est supérieur à zéro
							if($article['stock'] > 0)
							{
							// Formulaire d'ajout panier 
							echo '<form method="post" action="panier.php">';
							
							//On récupère l'id_article dans un champs caché afin de savoir ensuite quel est le produit qui a été ajouté.
							echo '<input type="hidden" name="id_article" value="'  .$article['id_article'] . '" />'; 
							
							
							// Faire un champ select pour le choix de la quantite selon la quantite disponible du produit avec un securite por afficher maximum 7 si la quantité est superieur (2eme condition d'entree dans la boucle ($i<8)).
							
							echo '<select name="quantite" class="form-control">';
							
							for($i = 1; $i <= $article['stock'] && $i < 8; $i++)
							{
								echo '<option>' . $i . '</option>';
							}
							
							echo '</select><br />';
							
							echo '<input type="submit" name="ajout_panier" value="Ajouter au panier" class="form-control btn btn-success" />';
							
							
							
							echo '</form>';
							}
							else {
								echo '<h3>Rupture de stock pour ce produit</h3>';
							}
							
							echo '<hr>';
							*/
							//echo '<a href="galerie_anciennement_index.php?categorie=' .$article['categorie']. '" class="btn btn-success form-control">Retour vers votre sélection</a>';
							echo '<a href="index.php#galeries" class="btn btn-success form-control">Retour vers la galerie d\'images</a>';
							
						?>
					</div>
					
			</div>	
		</div>
	  </div>
	  

    </div><!-- /.container -->

<?php
require("inc/footer.inc.php");