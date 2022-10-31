<?php 

class TransferredComplaint extends Dbh {

    //get

    public function getUserTransferredComplaints($residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = ?
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
        r.first_name,
        r.last_name,
        c.complaint_description,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        ORDER BY tc.transferred_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }







    //search
    public function searchUserTransferredComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = '$residentId'
        AND c.id
        IN (SELECT c.id
            FROM transferred_complaint tc
            INNER JOIN complaint c
            ON c.id = tc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY tc.transferred_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function searchAllTransferredComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        tc.transferred_date
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.id
        IN (SELECT c.id
            FROM transferred_complaint tc
            INNER JOIN complaint c
            ON c.id = tc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        ORDER BY tc.transferred_date DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}