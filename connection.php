<?php

class Database{

    // static variable 

    public static $connection;

    // function ekk hadagannawa 

    public static function setUpConnection(){
        if(!isset(Database::$connection)){
            Database::$connection = new mysqli("localhost","root","277353Hentai@","goku");

        }
    }
    // iud insert update delete  $q kiyanne  query (parameter)
    public static function iud($q){
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    // return value ekk ganna one nisa search wenama 
    public static function search($q){
        Database::setUpConnection();
        $resultset=Database::$connection->query($q);
        return $resultset;
    }
}

?>