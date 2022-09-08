<?php 

class Complaint extends Dbh {

    protected function setComplaint($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate) {
        $status = "pending"; //default status
        $stmt = $this->connect()->prepare('INSERT INTO complaint (user_id, complainee_id, complaint_description, proof1, proof2, proof3, date) VALUES (?, ?, ?, ?, ?, ?, ?);
        INSERT INTO pending_complaint (complaint_id, pending_date, status) VALUES (LAST_INSERT_ID(), ?, ?);');
    
        if(!$stmt->execute(array($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate, $complaintDate, $status))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }






    
    // protected function setComplaint($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate) {
    //     $stmt = $this->connect()->prepare('INSERT INTO complaint (user_id, complainee_id, complaint_description, proof1, proof2, proof3, date) VALUES (?, ?, ?, ?, ?, ?, ?)');
    
    //     if(!$stmt->execute(array($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate))){
    //         $stmt = null;
    //         header("location: ../pending-complaints.php?error=stmtfailed");
    //         exit();
    //     }

    //     $stmt = null;

    //     $this->setPendingComplaint($complaintDate);
    // }

    // private function setPendingComplaint($complaintDate) {
    //     $status = "pending"; //default status
    //     $stmt = $this->connect()->prepare('INSERT INTO pending_complaint (complaint_id, pending_date, status) VALUES (LAST_INSERT_ID(), ?, ?)');
    
    //     if(!$stmt->execute(array($complaintDate, $status))){
    //         $stmt = null;
    //         header("location: ../pending-complaints.php?error=stmtfailed");
    //         exit();
    //     }

    //     $stmt = null;
    // }








    // protected function setComplaint($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate) {
    //     $stmt = $this->connect()->prepare('INSERT INTO complaint (user_id, complainee_id, complaint_description, proof1, proof2, proof3, date) VALUES (?, ?, ?, ?, ?, ?, ?)');
    
    //     $stmt->execute(array($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate));

    //     $complaintId = $this->connect()->lastInsertId();

    //     $type = var_dump($complaintId);

    //     header("location: ../pending-complaints.php?$type");

    //     $this->setPendingComplaint($complaintId, $complaintDate);

    //     $stmt = null;

        
    // }

    // private function setPendingComplaint($complaintId, $complaintDate) {
    //     $status = "pending"; //default status
    //     $stmt = $this->connect()->prepare('INSERT INTO pending_complaint (complaint_id, pending_date, status) VALUES (?, ?, ?)');
    
    //     if(!$stmt->execute(array($complaintId, $complaintDate, $status))){
    //         $stmt = null;
    //         header("location: ../pending-complaints.php?error=stmtfailed");
    //         exit();
    //     }

    //     $stmt = null;
    // }
}