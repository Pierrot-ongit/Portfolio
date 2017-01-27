<?php


class ProductModel
{
    public function findAll()
    {
        $db = new Database();
        $products = $db->query("SELECT * FROM `products`");

        return $products;
    }

    public function findOne($nameProduct)
    {
        $db = new Database();
        $product = $db->queryOne('SELECT * FROM products WHERE nameProduct = ?', [$nameProduct]);
        return $product;
    }
    public function findOnebyID($productID)
    {
        $db = new Database();
        $product = $db->queryOne('SELECT * FROM products WHERE id = ?', [$productID]);
        return $product;
    }
    //Requete à faire pour vérifier le stock
    public function quantityProduct($productId)
    {
        $db = new Database();
        $product = $db->queryOne('SELECT quantityInStock FROM products WHERE id = ?', [$productId]);
        return $product;
    }

    public function updateQuty($productId, $quantity)
    {
        $db = new Database();
        return $db->executeSql("UPDATE products
                         SET quantityInStock= ?
                         WHERE id = ?", [$quantity, $productId]);

    }

    public function deletteProduct($productId)
    {
        $db = new Database();
        $db->executeSql("DELETE FROM products WHERE id =?", [$productId]);
    }

}