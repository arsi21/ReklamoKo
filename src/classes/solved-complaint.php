<?php 

class SolvedComplaint extends Dbh {

    //get

    public function getUserSolvedComplaints($residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE ?
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
        GROUP BY cct.complaint_id
        ORDER BY sc.solved_date DESC');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../solved-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllSolvedComplaints() {
        $stmt = $this->connect()->query('SELECT c.id,
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        GROUP BY cct.complaint_id
        ORDER BY sc.solved_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }





    //search

    public function searchUserSolvedComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = '$residentId'
        AND c.id
        IN (SELECT c.id
            FROM solved_complaint sc
            INNER JOIN complaint c
            ON c.id = sc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY sc.solved_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function searchAllSolvedComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.id
        IN (SELECT c.id
            FROM solved_complaint sc
            INNER JOIN complaint c
            ON c.id = sc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY sc.solved_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}