<?php

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'bismillah';
    private $databaseName = 'restaurant';

    protected function connect() {
        $dataSourceName = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
        $pdo = new PDO($dataSourceName, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}