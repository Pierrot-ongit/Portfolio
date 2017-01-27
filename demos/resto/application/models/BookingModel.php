<?php


class BookingModel
{
    public function addBooking($customerId, $bookingDate, $covers)
    {
        $db = new Database();
        $db->executeSql("INSERT INTO booking(customerId, bookingDate, covers) 
                        VALUES(?, ?, ?)",
            [
                $customerId,
                $bookingDate,
                $covers
            ]
        );
    }

    public function findAllBookings()
    {
        $db = new Database();
        $bookings = $db->query("SELECT * FROM booking ORDER BY bookingDate");
        return $bookings;
    }

    public function findOne($id)
    {
        $db = new Database();
        $bookings = $db->query("SELECT * FROM booking WHERE id =?", [$id]);
        return $bookings;
    }

    public function deleteBooking($id)
    {
        $db = new Database();
        $db->executeSql("DELETE FROM booking WHERE id =?", [$id]);
    }
}