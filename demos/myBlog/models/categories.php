<?php

include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';

function getCategories()
{
    $pdo = getConnection();

    $query = $pdo->prepare(
        '
        SELECT id, title
        FROM categories
    ');

    $query->execute();

    return $query->fetchAll();
}