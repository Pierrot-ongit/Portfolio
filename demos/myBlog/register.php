<?php

session_start();

//Si mon tableau est vide ça veut dire que j'ai envoyé aucune donnée
//Donc on fait l'affichage du formulaire
if(empty($_POST)) {

//On précise le nom du template
    $template = 'register';

    include 'layout-blog.phtml';
}

else {
    // Connection à la BDD
    include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';
    $pdo = getConnection();
    //Vérifications :
    // - L'utilisateur existe déjà ?
    // - Le mot de passe et la confirmation sont identiques ?
    if($_POST["password"] != $_POST["confirm_password"])
    {
        //Si le mot de passe et la confirmation sont différents
        //On renvoie vers le formulaire
        header("location: register.php");
        exit();
    }

    //Requête SQL qui récupère les utilisateurs qui ont le pseudo envoyé via le formulaire
    $query = $pdo->prepare("SELECT username FROM users WHERE username = ?");
    $query->execute([$_POST['username']]);

    $user = $query->fetch();


    //Si l'utilisateur n'a pas été trouvé, le pseudo n'existe pas encore et donc $user est faux
    //Si ce pseudo existe déjà, $user est différent de faux
    if ($user != false) {
        //le pseudo existe déjà
        //Donc on redirige vers le formulaire
        header("location: register.php");
        exit();
    }

    // Les deux conditions ont été vérifiés


    $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 22);
    $passwordHashed = crypt($_POST['password'], $salt);

    // insertion dans la Base de données.
    $query = $pdo->prepare("INSERT INTO users(username, password) VALUES(?, ?)");
    $query->execute([$_POST['username'], $passwordHashed]);

    //Inscription de l'utilisateur
    //J'enregistre une notification en session
    $_SESSION['message'] = 'Merci de vous être inscrit sur notre magnifique site !';

    header("location: index-blog.php");
    exit();
    
}
