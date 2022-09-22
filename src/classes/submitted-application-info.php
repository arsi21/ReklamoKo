<?php 

class SubmittedApplicationInfo extends Dbh {

    //update

    protected function updateApplicationStatus($applicationId, $status){
        $stmt = $this->connect()->prepare('UPDATE application
        SET status = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($status, $applicationId))){
            $stmt = null;
            header("location: ../submitted-application-info.php?id=$applicationId&error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    //get

    public function getSubmittedApplication($id) {
        $stmt = $this->connect()->prepare('SELECT a.id,
        r.first_name,
        r.middle_name,
        r.last_name,
        r.suffix,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province,
        a.front_id,
        a.back_id,
        a.portrait_photo,
        a.date
        FROM application a
        INNER JOIN resident r
        ON r.id = a.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE a.id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../submitted-application.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}