<?php

class AccountInfoController extends AccountInfo {


    //edit

    public function editProfile($userId, $profile) {
        $this->updateProfile($userId, $profile);
    }

    public function editPassword($userId, $password, $confirmPassword) {
        if(!$this->validPassword($password)){
            header("location: ../account-info.php?message=invalidPassword");
            exit();
        }

        if(!$this->validConfirmPassword($confirmPassword)){
            header("location: ../account-info.php?message=invalidConfirmPassword");
            exit();
        }

        if(!$this->passwordMatch($password, $confirmPassword)){
            header("location: ../account-info.php?message=passwordDidNotMatch");
            exit();
        }

        $this->updatePassword($userId, $password);
    }







    private function validPassword($password) {
        $result;
        $pattern = "/^.{4,}$/";

        if(!preg_match($pattern, $password)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function validConfirmPassword($confirmPassword) {
        $result;
        $pattern = "/^.{4,}$/";

        if(!preg_match($pattern, $confirmPassword)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function passwordMatch($password, $confirmPassword) {
        $result;
        if($password !== $confirmPassword){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}