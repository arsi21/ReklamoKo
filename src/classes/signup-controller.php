<?php

class SignupController extends Signup {
    private $mobileNumber;
    private $password;
    private $confirmPassword;
    private $agreeTerms;
    private $hashedPassword;

    public function __construct($mobileNumber, $password, $confirmPassword, $agreeTerms) {
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->agreeTerms = $agreeTerms;
    }

    public function verifyInput() {

        $result;

        if(!$this->emptyInput()){
            $result = "emptyInput";
            return $result;
        }

        if(!$this->mobileNumberTakenCheck()){
            $result = "mobileNumberTaken";
            return $result;
        }

        if(!$this->passwordMatch()){
            $result = "passwordDidNotMatch";
            return $result;
        }

        if(!$this->checkAgreeTerms()){
            $result = "agreeTerms";
            return $result;
        }

        $result = "none";
        
        return $result;
    }

    public function signupUser($otp) {
        $result;

        if(!$this->verifyOtp($otp)){
            $result = "invalid";
            return $result;
        }

        $hashedPassword = sha1($this->password);

        $this->setUser($this->mobileNumber, $hashedPassword);

        $result = "none";

        return $result;
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

    private function verifyOtp($otp) {
        //start session
        if(!isset($_SESSION)){
            session_start();
        }
        
        $result;

        if($otp != $_SESSION['otp']){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}