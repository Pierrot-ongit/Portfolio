<?php


class MenuController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        $model = new ProductModel();
        $productSelected = $model->findOne($queryFields['nameProduct']);
        return [
            'productSelected' => $productSelected,
            '_raw_template' => true
        ];
    }
}