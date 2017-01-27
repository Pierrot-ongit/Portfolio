<?php


class ValidationController
{
    public function httpGetMethod(Http $http)
    {
        $user = new UserSession();
        if($user->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
        $errors = [];
        $cart = $formFields;

        try
        {
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


    }
}