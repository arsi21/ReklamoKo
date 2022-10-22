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
            header("location: ../login.php?message=emptyInput&mobileNumber=$mobileNumber");
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
}