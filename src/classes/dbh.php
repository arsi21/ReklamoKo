<?php

class Dbh {
    protected function connect(){
        try {
            $host = "localhost";
            $user = "root";
            $pwd = "";
            $dbName = "";

            $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
            $dbh = new PDO($dsn, $user, $pwd);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $dbh;
        } catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}