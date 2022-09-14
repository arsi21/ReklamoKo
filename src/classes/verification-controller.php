<?php

class VerificationController extends Verification {

    public function checkResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender) {
        if(!$this->emptyInputResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender)){
            header("location: ../verification.php?error=emptyInput");
            exit();
        }

        $result = $this->verifyResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender);
    
        return $result;
    }


    public function addApplication($userId, $residentId, $frontId, $backId, $portraitPhoto) {
        if(!$this->emptyInput($userId, $residentId, $frontId, $backId, $portraitPhoto)){
            header("location: ../verification.php?error=emptyInput");
            exit();
        }

        $this->setApplication($userId, $residentId, $frontId, $backId, $portraitPhoto);
    }


    private function emptyInput($userId, $residentId, $frontId, $backId, $portraitPhoto) {
        $result;
        if(empty($userId) || empty($residentId) || empty($frontId) || empty($backId) || empty($portraitPhoto)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }


    private function emptyInputResidentInfo($firstName, $middleName, $lastName, $suffix, $birthDate, $gender) {
        $result;
        if(empty($firstName) || empty($lastName) || empty($birthDate) || empty($gender)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}