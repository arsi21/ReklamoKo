<?php 

class Verification extends Dbh {
    
    protected function setApplication($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $email, $position, $houseNumber, $street, $barangay, $postalCode, $frontId, $backId, $profile) {
        $status = "pending";//default value of status
        $stmt = $this->connect()->prepare('INSERT INTO tblapplication (user_id, first_name, middle_name, last_name, suffix, birth_date, gender, email, position, house_number, street, barangay, postal_code, front_id, back_id, profile, application_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
        if(!$stmt->execute(array($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $email, $position, $houseNumber, $street, $barangay, $postalCode, $frontId, $backId, $profile, $status))){
            $stmt = null;
            header("location: ../verification.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}