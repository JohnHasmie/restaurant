<?php

class Restaurant extends Database {
  
    // database connection and table name
    private $pdo;
    private $table_name = "restaurants";
    private $currentLocation;
  
    public function __construct($currentLocation){
        $this->pdo = $this->connect();
        $this->currentLocation = $currentLocation;
    }

    public function getAll(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    `id`";  
  
        $stmt = $this->pdo->prepare( $query );
        $stmt->execute();

        $restaurants = $stmt->fetchAll();

        foreach ($restaurants as $iRestaurant => $restaurant) {
            $distance = $this->getDistance($restaurant);
            $restaurants[$iRestaurant]->distance = $distance['resourceSets'][0]['resources'][0]['travelDistance'];
        }

        // echo '<pre>'.print_r($restaurants, 1).'</pre>';
        return $restaurants;
    }

    public function getDistance($restaurant) {
        $map = new BingMap();
        $distance = $map->getDistance($this->currentLocation, $restaurant->address);

        return $distance;
    }
}