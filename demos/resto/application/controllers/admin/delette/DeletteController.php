<?php

/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 02/12/16
 * Time: 14:08
 */
class DeletteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        $userSession = new UserSession();
        if ($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
        $userSession->isAdministrator();

        if(!empty($queryFields['bookingId']))
        {
            //var_dump($queryFields);
            $model = new BookingModel();
            $booking = $model->deleteBooking($queryFields['bookingId']);
            $flash = new FlashBag();
            $flash->add("La réservation n°". $queryFields['bookingId'] ." a bien été supprimée. ");
            $http->redirectTo('/admin');

        }

        if(!empty($queryFields['productId']))
        {
            //var_dump($queryFields);
            $model = new ProductModel();
            $user = $model->deletteProduct($queryFields["productId"]);
            $flash = new FlashBag();
            $flash->add("Le produit n°". $queryFields['productId'] ." a bien été supprimé. ");
            $http->redirectTo('/admin');
            
        }

        if(!empty($queryFields['userId']))
        {
            //var_dump($queryFields);
            $model = new UserModel();
            $user = $model->deletteUser($queryFields["userId"]);
            $flash = new FlashBag();
            $flash->add("L'utilisateur n°". $queryFields['usergId'] ." a bien été supprimé. ");
            $http->redirectTo('/admin');
        }




    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();
        if ($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
        $userSession->isAdministrator();

        $http->redirectTo('/admin');

    }
}