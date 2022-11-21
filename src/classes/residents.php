<?php 

class Residents extends Dbh {

    //get

    public function getResidents() {
        $stmt = $this->connect()->query('SELECT r.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM resident r
        INNER JOIN postal p
        ON p.id = r.postal_id
        ORDER BY r.first_name');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }





    //search

    public function searchResidents($search) {
        $stmt = $this->connect()->query("SELECT r.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM resident r
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE r.id
        IN (SELECT r.id
            FROM resident r
            INNER JOIN postal p
            ON p.id = r.postal_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY r.first_name");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}