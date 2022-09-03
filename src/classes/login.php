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

        $stmt = null;

        $userData = $this->getUserData($user[0]['resident_id']);
        
        session_start();

        //set session
        $_SESSION['userId'] = $user[0]['id'];
        $_SESSION['residentId'] = $user[0]['resident_id'];
        $_SESSION['profile'] = $user[0]['profile'];
        $_SESSION['mobileNumber'] = $user[0]['mobile_number'];
        $_SESSION['accessType'] = $user[0]['access_type'];
        $_SESSION['firstName'] = $userData['firstName'];
        $_SESSION['lastName'] = $userData['lastName'];
    }

    protected function getUserData($residentId) {
        $stmt = $this->connect()->prepare('SELECT * FROM resident WHERE id = ?');
    
        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../login.php?error=stmtfailed");
            exit();
        }

        $resident = $stmt->fetchAll();

        $firstName = $resident[0]['first_name'];
        $lastName = $resident[0]['last_name'];

        $data = array("firstName"=>$firstName, "lastName"=>$lastName);

        $stmt = null;

        return $data;
    }
}