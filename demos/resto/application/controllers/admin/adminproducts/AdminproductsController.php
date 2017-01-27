<?php


class AdminproductsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        $userSession = new UserSession();
        if($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
        $userSession->isAdministrator();

        $model = new ProductModel();
        if(isset($queryFields['nameProduct']))
        {
            $productSelected = $model->findOne($queryFields['nameProduct']);
            return [
                'productSelected' => $productSelected,
                '_raw_template' => true
            ];

        }

        if(isset($queryFields['productId']))
        {
            $id=$queryFields['productId'];

            if(isset($queryFields['AddQuty']))
            {
                $Quty = $model->quantityProduct($id);
                $Quty = intval($Quty['quantityInStock']) + $queryFields['AddQuty'];
                $QutyChange = $model->updateQuty($id, $Quty);
                $product = $model->findOnebyID($id);

                $http->sendJsonResponse($product);
            }
            if(isset($queryFields['RemoveQuty']))
            {
                $Quty = $model->quantityProduct($id);
                $Quty = intval($Quty['quantityInStock']) - $queryFields['RemoveQuty'];
                $QutyChange = $model->updateQuty($id, $Quty);
                $product = $model->findOnebyID($id);

                $http->sendJsonResponse($product);
            }


        }

        else
        {
            $http->redirectTo('/');
        }
        return [
            'test' => "test",

        ];


    }
}