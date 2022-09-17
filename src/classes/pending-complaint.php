<?php 

class PendingComplaint extends Dbh {

    //set

    protected function setOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate) {
        $stmt = $this->connect()->prepare('INSERT INTO ongoing_complaint (complaint_id, lupon_id, ongoing_date) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $luponId, $ongoingDate))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = null;

        $status = "approved";

        $this->updatePendingComplaintStatus($complaintId, $status);
        $this->setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime);
    }

    protected function setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime) {
        $stmt = $this->connect()->prepare('INSERT INTO meeting_schedule (complaint_id, date, time) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $scheduleDate, $scheduleTime))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = null;
    }




    //update
    protected function updatePendingComplaintStatus($complaintId, $status) {
        $stmt = $this->connect()->prepare('UPDATE pending_complaint
        SET status = ?
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($status, $complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function updatePendingComplaintMessage($complaintId, $message) {
        $stmt = $this->connect()->prepare('UPDATE pending_complaint
        SET message = ?
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($message, $complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = null;
    }





    //delete

    protected function deleteComplaint($complaintId) {
        $stmt = $this->connect()->prepare('DELETE 
        FROM pending_complaint
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = $this->connect()->prepare('DELETE 
        FROM proof
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = $this->connect()->prepare('DELETE 
        FROM complaint
        WHERE id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&error=stmtfailed");
            exit();
        }

        $stmt = null;
    }







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
        ON r.id = c.complainant_id
        WHERE c.complainant_id = ?
        AND pc.status != "approved"
        ORDER BY pc.pending_date DESC');

        if(!$stmt->execute(array($comlainantId))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
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
        ON r.id = c.complainant_id
        WHERE pc.status != "approved"
        ORDER BY pc.pending_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getUserPendingComplaint($complaintId, $residentId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        WHERE c.id = ?
        AND c.complainant_id = ?
        AND pc.status != "approved"
        ORDER BY pc.pending_date DESC');

        if(!$stmt->execute(array($complaintId, $residentId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$id&error=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getPendingComplaint($id) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r1.first_name complainant_first_name,
        r1.last_name complainant_last_name,
        r2.first_name complainee_first_name,
        r2.last_name complainee_last_name,
        c.complaint_description,
        pc.pending_date,
        pc.status
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN resident r1
        ON c.complainant_id = r1.id
        INNER JOIN resident r2
        ON c.complainee_id = r2.id
        WHERE c.id = ?
        AND pc.status != "approved"
        ORDER BY pc.pending_date DESC');

        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$id&error=stmtfailed");
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
            header("location: ../pending-complaint.php?id=$id&error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function getLupons() {
        $stmt = $this->connect()->query('SELECT l.id,
        r.first_name,
        r.last_name
        FROM lupon l
        INNER JOIN resident r
        ON l.resident_id = r.id ');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}