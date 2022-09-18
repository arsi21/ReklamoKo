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
        ON r.id = c.complainant_id
        WHERE c.complainant_id = ?
        ORDER BY tc.transferred_date DESC');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?error=stmtfailed");
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
        ON r.id = c.complainant_id
        ORDER BY tc.transferred_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}