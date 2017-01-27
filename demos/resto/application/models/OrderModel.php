<?php


class OrderModel
{
    public function addOrder($user)
    {
        $db = new Database();
        return $db->executeSql("INSERT INTO orders(customerId, statuts) VALUES(?, 'pending')",
            [
                $user
            ]
        );
    }

    public function findOrderByUser($user)
    {
        $db = new Database();
        $order = $db->query("SELECT * FROM orders WHERE customerId = ?", [$user]);

        return $order;
    }

    public function findOrderByID($orderId)
    {
        $db = new Database();
        $order = $db->queryOne("SELECT * FROM orders WHERE id = ?", [$orderId]);

        return $order;
    }
    
    public function updateOrderStatus($orderId, $statuts)
    {
        $db = new Database();
        $db->executeSql("UPDATE orders
                         SET statuts= ?
                         WHERE id = ?", [$statuts, $orderId]);
    }

    public function deleteOrder($orderId)
    {
        $db = new Database();
        $db->executeSql("DELETE 
                         FROM ordersDetails
                         WHERE orderNum = ?", [$orderId]);
        $db->executeSql("DELETE 
                         FROM orders
                         WHERE id = ?", [$orderId]);
    }
}