<?php

class LoginController extends Login {
    private $mobileNumber;
    private $password;
    private $hashedPassword;

    public function __construct($mobileNumber, $password) {
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
    }

    public function loginUser() {
        if(!$this->emptyInput()){
            header("location: ../login.php?message=emptyInput&mobileNumber=$this->mobileNumber");
            exit();
        }

        if(!$this->validMobileNumber()){
            header("location: ../login.php?message=invalidMobileNumber");
            exit();
        }

        if(!$this->validPassword()){
            header("location: ../login.php?message=invalidPassword&mobileNumber=$this->mobileNumber");
            exit();
        }

        $hashedPassword = sha1($this->password);

        $this->getUser($this->mobileNumber, $hashedPassword);
    }

    private function emptyInput() {
        $result;
        if(empty($this->mobileNumber) || empty($this->password)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function validMobileNumber() {
        $result;
        $pattern = "/^(09)\d{9}$/";

        if(!preg_match($pattern, $this->mobileNumber)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function validPassword() {
        $result;
        $pattern = "/^.{4,}$/";

        if(!preg_match($pattern, $this->password)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}