<?php 

class OngoingComplaintInfo extends Dbh {

    //set

    protected function setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime) {
        $stmt = $this->connect()->prepare('INSERT INTO meeting_schedule (complaint_id, date, time) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $scheduleDate, $scheduleTime))){
            $stmt = null;
            header("location: ../ongoing-complaint-info.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function setSolvedComplaint($complaintId, $solvedDate) {
        $stmt = $this->connect()->prepare('INSERT INTO solved_complaint (complaint_id, solved_date) 
        VALUES (?, ?)');
    
        if(!$stmt->execute(array($complaintId, $solvedDate))){
            $stmt = null;
            header("location: ../ongoing-complaint-info.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function setTransferredComplaint($complaintId, $transferredDate) {
        $stmt = $this->connect()->prepare('INSERT INTO transferred_complaint (complaint_id, transferred_date) 
        VALUES (?, ?)');
    
        if(!$stmt->execute(array($complaintId, $transferredDate))){
            $stmt = null;
            header("location: ../ongoing-complaint-info.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }









    //get

    public function getUserOngoingComplaint($complaintId, $userId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
        r.mobile_number complainant_number,
        r2.first_name lupon_first_name,
        r2.last_name lupon_last_name,
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
        ct.type,
        c.complaint_description,
        oc.ongoing_date,
        u.profile
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
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
        WHERE c.id = ?
        AND c.user_id = ?
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

        if(!$stmt->execute(array($complaintId, $complaintId, $complaintId, $complaintId, $complaintId, $userId))){
            $stmt = null;
            header("location: ../ongoing-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }


    public function getAllOngoingComplaint($complaintId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
        r.mobile_number complainant_number,
        r2.first_name lupon_first_name,
        r2.last_name lupon_last_name,
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
        ct.type,
        c.complaint_description,
        oc.ongoing_date,
        u.profile
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
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
        WHERE c.id = ?
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

        if(!$stmt->execute(array($complaintId, $complaintId, $complaintId, $complaintId, $complaintId))){
            $stmt = null;
            header("location: ../ongoing-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }



    public function getComplaintProofs($id) {
        $stmt = $this->connect()->prepare('SELECT image
        FROM proof
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../ongoing-complaint-info.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getMeetingSchedules($id) {
        $stmt = $this->connect()->prepare('SELECT *
        FROM meeting_schedule
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../ongoing-complaint-info.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}