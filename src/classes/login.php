<?php 

class Login extends Dbh {
    
    protected function getUser($mobileNumber, $password) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM user 
        WHERE mobile_number = ?');
    
        if(!$stmt->execute(array($mobileNumber))){
            $stmt = null;
            header("location: ../login.php?message=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?message=userNotFound&mobileNumber=$mobileNumber");
            exit();
        }

        $user = $stmt->fetchAll();

        if($password != $user[0]['password']){
            $stmt = null;
            header("location: ../login.php?message=didNotMatch&mobileNumber=$mobileNumber");
            exit();
        }

        $stmt = null;

        $applicationData = $this->getApplicationData($user[0]['id']);
        $residentData = $this->getResidentData($applicationData['residentId']);
        
        session_start();

        //set session
        $_SESSION['userId'] = $user[0]['id'];
        $_SESSION['residentId'] = $applicationData['residentId'];
        $_SESSION['profile'] = $user[0]['profile'];
        $_SESSION['mobileNumber'] = $user[0]['mobile_number'];
        $_SESSION['accessType'] = $user[0]['access_type'];
        $_SESSION['firstName'] = $residentData['firstName'];
        $_SESSION['lastName'] = $residentData['lastName'];
    }

    protected function getResidentData($residentId) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM resident 
        WHERE id = ?');
    
        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../login.php?message=stmtfailed");
            exit();
        }

        $resident = $stmt->fetchAll();

        $firstName = $resident[0]['first_name'];
        $lastName = $resident[0]['last_name'];

        $data = array("firstName"=>$firstName, "lastName"=>$lastName);

        $stmt = null;

        return $data;
    }

    protected function getApplicationData($userId) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM application 
        WHERE user_id = ?');
    
        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../login.php?message=stmtfailed");
            exit();
        }

        $application = $stmt->fetchAll();

        $residentId = $application[0]['resident_id'];

        $data = array("residentId"=>$residentId);

        $stmt = null;

        return $data;
    }
}