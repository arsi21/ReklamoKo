<?php 

class Verification extends Dbh {
    
    protected function setApplication($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $position, $frontId, $backId, $profile) {
        $status = "pending";//default value of status
        $stmt = $this->connect()->prepare('INSERT INTO application (user_id, first_name, middle_name, last_name, suffix, birth_date, gender, position, front_id, back_id, portrait_photo, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
        if(!$stmt->execute(array($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $position, $frontId, $backId, $profile, $status))){
            $stmt = null;
            header("location: ../verification.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}