<?php 

class SubmittedApplication extends Dbh {

    //get

    public function getSubmittedApplications() {
        $stmt = $this->connect()->query('SELECT a.id,
        r.first_name,
        r.last_name,
        r.house_number,
        r.street,
        r.barangay,
        p.city,
        p.province,
        a.date
        FROM application a
        INNER JOIN resident r
        ON r.id = a.resident_id
        INNER JOIN postal p
        ON p.id = r.postal_id
        WHERE status = "pending"');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}