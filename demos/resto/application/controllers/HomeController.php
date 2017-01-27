<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $model = new ProductModel();
        $products = $model->findAll();

        if(isset($queryFields['cancelOrder']))
        {
            $orderId= $queryFields['cancelOrder'];

            $session = new Session();
            $getsession = $session->get('user');

            $model = new UserModel();
            $user = $model->findUser($getsession['email']);

            $model = new OrderModel();
            $order = $model->findOrderByID($orderId);
            if ($order['customerId'] !== $user['id'] )
            {
                $flash = new FlashBag();
                $flash->add("Le panier de commande renseigné n'appartient pas au compte utilisateur connecté");
            }
            else
            {
                $order = $model->deleteOrder($orderId);
                $flash = new FlashBag();
                $flash->add("Votre commande a été annulée.");
            }
            
        }

        return [
          'products'=> $products,
           'flash'=> new FlashBag()
        ];

    }
}
