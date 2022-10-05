<?php 

class LuponInfo extends Dbh {


    //delete

    protected function deleteLupon($luponId){
        $stmt = $this->connect()->prepare('DELETE 
        FROM lupon
        WHERE id = ?');

        if(!$stmt->execute(array($luponId))){
            $stmt = null;
            header("location: ../lupon.php?error=stmtfailed");
            exit();
        }
    }







    //get

    public function getLupon($id) {
        $stmt = $this->connect()->prepare('SELECT l.id,
        r.first_name,
        r.middle_name,
        r.last_name,
        r.suffix,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM lupon l
        INNER JOIN resident r
        ON r.id = l.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE l.id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../lupon.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }
}