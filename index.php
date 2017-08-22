<?php
// assets/alex
require("inc/init.inc.php");

$liste_article = $pdo->query("SELECT * FROM pictures");

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

require("inc/header.inc.php"); // la ligne suivante commence les affichage de la page
require("inc/nav.inc.php");
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
		<?= $message; // cette balise php inclue un echo // cette ligne php est equivalente à la ligne au dessus. ?>
    </header>

<!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Le partage</h4>
                    <p class="text-muted">Il n’y a pas d’erreur, la mode est au partage. <i class="fa fa-smile-o"></i>Depuis plusieurs années, on entend parler de nouvelles tendances dont l’analyse montre clairement la place de l’humain par la satisfaction de donner quelque chose à autrui et à la fois à lui-même.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Web Security</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div>
        </div>
    </section>

<!-- Story Section -->

<section id="story">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2009-2011</h4>
                                    <h4 class="subheading">Our Humble Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>March 2011</h4>
                                    <h4 class="subheading">An Agency is Born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>December 2012</h4>
                                    <h4 class="subheading">Transition to Full Service</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>July 2014</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
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
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
				<div class="col-sm-2">
						<?php
						echo '<form method="post" action="">';
						
						
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