<?php

class SignupController extends Signup {
    private $mobileNumber;
    private $password;
    private $confirmPassword;
    private $agreeTerms;

    public function __construct($mobileNumber, $password, $confirmPassword, $agreeTerms) {
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->agreeTerms = $agreeTerms;
    }

    public function signupUser() {
        if(!$this->emptyInput()){
            header("location: ../signup.php?error=emptyInput");
            exit();
        }

        if(!$this->mobileNumberTakenCheck()){
            header("location: ../signup.php?error=mobileNumberTaken");
            exit();
        }

        if(!$this->passwordMatch()){
            header("location: ../signup.php?error=passwordDidNotMatch");
            exit();
        }

        if(!$this->checkAgreeTerms()){
            header("location: ../signup.php?error=agreeTerms");
            exit();
        }

        $this->setUser($this->mobileNumber, $this->password);
    }

    private function emptyInput() {
        $result;
        if(empty($this->mobileNumber) || empty($this->password) || empty($this->confirmPassword)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function passwordMatch() {
        $result;
        if($this->password !== $this->confirmPassword){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function mobileNumberTakenCheck() {
        $result;
        if(!$this->checkMobileNumber($this->mobileNumber)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function checkAgreeTerms() {
        $result;
        if($this->agreeTerms != "yes"){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}