<?php 

class AccountInfo extends Dbh {

    //update

    protected function updateProfile($userId, $profile) {
        $stmt = $this->connect()->prepare('UPDATE user
        SET profile = ?
        WHERE id = ?');

        if(!$stmt->execute(array($profile, $userId))){
            $stmt = null;
            header("location: ../account-info.php?message=stmtfailed");
            exit();
        }

        $stmt = null;

        $_SESSION['profile'] = $profile;
    }

    protected function updatePassword($userId, $password) {
        $hashedPassword = sha1($password);
        $stmt = $this->connect()->prepare('UPDATE user
        SET password = ?
        WHERE id = ?');

        if(!$stmt->execute(array($hashedPassword, $userId))){
            $stmt = null;
            header("location: ../account-info.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }








    //get

    public function getUser($userId) {
        $stmt = $this->connect()->prepare('SELECT mobile_number,
        password,
        profile
        FROM user
        WHERE id = ?');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../account-info.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}