<?php

class Order extends Database {
  
    // database connection and table name
    private $pdo;
    private $tableOrder = "orders";
    private $tableItem = "order_items";
    private $tableProduct = "products";
    private $userId;
  
    public function __construct(){
        $this->pdo = $this->connect();
        $this->userId = @$_SESSION['user_session'];
    }

    public function orderProduct($productId, $price) {
        $orderId = $this->findOrCreateOrder();
        $item = $this->findOrCreateItem($orderId, $productId, $price);
        $this->syncOrderItem($orderId, $item);
    }

    private function syncOrderItem($orderId, $item) {
        [$itemCount, $price] = array_values($item);

        $queryUpdate = "UPDATE $this->tableOrder SET `grand_total` = `grand_total` + $price, `item_count` = `item_count` + $itemCount WHERE `id` = $orderId";
        $stmt = $this->pdo->prepare( $queryUpdate );
        $stmt->execute();
    }

    private function findOrCreateOrder() {
        $query = "SELECT * FROM $this->tableOrder WHERE `user_id` = $this->userId AND `status` = 'pending'";
        $stmt = $this->pdo->prepare( $query );
        $stmt->execute();
        $product = $stmt->fetch();

        if ($product) {
            return $product->id;
        } else {
            // $orderNumber = time().'-'.mt_rand();
            $orderNumber = 'ORD-'.strtoupper(uniqid());
            $queryCreateOrder = "INSERT INTO $this->tableOrder (order_number, user_id, grand_total, item_count) values (:order_number, :user_id, 0, 0)";
            $stmt = $this->pdo->prepare( $queryCreateOrder );
            $stmt->BindParam(':order_number', $orderNumber);
            $stmt->BindParam(':user_id', $this->userId);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }

    private function findOrCreateItem($orderId, $productId, $price) {
        $query = "SELECT * FROM $this->tableItem WHERE `order_id` = $orderId AND `product_id` = $productId";
        $stmt = $this->pdo->prepare( $query );
        $stmt->execute();
        $item = $stmt->fetch();

        if ($item) {
            $queryUpdate = "UPDATE $this->tableItem SET `quantity` = `quantity` + 1 WHERE `id` = $item->id";
            $stmt = $this->pdo->prepare( $queryUpdate );
            $stmt->execute();

            return ['new_item' => 0, 'price' => $price];
        } else {
            $queryCreateItem = "INSERT INTO $this->tableItem (order_id, product_id, quantity, price) VALUE (:order_id, :product_id, 1, :price)";
            $stmt = $this->pdo->prepare( $queryCreateItem );
            $stmt->BindParam(':order_id', $orderId);
            $stmt->BindParam(':product_id', $productId);
            $stmt->BindParam(':price', $price);
            $stmt->execute();
            // return $this->pdo->lastInsertId();
            return ['new_item' => 1, 'price' => $price];
        }
    }

    public function getAll(){
        //select all data
        $query = "SELECT *, $this->tableItem.quantity AS item_quantity, $this->tableItem.id AS item_id FROM $this->tableItem 
            JOIN $this->tableOrder ON $this->tableOrder.id = $this->tableItem.order_id
            JOIN $this->tableProduct ON $this->tableProduct.id = $this->tableItem.product_id
            WHERE $this->tableOrder.status = 'pending'
            GROUP BY $this->tableItem.id";
  
        $stmt = $this->pdo->prepare( $query );
        $stmt->execute();

        $orders = $stmt->fetchAll();

        // echo '<pre>'.print_r($orders, 1).'</pre>';
        return $orders;
    }

    public function payOrder($orderNumber, $method) {
        $query = "SELECT * FROM $this->tableOrder WHERE `order_number` = :order_number AND `status` = 'pending'";
        $stmt = $this->pdo->prepare( $query );
        $stmt->bindParam(':order_number', $orderNumber, PDO::PARAM_STR);
        $stmt->execute();
        $order = $stmt->fetch();

        if ($order) {
            $queryUpdate = "UPDATE $this->tableOrder 
                SET `status` = 'processing',  `payment_status` = 1, `payment_method` = :payment_method
                WHERE `id` = :order_id";

            $stmt = $this->pdo->prepare( $queryUpdate );
            $stmt->bindParam(':payment_method', $method, PDO::PARAM_STR);
            $stmt->bindParam(':order_id', $order->id);
            $stmt->execute();
        }
    }
}
