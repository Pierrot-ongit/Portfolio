<?php


class UserModel
{
    public function addUser($lastname, $firstname, $address, $city, $postalCode, $country, $birthday, $phone, $email, $password)
    {
        $db = new Database();
        $db->executeSql("INSERT INTO customers(lastName, firstName, address, city, postalCode, country, birthday,  phone, email, password, role) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'administrateur')",
            [
                $lastname,
                $firstname,
                $address,
                $city,
                $postalCode,
                $country,
                $birthday,
                $phone,
                $email,
                $password
            ]
        );
    }
    
    public function findUser($email)
    {
        $db = new Database();
        $user = $db->queryOne("SELECT * FROM customers WHERE email = ?", [$email]);
        
        return $user;
    }

    public function findAll()
    {
        $db = new Database();
        $users = $db->query("SELECT * FROM customers");

        return $users;
    }

    public function editUser($lastname, $firstname, $address, $city, $postalCode, $country, $phone, $role, $userID)
    {
        $db = new Database();
        $db->executeSql("UPDATE customers 
            SET lastName = ?,
            firstName = ?,
            address = ?,
            city = ?,
            postalCode = ?,
            country = ?,
            phone = ?,
            role = ?
            WHERE id = ?",

            [
                $lastname,
                $firstname,
                $address,
                $city,
                $postalCode,
                $country,
                $phone,
                $role,
                $userID
            ]
        );
    }

    public function deletteUser($userId)
    {
        $db = new Database();
        $db->executeSql("DELETE FROM customers WHERE id =?", [$userId]);
    }

}