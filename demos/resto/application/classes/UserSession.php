<?php

/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 01/12/16
 * Time: 11:13
 */
class UserSession extends Session
{
    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        $user = parent::get('user');
        //Si l'utilisateur n'est pas trouvé dans la session
        //$user est null et dans ce cas on retourne true si $use est différent de null
        //Et false si $user est null
        return $user != null;
    }

    /**
     * Redéfinition de la méthode get de la classe parente
     * Va permettre de récupérer les informations directement depuis le stockage "user"
     *
     * @param $name Nom de l'information qui a été ajoutée à la session
     * @return mixed L'informateur de l'utilisateur que l'on veut utiliser
     */
//    public function get($name)
//    {
//        $user = parent::get('user');
//        return $user[$name];
//    }

    /**
     * Création d'une session utilisateur avec les données qu'on veut stocker
     *
     * @param array $data Les données de l'utilisateur à stocker
     */
    public function create(array $data)
    {
        $this->set('user', $data);
    }
    public function isAdministrator()
    {
        $user = parent::get('user');
        if($user['role'] != 'administrateur')
        {
            $http->redirectTo('/');
        }

    }
}