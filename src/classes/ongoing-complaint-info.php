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

    public function getUserOngoingComplaint($complaintId, $residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        r3.first_name lupon_first_name,
        r3.last_name lupon_last_name,
        ct.type,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        INNER JOIN lupon l
        ON oc.lupon_id = l.id
        INNER JOIN resident r3
        ON l.resident_id = r3.id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE c.id = ?
        AND c.complainant_id = ?
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        ORDER BY oc.ongoing_date DESC');

        if(!$stmt->execute(array($complaintId, $residentId))){
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
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        r3.first_name lupon_first_name,
        r3.last_name lupon_last_name,
        ct.type,
        c.complaint_description,
        oc.ongoing_date
        FROM ongoing_complaint oc
        INNER JOIN complaint c
        ON c.id = oc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        INNER JOIN lupon l
        ON oc.lupon_id = l.id
        INNER JOIN resident r3
        ON l.resident_id = r3.id
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        WHERE c.id = ?
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM solved_complaint)
        AND c.id 
        NOT IN 
            (SELECT complaint_id
            FROM transferred_complaint)
        ORDER BY oc.ongoing_date DESC');

        if(!$stmt->execute(array($complaintId))){
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