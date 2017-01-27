<?php

class LoginController
{
    public function httpGetMethod()
    {


    }
    public function httpPostMethod(Http $http, array $formFields)
    {

        $errors = [];
        try
        {

            $errors = $this->validate($formFields);

            if (count($errors) > 0)
            {
                throw new DomainException("Il y a des erreurs sur le formulaire");
            }

        }
        catch (DomainException $de)
        {
            return [
                'errorMessage' => $de->getMessage(),
                'errors' => $errors
            ];
        }



        // Il n'y a aucune erreur, le reste du code peut s'executer
        $model = new UserModel();
        $user = $model->findUser($formFields['email']);
        //On crée la session pour l'utilisateur
        $session = new UserSession();
        //Le	premier	paramètre	est	le	nom	du	stockage
        //Le	deuxième	paramètre	est	le	contenu
        $session->create($user);
        $flash = new FlashBag();
        $flash->add("Vous êtes connecté. Bonjour ! ");

        $http->redirectTo('/');



    }

    public function validate($fields)
    {
        $errors = [];
        $user = new UserModel();
        $password = new Password();
        $getuser = $user->findUser($fields['email']);

//        if (empty($fields['email']))
//        {
//            $errors['email'] = "Le champ email ne peut être vide";
//        }
        if (empty($getuser))
        {
            $errors['email'] = "Cet email n'est pas enregistré";
        }

//        if (empty($fields['password']))
//        {
//            $errors['password'] = "Le champ mot de passe ne peut être vide";
//        }

        if ($password->check($fields['password'], $getuser['password']) == false)
        {
            $errors['password'] = "Le mot de passe ne correspond pas à celui enregistré";
        }

        return $errors;
    }
}