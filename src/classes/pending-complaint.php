<?php 

class PendingComplaint extends Dbh {

    //get

    public function getUserPendingComplaints($comlainantId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = ?
        AND pc.status != "approved"
        ORDER BY pc.complaint_id DESC');

        if(!$stmt->execute(array($comlainantId))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllPendingComplaints() {
        $stmt = $this->connect()->query('SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE pc.status != "approved"
        ORDER BY pc.complaint_id DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getComplaintProofs($id) {
        $stmt = $this->connect()->prepare('SELECT image
        FROM proof
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    //search

    public function searchUserPendingComplaints($search, $complainantId) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE c.complainant_id = '$complainantId'
        AND pc.status != 'approved'
        AND c.id
        IN (SELECT c.id
            FROM pending_complaint pc
            INNER JOIN complaint c
            ON c.id = pc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%')
        ORDER BY pc.complaint_id DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function searchAllPendingComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
        r.first_name,
        r.last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r
        ON r.id = c.complainee_id
        WHERE pc.status != 'approved'
        AND c.id
        IN (SELECT c.id
            FROM pending_complaint pc
            INNER JOIN complaint c
            ON c.id = pc.complaint_id 
            INNER JOIN resident r
            ON r.id = c.complainee_id
            WHERE r.first_name
            LIKE '%$search%'
            OR r.last_name
            LIKE '%$search%')
        ORDER BY pc.complaint_id DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}