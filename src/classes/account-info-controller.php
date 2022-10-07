<?php

class AccountInfoController extends AccountInfo {


    //edit

    public function editProfile($userId, $profile) {
        $this->updateProfile($userId, $profile);
    }

    public function editPassword($userId, $password, $confirmPassword) {
        if(!$this->passwordMatch($password, $confirmPassword)){
            header("location: ../account-info.php?message=passwordDidNotMatch");
            exit();
        }

        $this->updatePassword($userId, $password);
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