<?php
const serverName = "localhost";
const port = 3306;
const database = "dating_website";
const username = "project";
const password = "project";
const connectionString = "mysql:host=" . serverName . ";dbname=" . database . ";port=" . port;
$stmt = "";
$connection = null;

function getConnection(){
    try {
        $connection = new PDO(connectionString, username, password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $exception) {
        echo "Connection Failed: {$exception->getMessage()}";
    }
    return $connection;
}
