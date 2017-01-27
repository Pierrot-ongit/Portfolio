<?php

/** Lien utiles
 *
 * http://php.net/manual/fr/pdostatement.execute.php
 * http://php.net/manual/fr/function.empty.php
 * http://php.net/manual/fr/function.substr.php
 * http://php.net/manual/fr/function.htmlentities.php
 * https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql/
 * https://fr.wikipedia.org/wiki/Cross-site_scripting
 *
 */

//Insertion dans une table
$query = $pdo->prepare("INSERT INTO nom_de_la_table(champ1, champ2, champ3, nom_du_champ_date) VALUES(?, ?, ?, NOW())"); //NE PAS METTRE l'ID !
$query->execute([valeur1, valeur2, valeur3]);

//Insérer la date du jour
$query = $pdo->prepare("INSERT INTO table(champdate) VALUES(NOW())");

//Modification dans une table
$query = $pdo->prepare("UPDATE nom_de_la_table SET nom_du_champ = ?, autre_champ = ?");
$query->execute([nouvelle_valeur, autre_valeur);

//Attention le code ci-dessus modifie toutes les entrées de la table !!
//Pour modifier UNE SEULE entrée il faut préciser l'id dans le where
//Exemple :
$query = $pdo->prepare("UPDATE nom_de_la_table SET nom_du_champ = ?, autre_champ = ?
						WHERE id=?");
$query->execute([nouvelle_valeur, autre_valeur, valeur_de_id]);

//Suppression
$query = $pdo->prepare("DELETE FROM nom_de_la_table WHERE id=?"); //Attention à bien mettre l'id ! Sinon tout est supprimé !

$query->execute([valeur]);

//Redirection HTTP (CF projet liste des taches)
header("location: index.php"); //Redirection vers index.php
exit();

//Vérification qu'une variable existe dans un tableau (CF projet liste des commandes)
isset($_POST["key"]); //OU bien
array_key_exists("key", $_POST);

//Vérifier si un tableau est vide
empty($tableau); //Retourne true si le tableau est vide, false sinon


// http://php.net/manual/fr/function.crypt.php
// http://php.net/manual/fr/function.openssl-random-pseudo-bytes.php

//Fichier index.php
$password = 'pika';
$salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 22);
$passwordHashed = crypt($password, $salt);

//Pour vérifier que le mot de passe $password correspond au hash ($passwordHashed) :
var_dump($passwordHashed == crypt($password, $passwordHashed));

