<?php


class PayementController
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
                'errors' => $errors,
            ];
        }
        
        
        $session = new Session();
        $getsession = $session->get('user');
        $model = new UserModel();
        $user = $model->findUser($getsession['email']);

        $model = new OrderModel();
        $order = $model->findOrderByID($queryFields['orderId']);
        
        $model = new OrderDetailsModel();
        $orderPayement = $model->orderPayement($order['id']);

        $orderTotalHT = 0;
        foreach ($orderPayement as $cartItem)
        {
            $orderTotalHT = $orderTotalHT + $cartItem['totalHT'];
        }
        $TVA = round($orderTotalHT*0.2, 2);
        $totalTTC = $orderTotalHT + $TVA;


        return [
            'user'=> $user,
            'order'=> $order,
            'orderPayement' => $orderPayement,
            'orderTotalHT'=> $orderTotalHT,
            'TVA' => $TVA,
            'totalTTC'=> $totalTTC,
        ];

    }
    
    public function httpPostMethod(Http $http, array $formFields)
    {
        $errors = [];
        $cart = $formFields;

        try
        {
            //$errors = $this->validate($formFields);

            $model =new ProductModel();

            // Vérifier si la quantité renseigné correspond à la quantité disponible
            for($i = 0; $i < count($cart); ++$i)
            {

                $product = $model->findOne($cart[$i][0]['value']);

                if ($cart[$i][4]['value'] > $product['quantityInStock'])
                {
                    throw new DomainException("La quantité désiré du produit <strong>" . $product['nameProduct'] . " </strong>n'est pas disponible. Maximum = <strong>" . $product['quantityInStock'] . "</strong>");
                }


            }
        }

        catch (DomainException $de)
        {
            return [
                'errorMessage' => $de->getMessage(),
                'errors' => $errors,
                '_raw_template' => true
            ];
        }

        //Récupérer les données de la session concernant l'utilisateur.
        $session	=	new	Session();
        $getsession = $session->get('user');
        $userId = $getsession['id'];

        // Enregistrer l'order
        $model = new OrderModel();
        $orderId = $model->addOrder($userId);


        //Enregistrer l'orderDetails
        $model = new OrderDetailsModel();

        for($i = 0; $i < count($cart); ++$i)
        {
            $orderDetails = $model->addOrder($orderId, $cart[$i][4]['value'], $cart[$i][1]['value'], $cart[$i][0]['value']);
            //$product = $model->findOne($cart[$i][0]['value']);
        }

        $http->sendJsonResponse($orderId);
//        $newOrder = $model->findOrderDetails($orderId);
//        $http->sendJsonResponse($newOrder);

//        return [
//            'cart' => $cart,
//            'newOrder' => $newOrder,
//            '_raw_template' => true
//        ];

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


        if (empty($fields['orderId']))
        {
            $errors[] = "Erreur dans l'identification du panier de commande";
        }

        $model = new UserModel();
        $user = $model->findUser($getsession['email']);
        //On a trouvé l'utilisateur dont la session est ouverte.

        $model = new OrderModel();
        $order = $model->findOrderByID($fields['orderId']);
        if ($order['customerId'] !== $user['id'] )
        {
            $errors[] = "Le panier de commande renseigné n'appartient pas au compte utilisateur connecté";
        }


    }
}