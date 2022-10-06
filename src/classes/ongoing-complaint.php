<?php 

class OngoingComplaint extends Dbh {

    //get

    public function getUserOngoingComplaints($residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = ?
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        ORDER BY oc.ongoing_date DESC');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../ongoing-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllOngoingComplaints() {
        $stmt = $this->connect()->query('SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        ORDER BY oc.ongoing_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }






    //search

    public function searchUserOngoingComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = '$residentId'
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        AND c.id
        IN (SELECT c.id
            FROM ongoing_complaint oc
            INNER JOIN complaint c
            ON c.id = oc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%')
        ORDER BY oc.ongoing_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function searchAllOngoingComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        AND c.id
        IN (SELECT c.id
            FROM ongoing_complaint oc
            INNER JOIN complaint c
            ON c.id = oc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%')
        ORDER BY oc.ongoing_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}