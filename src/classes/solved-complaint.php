<?php 

class SolvedComplaint extends Dbh {

    public function getUserSolvedComplaints($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        solved_complaint.solved_date
        FROM solved_complaint 
        INNER JOIN complaint 
        ON complaint.id = solved_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN resident
        ON resident.id = user.resident_id
        WHERE complaint.user_id = ?
        ORDER BY solved_complaint.solved_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../solved-complaints.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllSolvedComplaints() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        solved_complaint.solved_date
        FROM solved_complaint 
        INNER JOIN complaint 
        ON complaint.id = solved_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN resident
        ON resident.id = user.resident_id
        ORDER BY solved_complaint.solved_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    public function getUserSolvedComplaintsCount($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        solved_complaint.solved_date
        FROM solved_complaint 
        INNER JOIN complaint 
        ON complaint.id = solved_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN resident
        ON resident.id = user.resident_id
        WHERE complaint.user_id = ?
        ORDER BY solved_complaint.solved_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../solved-complaints.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }


    public function getAllSolvedComplaintsCount() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        solved_complaint.solved_date
        FROM solved_complaint 
        INNER JOIN complaint 
        ON complaint.id = solved_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN resident
        ON resident.id = user.resident_id
        ORDER BY solved_complaint.solved_date DESC');

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }
}