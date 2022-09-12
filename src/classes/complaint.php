<?php 

class Complaint extends Dbh {

    protected function setComplaint($userId, $complaineeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate) {
        $status = "pending"; //default status of complaint
        
        //get all proofs
        $proofs = array();
        if(!empty($proof1NameNew)){
            array_push($proofs, $proof1NameNew);
        }

        if(!empty($proof2NameNew)){
            array_push($proofs, $proof2NameNew);
        }

        if(!empty($proof3NameNew)){
            array_push($proofs, $proof3NameNew);
        }

        $conn = $this->connect();

        $stmt = $conn->prepare('INSERT INTO complaint (user_id, complainee_id, complaint_description, date, status) VALUES (?, ?, ?, ?, ?)');
    
        if(!$stmt->execute(array($userId, $complaineeId, $complaintDescription, $complaintDate, $status))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $complaintId = $conn->lastInsertId();

        //add proofs
        foreach($proofs as $proof){
            $stmt = $conn->prepare('INSERT INTO proof (complaint_id, image) VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $proof))){
                $stmt = null;
                header("location: ../pending-complaints.php?error=stmtfailed");
                exit();
            }
        }

        $this->setPendingComplaint($complaintId, $complaintDate);

        $stmt = null;
    }

    private function setPendingComplaint($complaintId, $complaintDate) {
        $status = "pending"; //default status
        $stmt = $this->connect()->prepare('INSERT INTO pending_complaint (complaint_id, pending_date, status) VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $complaintDate, $status))){
            $stmt = null;
            header("location: ../pending-complaints.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}