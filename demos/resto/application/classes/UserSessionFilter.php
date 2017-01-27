<?php

/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 01/12/16
 * Time: 11:12
 */
class UserSessionFilter implements InterceptingFilter
{

    public function run(Http $http, array $queryFields, array $formFields)
    {

        //Création d'une variable $user disponible dans toutes les vues
        //Et contenant des informations de la session utilisateur
        return [
            'user' => new UserSession()
        ];
    }
}