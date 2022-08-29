<?php

class LoginController extends Login {
    private $mobileNumber;
    private $password;

    public function __construct($mobileNumber, $password) {
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
    }

    public function loginUser() {
        if(!$this->emptyInput()){
            header("location: ../login.php?error=emptyInput");
            exit();
        }

        $this->getUser($this->mobileNumber, $this->password);
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
}