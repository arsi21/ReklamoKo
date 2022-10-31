<?php 

class AdminAccount extends Dbh {

    //update
    protected function updateAccessType($id) {
        $ACCESS_TYPE = "admin";
        $stmt = $this->connect()->prepare('UPDATE user
        SET access_type = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($ACCESS_TYPE, $id))){
            $stmt = null;
            header("location: ../admin-account.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }








    //get

    public function getAdminAccounts() {
        $stmt = $this->connect()->query('SELECT u.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM user u
        INNER JOIN application a
        ON u.id = a.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE u.access_type = "admin"
        ORDER BY r.first_name');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    public function getAllResidents() {
        $stmt = $this->connect()->query('SELECT u.id,
        r.first_name,
        r.last_name
        FROM user u
        INNER JOIN application a
        ON u.id = a.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        WHERE u.access_type = "resident"
        ORDER BY r.first_name');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }





    //search

    public function searchAdminAccounts($search) {
        $stmt = $this->connect()->query("SELECT u.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province
        FROM user u
        INNER JOIN application a
        ON u.id = a.user_id
        INNER JOIN resident r
        ON r.id = a.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE u.access_type = 'admin'
        AND u.id
        IN (SELECT u.id
        FROM user u
            INNER JOIN application a
            ON u.id = a.user_id
            INNER JOIN resident r
            ON r.id = a.resident_id
            INNER JOIN postal p
            ON p.id = r.postal_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY r.first_name");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}