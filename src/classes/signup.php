<?php 

class Signup extends Dbh {
    
    protected function setUser($mobileNumber, $password) {
        $stmt = $this->connect()->prepare('INSERT INTO user (mobile_number, password) VALUES (?, ?)');
    
        if(!$stmt->execute(array($mobileNumber, $password))){
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