<?php 

class Lupon extends Dbh {


    //set

    protected function setLupon($residentId) {
        $stmt = $this->connect()->prepare('INSERT 
        INTO lupon 
            (resident_id) 
        VALUES (?)');
    
        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../lupon.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }





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

    public function getAllResidents() {
        $stmt = $this->connect()->query('SELECT * 
        FROM resident
        WHERE id NOT IN 
            (SELECT resident_id 
            FROM lupon)
        ORDER BY first_name');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }








    //search

    public function searchAllLupon($search) {
        $stmt = $this->connect()->query("SELECT l.id,
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
        WHERE l.id
        IN (SELECT l.id
            FROM lupon l
            INNER JOIN resident r
            ON r.id = l.resident_id
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