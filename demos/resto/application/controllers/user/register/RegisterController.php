<?php


class RegisterController
{
    public function httpGetMethod()
    {

    }
    public function httpPostMethod(Http $http, array $formFields)
    {
        $errors = [];
        try
        {
            /* correspond à ce qu'on récupère dans le model */
            $user = new UserModel();
            $getuser = $user->findUser($formFields['email']);

            if (!empty($getuser))
            {
                throw new DomainException("Le champ email existe déjà");
            }

            $errors = $this->validate($formFields);

            if (count($errors) > 0)
            {
                throw new DomainException("Il y a des erreurs sur le formulaire");
            }

        } catch (DomainException $de)
        {
            return [
                'errorMessage' => $de->getMessage(),
                'errors' => $errors
            ];
        }

        //Hachage du password
        $password = new Password();
        $passwordHashed = $password->hash($formFields['password']);


        // Formatage des données de date récupérés en un format utilisable par mysql
        $birthday = $formFields['year'].'-'.$formFields['month'].'-'.$formFields['day'];


        $model = new UserModel();
        $model->addUser($formFields['lastname'], $formFields['firstname'], $formFields['address'], $formFields['city'], $formFields['zipcode'], $formFields['country'], $birthday, $formFields['phone'], $formFields['email'], $passwordHashed);

        $flash = new FlashBag();
        $flash->add("Votre compte utilisateur a bien été créé");
        $http->redirectTo('/');

    }

    public function validate($fields)
    {
        $errors = [];

        if(empty($fields['lastname']))
        {
            $errors['lastname'] = "Le champ nom ne peut être vide";
        }
        if(empty($fields['firstname']))
        {
            $errors['firstname'] = "Le champ prénom ne peut être vide";
        }
        if(empty($fields['address']))
        {
            $errors['address'] = "Le champ adresse ne peut être vide";
        }
        if(empty($fields['zipcode']))
        {
            $errors['zipcode'] = "Le champ code postal ne peut être vide";
        }
        if(empty($fields['email']))
        {
            $errors['email'] = "Le champ email ne peut être vide";
        }
 
        if(strlen($fields['password']) < 8)
        {
            $errors['password'] = "Le champ mot de passe doit avoir au-moins 8 caractères";
        }


        return $errors;
    }
}