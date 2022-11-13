<?php 

class TransferredComplaintInfo extends Dbh {

    //get

    public function getUserTransferredComplaint($complaintId, $userId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
        (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant,
         (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant_number,
         (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee,
          (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee_number,
        r2.first_name lupon_first_name,
        r2.last_name lupon_last_name,
        ct.type,
        c.complaint_description,
        tc.transferred_date,
        u.profile
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN ongoing_complaint oc
        ON oc.complaint_id = tc.complaint_id
        INNER JOIN lupon l
        ON oc.lupon_id = l.id
        INNER JOIN resident r2
        ON l.resident_id = r2.id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE c.id = ?
        AND c.user_id = ?
        GROUP BY cct.complaint_id');

        if(!$stmt->execute(array($complaintId, $complaintId, $complaintId, $complaintId, $complaintId, $userId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getAllTransferredComplaint($complaintId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
        (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant,
         (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant_number,
         (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee,
          (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee_number,
        r2.first_name lupon_first_name,
        r2.last_name lupon_last_name,
        ct.type,
        c.complaint_description,
        tc.transferred_date,
        u.profile
        FROM transferred_complaint tc
        INNER JOIN complaint c
        ON c.id = tc.complaint_id 
        INNER JOIN ongoing_complaint oc
        ON oc.complaint_id = tc.complaint_id
        INNER JOIN lupon l
        ON oc.lupon_id = l.id
        INNER JOIN resident r2
        ON l.resident_id = r2.id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE c.id = ?
        GROUP BY cct.complaint_id');

        if(!$stmt->execute(array($complaintId, $complaintId, $complaintId, $complaintId, $complaintId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getComplaintProofs($complaintId) {
        $stmt = $this->connect()->prepare('SELECT image
        FROM proof
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../transferred-complaint-info.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getMeetingSchedules($complaintId) {
        $stmt = $this->connect()->prepare('SELECT *
        FROM meeting_schedule
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../transferred-complaint-info.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}