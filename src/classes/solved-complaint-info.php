<?php 

class solvedComplaintInfo extends Dbh {

    //get

    public function getUserSolvedComplaint($complaintId, $residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        c.complaint_description,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        WHERE c.id = ?
        AND c.complainant_id = ?');

        if(!$stmt->execute(array($complaintId, $residentId))){
            $stmt = null;
            header("location: ../solved-complaints.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getAllSolvedComplaint($complaintId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        c.complaint_description,
        sc.solved_date
        FROM solved_complaint sc
        INNER JOIN complaint c
        ON c.id = sc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        WHERE c.id = ?');

        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../solved-complaints.php?error=stmtfailed");
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
            header("location: ../solved-complaint-info.php?id=$id&error=stmtfailed");
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
            header("location: ../solved-complaint-info.php?id=$id&error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}