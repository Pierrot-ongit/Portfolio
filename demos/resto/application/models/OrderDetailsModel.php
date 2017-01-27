<?php


class OrderDetailsModel
{
    public function addOrder($orderNum, $orderQuty, $productId, $productName)
    {
        $db = new Database();
        $db->executeSql("INSERT INTO ordersDetails(orderNum, OrderQuty, productId, productName) VALUES(?, ?, ?, ?)",
            [
                $orderNum,
                $orderQuty,
                $productId,
                $productName,
            ]
        );
    }
    
    public function findOrderDetails($orderNum)
    {
        $db = new Database();
        $orderDetails = $db->query("SELECT * FROM ordersDetails WHERE orderNum = ?", [$orderNum]);

        return $orderDetails;
    }
    public function orderPayement($orderNum)
    {
        $db = new Database();
        $orderPayement = $db->query("
            SELECT ROUND(SUM(salePrice * orderQuty), 2) AS totalHT, ordersDetails.id, orderNum, orderQuty, productId, productName, image, salePrice 
            FROM ordersDetails
            INNER JOIN products ON ordersDetails.productId = products.id
            WHERE orderNum = ?
            GROUP BY productId
            ", [$orderNum]);

        return $orderPayement;
    }

    public function queryTotalHT($orderNum)
    {
        $db = new Database();
        $orderPayement = $db->query("
            SELECT ROUND(SUM(salePrice * orderQuty), 2) AS totalHT, productId, orderNum, orderQuty,  salePrice 
            FROM ordersDetails
            INNER JOIN products ON ordersDetails.productId = products.id
            WHERE orderNum = ?
            GROUP BY productId
            ", [$orderNum]);


        return $orderPayement;
    }

   

}