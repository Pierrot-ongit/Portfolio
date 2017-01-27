<?php

include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';

/**
 * @return array Liste des auteurs
 */
function getAuthors()
{
    $pdo = getConnection();

    $query = $pdo->prepare('
            SELECT
                id,
                firstName,
                lastName
            FROM
                authors
        ');
    $query->execute();
//    $authors = $query->fetchAll();
//    return $authors;

    return $query->fetchAll();
}