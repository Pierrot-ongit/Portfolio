<?php
class BookingController
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
        // Formatage des données de date récupérés en un format utilisable par mysql
        $bookingDate = $formFields['year'].'-'.$formFields['month'].'-'.$formFields['day'].' '.$formFields['hour'].':'.$formFields['minute'].':00';
        //var_dump($bookingDate);

        // Récupération de l'id du customer via la session
        $session = new Session();
        $customer = $session->get('user');
        //var_dump($customer);

        $model = new BookingModel();
        $model->addBooking($customer['id'], $bookingDate, $formFields['covers']);
        
        
        $flash = new FlashBag();
        $flash->add("Votre réservation a bien été enregistrée ");
        $http->redirectTo('/');
    }
}
