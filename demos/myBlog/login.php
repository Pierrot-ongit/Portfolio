<?php
session_start();

if(empty($_POST))
{

    $template = 'login';
    include 'layout-blog.phtml';
}
else
{
    include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';
    $pdo = getConnection();
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$_POST['username']]);

    $user = $query->fetch();

    if($user == false)
    {
        //L'utilisateur n'existe pas
        header("location: login.php");
        exit();

    }

    //$user['password']; //Mot de passe haché

    //Vrai si c'est le mot de passe correspond
    //Faux si le mot de passe ne correspond pas
    if($user['password'] == crypt($_POST['password'], $user['password']))
    {
        //Les identifiants correspondent
        //On connecte l'utilisateur

        $_SESSION['auth'] = $user;

        //Redirige vers la page d'accueil
        header("location: index-blog.php");
        exit();

    }
    else
    {
        //Identifiants incorrects
        var_dump($user);
        //header("location: login.php");
        exit();
    }
}
