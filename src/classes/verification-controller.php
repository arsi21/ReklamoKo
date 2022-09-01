<?php

class VerificationController extends Verification {
    private $userId;
    private $firstName;
    private $middleName;
    private $lastName;
    private $suffix;
    private $birthDate;
    private $gender;
    private $email;
    private $position;
    private $houseNumber;
    private $street;
    private $barangay;
    private $postalCode;
    private $frontId;
    private $backId;
    private $profile;

    public function __construct($userId, $firstName, $middleName, $lastName, $suffix, $birthDate, $gender, $email, $position, $houseNumber, $street, $barangay, $postalCode, $frontId, $backId, $profile) {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->suffix = $suffix;
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->email = $email;
        $this->position = $position;
        $this->houseNumber = $houseNumber;
        $this->street = $street;
        $this->barangay = $barangay;
        $this->postalCode = $postalCode;
        $this->frontId = $frontId;
        $this->backId = $backId;
        $this->profile = $profile;
    }

    public function addApplication() {
        if(!$this->emptyInput()){
            header("location: ../verification.php?error=emptyInput");
            exit();
        }

        $this->setApplication($this->userId, $this->firstName, $this->middleName, $this->lastName, $this->suffix, $this->birthDate, $this->gender, $this->email, $this->position, $this->houseNumber, $this->street, $this->barangay, $this->postalCode, $this->frontId, $this->backId, $this->profile);
    }

    private function emptyInput() {
        $result;
        if(empty($this->userId) || empty($this->firstName) || empty($this->lastName) || empty($this->birthDate) || empty($this->gender) || empty($this->email) || empty($this->position) || empty($this->houseNumber) || empty($this->street) || empty($this->barangay) || empty($this->postalCode) || empty($this->frontId) || empty($this->backId) || empty($this->profile)){
            $result = true;
        }else {
            $result = true;
        }

        return $result;
    }
}