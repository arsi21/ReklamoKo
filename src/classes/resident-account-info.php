<?php 

class ResidentAccountInfo extends Dbh {

    //get

    public function getResidentAccount($id) {
        $stmt = $this->connect()->prepare('SELECT u.id,
        r.first_name,
        r.middle_name,
        r.last_name,
        r.suffix,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province,
        a.front_id,
        a.back_id,
        a.portrait_photo,
        a.date
        FROM user u
        INNER JOIN application a
        ON u.id = a.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE u.id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../resident-accounts.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}