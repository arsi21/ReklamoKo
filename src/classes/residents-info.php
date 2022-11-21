<?php 

class ResidentsInfo extends Dbh {

    //get

    public function getResident($id) {
        $stmt = $this->connect()->prepare('SELECT r.id,
        r.first_name,
        r.middle_name,
        r.last_name,
        r.suffix,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM resident r
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE r.id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../residents.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}