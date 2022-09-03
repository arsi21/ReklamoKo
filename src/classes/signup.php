<?php 

class Signup extends Dbh {
    
    protected function setUser($mobileNumber, $password) {
        $accessType = "nonVerified";//default access type
        $stmt = $this->connect()->prepare('INSERT INTO user (mobile_number, password, access_type) VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($mobileNumber, $password, $accessType))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkMobileNumber($mobileNumber) {
        $stmt = $this->connect()->prepare('SELECT mobile_number FROM user WHERE mobile_number = ?');
    
        if(!$stmt->execute(array($mobileNumber))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $result;
        if($stmt->rowCount() > 0){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}