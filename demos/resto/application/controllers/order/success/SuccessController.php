<?php


class SuccessController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $user = new UserSession();
        if($user->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }


        $errors = [];
        try
        {

            $errors = $this->validate($queryFields);

            if (count($errors) > 0)
            {
                throw new DomainException("Il y a des erreurs dans le processus de commande");
            }

        }
        catch (DomainException $de)
        {
            return [
                'errorMessage' => $de->getMessage(),
                'errors' => $errors
            ];
        }

        $session = new Session();
        $getsession = $session->get('user');

        $orderId = $queryFields['successOrder'];

        $model = new OrderModel();

        $order= $model->updateOrderStatus($orderId, "checked");
        $order = $model->findOrderByID($orderId);
        
        $model = new OrderDetailsModel();
        $orderDetails = $model->findOrderDetails($orderId) ;
        
        $model =new ProductModel();

        for ($i =0; $i < count($orderDetails); $i++)
        {
            $QutyInitiale = $model->quantityProduct($orderDetails[$i]['productId']);
            // Définir la nouvelle quantité à insérer
            $QutyToUpdate = $QutyInitiale['quantityInStock'] - $orderDetails[$i]['orderQuty'];
            // Updater la table products avec les nouvelles quantités.
            $productUpdated = $model->updateQuty($orderDetails[$i]['productId'], $QutyToUpdate );
            // La nouvelle quantité du produit une fois updaté (pour vérifier)
            //$newQuty[] = $model->quantityProduct($orderDetails[$i]['productId']);

        }


        return [
            'orderId' => $orderId,
            'order' => $order,
            'orderDetails' => $orderDetails,
            //'QutyToRemove' => $QutyToRemove,
            //'QutyToUpdate'=> $QutyToUpdate,
            //'productUpdated'=> $productUpdated,
            //'newQuty'=> $newQuty,
            //'user' => $user,
            //'orders'=> $orders,
        ];


        
        

    }
    public function httpPostMethod(Http $http, array $formFields)
    {

    }
    public function validate($fields)
    {
        $errors = [];

        $session = new Session();
        $getsession = $session->get('user');


        if (empty($getsession))
        {
            $errors[] = "Vous n'êtes pas connecté";
        }


        if (empty($fields['successOrder']))
        {
            $errors[] = "Erreur dans l'identification du panier de commande";
        }
        $model = new UserModel();
        $user = $model->findUser($getsession['email']);
        //On a trouvé l'utilisateur dont la session est ouverte.

        $model = new OrderModel();


        $order = $model->findOrderByID($fields['successOrder']);

        if($order['statuts'] == "checked")
        {
            $errors[] = "La commande identifiée a déjà été payé";
        }
        if($order['statuts'] == "cancel")
        {
            $errors[] = "La commande identifiée a déjà été annulée. merci de remplir une nouvelle commande";
        }
        if ($order['customerId'] !== $user['id'] )
        {
            $errors[] = "Le panier de commande renseigné n'appartient pas au compte utilisateur connecté";
        }



        //$orders = $model->findOrderByUser($user['id']);

//        foreach ($orders as $order)
//        {
//            if ($order['customerId'] == $user['id'] )
//            {
//                break;
//            }
//            $errors[] = "Le panier de commande renseigné n'appartient pas au compte utilisateur connecté";
//        }

        return $errors;
    }
}