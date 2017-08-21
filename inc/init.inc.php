<?php
// connexion � la base de donn�es
$pdo = new PDO('mysql:host=localhost;dbname=timemachine','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

require_once("function.inc.php");

//cr�ation de variables pouvant nous servir dans le cadre du projet:
//variable pour afficher des messages � l'utilisateur.
$message="";

//ouverture de la session
session_start();



/* TEST GITIGNORE, SI TU LIS CE TEXTE C'4'EST QUE LE .gitignore NE MARcHE PAS */





// d�finition de la constante pour le chemin absolu ainsi que pour la racine serveur
// racine site
define("URL","/sitephoto/");

//racine serveur
define("RACINE_SERVEUR", $_SERVER['DOCUMENT_ROOT'] . URL);
