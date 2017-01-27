
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS 'blog' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE 'blog';

/* Commentaire */

CREATE TABLE IF NOT EXISTS 'articles'(
	'id' int(11) PRIMARY KEY unsigned NOT NULL AUTO_INCREMENT,
    'title' varchar(70) NOT NULL,
    'creationTimestamp' datetime NOT NULL,
	'content' text NOT NULL,
    'authorId' int(11) unsigned NOT NULL,
    'categoryId' int(11) unsigned NOT NULL
)

ALTER table 'articles'

INSERT INTO articles(title, creationTimestamp, content, authorId, categoryId) VALUES('test', '2016-11-07', 'Le contenu...', 3, 2);