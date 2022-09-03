<?php 

class Complaint extends Dbh {
    
    protected function setComplaint($userId, $complaintPersonId, $complaintDescription, $proof) {
        $status = "pending";//default value of status
        $stmt = $this->connect()->prepare('INSERT INTO tblcomplaint (user_id, complaintPersonId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
        if(!$stmt->execute(array($complaintPerson, $complaintDescription, $proof1, $proof2, $proof3))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}