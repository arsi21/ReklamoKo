<?php 

class PendingComplaint extends Dbh {

    public function getUserPendingComplaints($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        pending_complaint.pending_date,
        pending_complaint.status
        FROM pending_complaint 
        INNER JOIN complaint 
        ON complaint.id = pending_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND pending_complaint.status != "approved"
        ORDER BY pending_complaint.pending_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllPendingComplaints() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        pending_complaint.pending_date,
        pending_complaint.status
        FROM pending_complaint 
        INNER JOIN complaint 
        ON complaint.id = pending_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE pending_complaint.status != "approved"
        ORDER BY pending_complaint.pending_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    public function getUserPendingComplaintsCount($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        pending_complaint.pending_date,
        pending_complaint.status
        FROM pending_complaint 
        INNER JOIN complaint 
        ON complaint.id = pending_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND pending_complaint.status != "approved"
        ORDER BY pending_complaint.pending_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }


    public function getAllPendingComplaintsCount() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        pending_complaint.pending_date,
        pending_complaint.status
        FROM pending_complaint 
        INNER JOIN complaint 
        ON complaint.id = pending_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE pending_complaint.status != "approved"
        ORDER BY pending_complaint.pending_date DESC');

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }
}