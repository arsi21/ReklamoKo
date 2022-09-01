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

        $userId = $user[0]['id'];
        $userMobileNumber = $user[0]['mobile_number'];

        $stmt = null;
        
        session_start();

        //set session
        $_SESSION['userId'] = $userId;
        $_SESSION['mobileNumber'] = $userMobileNumber;
        $_SESSION['access'] = $this->getUserAccess($userId);
    }

    protected function getUserAccess($userId) {
        $stmt = $this->connect()->prepare('SELECT * FROM tblapplication WHERE user_id = ?');
    
        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        $user = $stmt->fetchAll();

        if($stmt->rowCount() != 0){
            if($user[0]['application_status'] == "pending"){
                $userAccess = "pendingVerification";
            }else{
                $userAccess = $user[0]['position'];
            }
        }else{
            $userAccess = "nonVerified";
        }

        $stmt = null;

        return $userAccess;
    }
}