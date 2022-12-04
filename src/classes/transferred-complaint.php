<?php 

class TransferredComplaint extends Dbh {

    //get

    public function getUserTransferredComplaints($residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
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
        ORDER BY tc.transferred_date DESC');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllTransferredComplaints() {
        $stmt = $this->connect()->query('SELECT c.id,
        CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        GROUP BY cct.complaint_id
        ORDER BY tc.transferred_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }







    //search
    public function searchUserTransferredComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
        CONCAT(r.first_name, ' ', r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE $residentId
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
        AND c.id
        IN (SELECT c.id
            FROM transferred_complaint tc
            INNER JOIN complaint c
            ON c.id = tc.complaint_id 
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
        ORDER BY tc.transferred_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function searchAllTransferredComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        CONCAT(r.first_name, ' ', r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE c.id
        IN (SELECT c.id
            FROM transferred_complaint tc
            INNER JOIN complaint c
            ON c.id = tc.complaint_id 
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
        ORDER BY tc.transferred_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}