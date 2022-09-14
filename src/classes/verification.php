<?php 

class Verification extends Dbh {

    protected function verifyResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM resident 
        WHERE first_name = ? 
        AND middle_name = ?
        AND last_name = ?
        AND suffix = ?
        AND birth_date = ?
        AND gender = ?');
    
        if(!$stmt->execute(array($firstName, $middleName, $lastName, $suffix, $birthDate, $gender))){
            $stmt = null;
            header("location: ../verification.php?error=stmtfailed");
            exit();
        }

        $result;

        if($stmt->rowCount() == 0){
            $result = 0;
            
            return $result;
        }

        $resident = $stmt->fetchAll();

        $result = $resident[0]['id'];

        $stmt = null;
        
        return $result;
    }
    
    protected function setApplication($userId, $residentId, $frontId, $backId, $profile) {
        $status = "pending";//default value of status
        $stmt = $this->connect()->prepare('INSERT INTO application (user_id, resident_id, front_id, back_id, portrait_photo, status) VALUES (?, ?, ?, ?, ?, ?)');
    
        if(!$stmt->execute(array($userId, $residentId, $frontId, $backId, $profile, $status))){
            $stmt = null;
            header("location: ../verification.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

        $this->updateUserAccessType($userId);
    }

    private function updateUserAccessType($userId) {
        $accessType = "pendingVerification";//default value of status
        $stmt = $this->connect()->prepare('UPDATE user SET access_type = ? WHERE id = ?');
    
        if(!$stmt->execute(array($accessType, $userId))){
            $stmt = null;
            header("location: ../verification.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}