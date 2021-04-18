<?php

class Product extends Database {
  
    // database connection and table name
    private $pdo;
    private $tableProduct = "products";
  
    public function __construct(){
        $this->pdo = $this->connect();
    }

    public function getAll($restaurantId = false){
        //select all data
        $query = "SELECT
                    *
                FROM
                     $this->tableProduct";
                    
        if ($restaurantId) {
            $query .= " WHERE `restaurant_id` = $restaurantId";
        }
  
        $stmt = $this->pdo->prepare( $query );
        $stmt->execute();

        $products = $stmt->fetchAll();
  
        return $products;
    }
}