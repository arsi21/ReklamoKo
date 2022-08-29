<?php 

class Login extends Dbh {
    
    protected function getUser($mobileNumber, $password) {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE mobile_number = ?');
    
        if(!$stmt->execute(array($mobileNumber))){
            $stmt = null;
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?error=userNotFound");
            exit();
        }

        $user = $stmt->fetchAll();

        if($password != $user[0]['password']){
            $stmt = null;
            header("location: ../login.php?error=wrongPassword");
            exit();
        }
        
        session_start();

        //set session
        $_SESSION['userId'] = $user[0]['id'];
        $_SESSION['mobileNumber'] = $user[0]['mobile_number'];

        $stmt = null;
    }
}