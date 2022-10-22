<?php 

class Signup extends Dbh {
    
    protected function setUser($mobileNumber, $password) {
        $ACCESS_TYPE = "nonVerified";//default access type
        $PROFILE = "default.jpg";//default profile
        $stmt = $this->connect()->prepare('INSERT 
        INTO user 
            (mobile_number, 
            password, 
            profile,
            access_type) 
        VALUES 
            (?, ?, ?, ?)');
    
        if(!$stmt->execute(array($mobileNumber, $password,$PROFILE, $ACCESS_TYPE))){
            $stmt = null;
            header("location: ../signup.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkMobileNumber($mobileNumber) {
        $stmt = $this->connect()->prepare('SELECT mobile_number 
        FROM user 
        WHERE mobile_number = ?');
    
        if(!$stmt->execute(array($mobileNumber))){
            $stmt = null;
            header("location: ../signup.php?message=stmtfailed");
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