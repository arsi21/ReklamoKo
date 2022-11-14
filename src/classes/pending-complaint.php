<?php 

class PendingComplaint extends Dbh {

    //get

    public function getUserPendingComplaints($userId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        ct.type,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        WHERE c.user_id = ?
        AND pc.status != "approved"
        AND pc.is_archive != 1
        ORDER BY pc.complaint_id DESC');

        if(!$stmt->execute(array($userId))){
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
		CONCAT(r.first_name, " ", r.last_name) AS complainant,
        COUNT(r.id) AS complainant_count,
        ct.type,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE pc.status != "approved"
        AND pc.is_archive != 1
        GROUP BY cct.complaint_id
        ORDER BY pc.complaint_id DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getComplainant($id) {
        $stmt = $this->connect()->prepare('SELECT r.first_name,
        r.last_name
        FROM complaint_complainant cct
        INNER JOIN resident r
        ON r.id = cct.complainant_id
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
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        AND pc.is_archive != 1
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
            LIKE '%$search%'
            OR CONCAT(r.first_name, ' ', r.last_name)
            LIKE '%$search%')
        AND pc.is_archive != 1
        ORDER BY pc.complaint_id DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}