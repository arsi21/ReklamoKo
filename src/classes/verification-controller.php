<?php

class VerificationController extends Verification {
    private $userId;
    private $firstName;
    private $middleName;
    private $lastName;
    private $suffix;
    private $birthDate;
    private $gender;
    private $position;
    private $frontId;
    private $backId;
    private $portraitPhoto;

    public function __construct($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $position, $frontId, $backId, $portraitPhoto) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->suffix = $suffix;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->position = $position;
        $this->frontId = $frontId;
        $this->backId = $backId;
        $this->portraitPhoto = $portraitPhoto;
    }

    public function addApplication() {
        if(!$this->emptyInput()){
            header("location: ../verification.php?error=emptyInput");
            exit();
        }

        $this->setApplication($this->userId, $this->firstName, $this->middleName, $this->lastName, $this->suffix, $this->birthDate, $this->gender, $this->position, $this->frontId, $this->backId, $this->portraitPhoto);
    }

    private function emptyInput() {
        $result;
        if(empty($this->userId) || empty($this->firstName) || empty($this->lastName) || empty($this->birthDate) || empty($this->gender) || empty($this->position) || empty($this->frontId) || empty($this->backId) || empty($this->portraitPhoto)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}