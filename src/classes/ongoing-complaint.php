<?php 

class OngoingComplaint extends Dbh {

    public function getUserOngoingComplaints($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        ongoing_complaint.ongoing_date
        FROM ongoing_complaint 
        INNER JOIN complaint 
        ON complaint.id = ongoing_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND complaint.status = "ongoing"
        ORDER BY ongoing_complaint.ongoing_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../ongoing-complaints.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllOngoingComplaints() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        ongoing_complaint.ongoing_date
        FROM ongoing_complaint 
        INNER JOIN complaint 
        ON complaint.id = ongoing_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        -- WHERE complaint.status = "ongoing"
        ORDER BY ongoing_complaint.ongoing_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    public function getUserOngoingComplaintsCount($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        ongoing_complaint.ongoing_date
        FROM ongoing_complaint 
        INNER JOIN complaint 
        ON complaint.id = ongoing_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND complaint.status = "ongoing"
        ORDER BY ongoing_complaint.ongoing_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../ongoing-complaints.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }


    public function getAllOngoingComplaintsCount() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        ongoing_complaint.ongoing_date
        FROM ongoing_complaint 
        INNER JOIN complaint 
        ON complaint.id = ongoing_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.status = "ongoing"
        ORDER BY ongoing_complaint.ongoing_date DESC');

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }
}