<?php 

class Lupon extends Dbh {

    //get

    public function getAllLupon() {
        $stmt = $this->connect()->query('SELECT l.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM lupon l
        INNER JOIN resident r
        ON r.id = l.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        ORDER BY r.first_name');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}