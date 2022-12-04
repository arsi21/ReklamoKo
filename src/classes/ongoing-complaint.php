<?php 

class OngoingComplaint extends Dbh {

    //get

    public function getUserOngoingComplaints($residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE ?
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        GROUP BY cct.complaint_id
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
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        GROUP BY cct.complaint_id
        ORDER BY oc.ongoing_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }






    //search

    public function searchUserOngoingComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
        CONCAT(r.first_name, ' ', r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE $residentId
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
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
            INNER JOIN complaint_type ct
            ON c.complaint_type_id = ct.id
            INNER JOIN complaint_complainant cct
            ON cct.complaint_id = c.id
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%'
            OR ct.type
            LIKE '%$search%')
        GROUP BY cct.complaint_id
        ORDER BY oc.ongoing_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function searchAllOngoingComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        CONCAT(r.first_name, ' ', r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
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
            INNER JOIN complaint_type ct
            ON c.complaint_type_id = ct.id
            INNER JOIN complaint_complainant cct
            ON cct.complaint_id = c.id
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%'
            OR ct.type
            LIKE '%$search%')
        GROUP BY cct.complaint_id
        ORDER BY oc.ongoing_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}