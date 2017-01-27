<?php


class AdminController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
        $userSession->isAdministrator();


        $model = new BookingModel();
        $bookings = $model->findAllBookings();

        $model = new ProductModel();
        $products = $model->findAll();

        $model = new UserModel();
        $users = $model->findAll();

        return [
            'products'=> $products,
            'bookings'=> $bookings,
            'users'=> $users,
            'flash'=> new FlashBag()
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated() == false)
        {
            $http->redirectTo('/');
        }
        $userSession->isAdministrator();

        
        $model = new BookingModel();
        $bookings = $model->findAllBookings();

        $model = new ProductModel();
        $products = $model->findAll();

        // Gestion des users et edition d'un profil
        $model = new UserModel();
        if (!empty($formFields['userID']))
        {
            //var_dump($formFields);
            $editUser = $model->editUser($formFields['lastName'], $formFields['firstName'], $formFields['address'], $formFields['City'], $formFields['ZipCode'], $formFields['Country'], $formFields['phone'], $formFields['role'], $formFields['userID']);
        }

        $users = $model->findAll();

        return [
            'products'=> $products,
            'bookings'=> $bookings,
            'users'=> $users,
            'flash'=> new FlashBag()
        ];
    }

    public function writeAdminPage()
    {



    }


}