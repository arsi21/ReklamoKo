<?php 

class Resident extends Dbh {

    public function getResidents($residentId) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM resident
        WHERE id != ?');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}