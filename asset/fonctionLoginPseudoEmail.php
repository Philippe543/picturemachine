<?php
/*
Cette fonction dont je suis super fier vu que je me suis passé de l'aide d'internet pour la réaliser, permet de se loger via un pseudo ou un email dans un champ login.
C'est peut-être pas la meilleure façon de faire mais ça fait du bien de réussir des trucs de temps en temps.
*/


    // La connexion peut se faire via le pseudo ou le mot de passe de l'utilisateur dans un champ unique
    $login = $_POST['login'];
    $password = $_POST['mdp'];
    // comparaison du post avec la BDD
    $req = "SELECT * FROM users WHERE password = :password AND ";
    if(!empty($_POST['login']) && filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        // si on detecte une entrée de type email
        $req .= "email = :email";
        $param = ":email";
    }
    elseif (!empty($_POST['login']) && !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
    {
        // sinon...
        $req .= "pseudo = :pseudo";
        $param = ":pseudo";
    }

    $verif_connexion = $pdo->prepare($req);
    $verif_connexion->bindParam($param, $login, PDO::PARAM_STR);
    $verif_connexion->bindParam(":password", $password, PDO::PARAM_STR);
    $verif_connexion->execute();