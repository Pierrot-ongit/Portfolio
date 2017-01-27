<?php
if(!function_exists('getConnection'))
{
    /**
     * Retourne la connexion à la base de données
     *
     * @return PDO
     */
    function getConnection()
    {
        //	Connexion à la base de données
        $pdo = new PDO
        (
            'mysql:host=votreserveurmysql;dbname=votrenomdebasededonnées',
            'votre-nom-dutilisateur',
            'votre-mot-de-passe-pour-la-bdd',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        return $pdo;
    }
}

/*
ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
Affiche les erreurs de manière détaillée

PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
mode Fetch_assoc automatiquement. Plus besoin de le répéter à chaque QUERY.
*/