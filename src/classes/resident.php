<?php 

class Resident extends Dbh {

    public function getResidents() {
        $stmt = $this->connect()->query('SELECT * 
        FROM resident');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}