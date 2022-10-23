<?php 

class SubmittedApplicationInfo extends Dbh {

    //update

    protected function updateApplicationStatus($applicationId, $status){
        $stmt = $this->connect()->prepare('UPDATE application
        SET status = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($status, $applicationId))){
            $stmt = null;
            header("location: ../submitted-application-info.php?id=$applicationId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function updateUserAccessType($userId, $accessType){
        $stmt = $this->connect()->prepare('UPDATE user
        SET access_type = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($accessType, $userId))){
            $stmt = null;
            header("location: ../submitted-application-info.php?id=$applicationId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function updateMobileNumber($id, $number){
        $stmt = $this->connect()->prepare('UPDATE resident
        SET mobile_number = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($number, $id))){
            $stmt = null;
            header("location: ../submitted-application-info.php?id=$applicationId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }





    //delete

    protected function deleteApplication($applicationId){
        $stmt = $this->connect()->prepare('DELETE 
        FROM application
        WHERE id = ?');
    
        if(!$stmt->execute(array($applicationId))){
            $stmt = null;
            header("location: ../submitted-application-info.php?id=$applicationId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }








    //get

    public function getSubmittedApplication($id) {
        $stmt = $this->connect()->prepare('SELECT a.id,
        a.user_id,
        r.id resident_id,
        r.first_name,
        r.middle_name,
        r.last_name,
        r.suffix,
        u.mobile_number,
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
        INNER JOIN user u
        ON u.id = a.user_id
        WHERE a.id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../submitted-application.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}