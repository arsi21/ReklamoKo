<?php 

class TransferredComplaint extends Dbh {

    public function getUserTransferredComplaints($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        transferred_complaint.transferred_date
        FROM transferred_complaint 
        INNER JOIN complaint 
        ON complaint.id = transferred_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND complaint.status = "transferred"
        ORDER BY transferred_complaint.transferred_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?error=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }

    public function getAllTransferredComplaints() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        transferred_complaint.transferred_date
        FROM transferred_complaint 
        INNER JOIN complaint 
        ON complaint.id = transferred_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.status = "transferred"
        ORDER BY transferred_complaint.transferred_date DESC');

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }




    public function getUserTransferredComplaintsCount($userId) {
        $stmt = $this->connect()->prepare('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        transferred_complaint.transferred_date
        FROM transferred_complaint 
        INNER JOIN complaint 
        ON complaint.id = transferred_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.user_id = ?
        AND complaint.status = "transferred"
        ORDER BY transferred_complaint.transferred_date DESC');

        if(!$stmt->execute(array($userId))){
            $stmt = null;
            header("location: ../transferred-complaints.php?error=stmtfailed");
            exit();
        }

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }


    public function getAllTransferredComplaintsCount() {
        $stmt = $this->connect()->query('SELECT complaint.id,
        resident.first_name,
        resident.last_name,
        complaint.complaint_description,
        transferred_complaint.transferred_date
        FROM transferred_complaint 
        INNER JOIN complaint 
        ON complaint.id = transferred_complaint.complaint_id 
        INNER JOIN user
        ON complaint.user_id = user.id
        INNER JOIN application
        ON user.id = application.user_id
        INNER JOIN resident
        ON resident.id = application.resident_id
        WHERE complaint.status = "transferred"
        ORDER BY transferred_complaint.transferred_date DESC');

        $result = $stmt->rowCount();

        $stmt = null;

        return $result;
    }
}