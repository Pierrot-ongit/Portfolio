<?php


class DetailController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        // Récuparation du changement ajax
        $model = new ProductModel();
        $productSelected = $model->findOne($queryFields['nameProduct']);
        //Envoie les	données	au	format JSON	au lieu de	renvoyer du	HTML
        $http->sendJsonResponse($productSelected);
    }
}