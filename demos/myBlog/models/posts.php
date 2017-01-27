<?php

include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';

/**
 * @return array Liste des articles
 */
function getPosts()
{
    $pdo = getConnection();
    $query = $pdo->prepare("SELECT
            articles.id,
            articles.title,
            content,
            creationTimeStamp,
            firstName,
            lastName,
            categories.title AS categoryName
        FROM
            articles
        INNER JOIN
            authors
        ON
            authorId = authors.id
        INNER JOIN
            categories
        ON
            articles.categoryId = categories.id
        ORDER BY
            creationTimeStamp DESC");

    $query->execute();

    return $query->fetchAll();
}

function addPost($title, $content, $author, $category){
    $pdo = getConnection();

    $query = $pdo->prepare("INSERT INTO articles(title, content, authorId, categoryId, creationTimeStamp ) VALUES(?, ?, ?, ?, NOW())");

    $query->execute([$title, $content, $author, $category,]);


}