<?php 

class PendingComplaint extends Dbh {

    //get

    public function getUserPendingComplaints($residentId) {
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
        WHERE ?
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
        AND pc.status != "approved"
        AND pc.is_archive != 1
        ORDER BY pc.complaint_id DESC');

        if(!$stmt->execute(array($residentId))){
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

    // public function searchUserPendingComplaints($search, $userId) {
    //     $stmt = $this->connect()->query("SELECT c.id,
	// 	CONCAT(r.first_name, ' ', r.last_name) AS complainant,
    //     COUNT(r.id) AS complainant_count,
    //     ct.type,
    //     pc.pending_date,
    //     pc.status
    //     FROM pending_complaint pc
    //     INNER JOIN complaint c
    //     ON c.id = pc.complaint_id 
    //     INNER JOIN complaint_type ct
    //     ON c.complaint_type_id = ct.id
    //     LEFT JOIN comment cm
    //     ON cm.complaint_id = c.id 
    //     INNER JOIN application a
    //     ON a.user_id = c.user_id
    //     INNER JOIN user u
    //     ON u.id = a.user_id
    //     INNER JOIN complaint_complainant cct
    //     ON cct.complaint_id = c.id
    //     INNER JOIN resident r
    //     ON r.id = cct.complainant_id
    //     WHERE pc.status != 'approved'
    //     AND pc.is_archive != 1
    //     AND c.user_id = $userId
    //     AND c.id
    //     IN (SELECT c.id
    //         FROM pending_complaint pc
    //         INNER JOIN complaint c
    //         ON c.id = pc.complaint_id 
    //         INNER JOIN complaint_type ct
    //         ON c.complaint_type_id = ct.id
    //         INNER JOIN complaint_complainant cct
    //         ON cct.complaint_id = c.id
    //         INNER JOIN resident r
    //         ON r.id = cct.complainant_id
    //         WHERE ct.type
    //         LIKE '%$search%')
    //     GROUP BY cct.complaint_id
    //     ORDER BY pc.complaint_id DESC");

    //     $results = $stmt->fetchAll();

    //     $stmt = null;

    //     return $results;
    // }


    public function searchUserPendingComplaints($search, $residentId) {
        $stmt = $this->connect()->query("SELECT c.id,
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
        WHERE $residentId
        IN (SELECT r.id
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = c.id)
        AND pc.status != 'approved'
        AND pc.is_archive != 1
        AND c.id
        IN (SELECT c.id
            FROM pending_complaint pc
            INNER JOIN complaint c
            ON c.id = pc.complaint_id 
            INNER JOIN complaint_type ct
            ON c.complaint_type_id = ct.id
            WHERE ct.type
            LIKE '%$search%')
        ORDER BY pc.complaint_id DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function searchAllPendingComplaints($search) {
        $stmt = $this->connect()->query("SELECT c.id,
		CONCAT(r.first_name, ' ', r.last_name) AS complainant,
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
        WHERE pc.status != 'approved'
        AND pc.is_archive != 1
        AND c.id
        IN (SELECT c.id
            FROM pending_complaint pc
            INNER JOIN complaint c
            ON c.id = pc.complaint_id 
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
        ORDER BY pc.complaint_id DESC");

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}