<?php
// assets/alex
require("inc/init.inc.php");

$liste_article = $pdo->query("SELECT * FROM pictures");

// déclaration de variables
$date1 = null;
$date2 = null;
$condition = "";
$arg_country = false;
$arg_city = false;
$arg_tag=false;
$arg_year = false;
$var1 = "pictures";

// requete de récupération de tous les produits
if($_POST) // équivaut à if(!empty($_POST))
{

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
    

    
    // Recherche des photos par dates ou intervalle

    // $date1 et $date2 sont null
    if(!empty($_POST['date_picture1']))
        $date1 = $_POST['date_picture1'];
        
    if(!empty($_POST['date_picture2']))
        $date2 = $_POST['date_picture2'];


    // si les 2 champs date sont non null
    if($date1 && $date2) {
        $arg_year = true;
        $filtre_year1 = $date1;
        $filtre_year2 = $date2;

        if($date1 <= $date2) {
            $condition .= " WHERE date_picture BETWEEN :date_picture1 AND :date_picture2 ";	
        } else { // sinon j'inverse la condition
            $condition .= " WHERE date_picture BETWEEN :date_picture2 AND :date_picture1 ";
        }        
    } elseif ($date1 && !$date2) {
        $arg_year = true;
        $filtre_year1 = $date1;
        $filtre_year2 = "";
        $condition .= " WHERE date_picture = :date_picture1";
    } elseif (!$date1 && $date2) {
        $arg_year = true;
        $filtre_year1 = "";
        $filtre_year2 = "$date2";
        $condition .= " WHERE date_picture = :date_picture2";
    } 




    $liste_article = $pdo->prepare("SELECT * FROM $var1 $condition");

	if($arg_year) // si $arg_year == true alors il faut fournir l'argument year
	{
        if(!empty($filtre_year1))
        $liste_article->bindParam(":date_picture1", $filtre_year1, PDO::PARAM_STR);
        if(!empty($filtre_year2))
		$liste_article->bindParam(":date_picture2", $filtre_year2, PDO::PARAM_STR);
	}


	
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


/*------------------------------------------------------------------------
            la ligne suivante commence les affichage de la page
------------------------------------------------------------------------*/
require("inc/header.inc.php"); 
require("inc/nav.inc.php");



?>

<!-- affichage message -->
<?= $message; ?>
<!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">It's Nice To Meet You</div>
                <div class="intro-heading">TimeMachine</div>
                <a href="#services" class="page-scroll btn btn-xl">Where past and present mingle</a>
            </div>
        </div>
		<?= $message; // cette balise php inclue un echo // cette ligne php est equivalente à la ligne au dessus. ?>
    </header>

<?php  //////////////////////////////////////////////////////////////// echo de test
//echo '<pre> $date1 : '; var_dump($date1); echo '</pre>';
//echo '<pre> $date2 : '; var_dump($date2); echo '</pre>';
//echo '<pre> requete date : '; var_dump('SELECT * FROM ' . $var1 . $condition); echo '</pre>';
?>


<!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">bibliothèque de photos</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Les Photographies</h4>
                    <p class="text-muted">Visualisez des photos du monde entier et <br>de toutes les époques.<br>Triez et filtrez selon vos préférences, par dates, par pays, par ville, par mot-clé grâce à nos outils de recherche performant.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Le partage</h4>
                    <p class="text-muted">Il n’y a pas d’erreur, la mode est au partage.<br>Partagez vos photos avec le monde entier.<br>Consultez les photos de nos contributeurs.<br><i class="fa fa-smile-o"></i></p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Web Security</h4>
                    <p class="text-muted">Stockage sécurisé de vos photos.<br>Accédez à votre stockage illimité<br> depuis n'importe quel <br>PC / Tablette et Smartphone.</p>
                </div>
            </div>
        </div>
    </section>



<!-- Affichage galeries et filtres -->

    <section id="galeries">
        <div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
                    <h2 class="section-heading">Galeries</h2>
                </div>
				<div class="col-sm-2">
						<?php
						echo '<form method="post" action="index.php#galeries">';
						
						
						// affichage des pays
							
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
							
							echo '<div class="form-group">
									<label for="tags">tags (mots clefs</label>
									<select name="tags" id="tags" class="form-control">
										<option></option>';
							while($tags = $liste_tags->fetch(PDO::FETCH_ASSOC))
							{
								echo '<option>' . $tags['tag_word'] . '</option>';
							}
							echo '  </select></div>';
							
                            
                            

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



							// bouton de validation dde la recherche
							echo '<div class="form-group">
                            <button type="submit"  name="filtrer" id="filtrer" class="form-control btn btn-primary">Valider</button>
                            </div>';



						
						echo '</form>';
					?>
				</div>
        
                <!-- GALERIE -->
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
                        echo '<img src="' . URL . 'photo/' . $article['photo'] . '"  class="img-responsive" /><br>';
                        echo $article['date_picture'];
						//echo '<a href="fiche_article.php?id=' . $article['id'] . '" class="btn btn-primary">Voir la photo</a>';
						
						echo '</div></div></div>';
					}				
					
					echo '</div>';		
			
					?>
				</div>
			</div>
	  	</div>
	  
    </section>

<!-- Team Section -->
<section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">L' &#201;quipe TimeMachine</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="img/team/avatar.png" class="img-responsive img-circle" alt="">
                        <h4>Alexandre Largent</h4>
                        <p class="text-muted">?</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="img/team/avatar.png" class="img-responsive img-circle" alt="">
                        <h4>Alexandre Fernandes</h4>
                        <p class="text-muted">?</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="img/team/avatar.png" class="img-responsive img-circle" alt="">
                        <h4>Tanguy Manas</h4>
                        <p class="text-muted">?</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="team-member">
                        <img src="img/team/avatar.png" class="img-responsive img-circle" alt="">
                        <h4>Philippe Peron</h4>
                        <p class="text-muted">?</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>
    
<?php 
require("inc/footer.inc.php");