<?php 

class Complaint extends Dbh {

    protected function setComplaint($userId, $complainantIds, $complaineeIds, $complaintTypeId, $complaintDescription, $proof1NameNew, $proof2NameNew, $proof3NameNew, $complaintDate) {  
        
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

        $stmt = $conn->prepare('INSERT 
        INTO complaint 
            (user_id,
            complaint_type_id, 
            complaint_description) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($userId, $complaintTypeId, $complaintDescription))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        $complaintId = $conn->lastInsertId();

        //add proofs
        foreach($proofs as $proof){
            $stmt = $conn->prepare('INSERT 
            INTO proof 
                (complaint_id, 
                image) 
            VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $proof))){
                $stmt = null;
                header("location: ../pending-complaints.php?message=stmtfailed");
                exit();
            }
        }

        //add complainee
        foreach($complainantIds as $complainantId){
            $stmt = $conn->prepare('INSERT 
            INTO complaint_complainant 
                (complaint_id, 
                complainant_id) 
            VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $complainantId))){
                $stmt = null;
                header("location: ../pending-complaints.php?message=stmtfailed");
                exit();
            }
        }

        //add complainee
        foreach($complaineeIds as $complaineeId){
            $stmt = $conn->prepare('INSERT 
            INTO complaint_complainee 
                (complaint_id, 
                complainee_id) 
            VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $complaineeId))){
                $stmt = null;
                header("location: ../pending-complaints.php?message=stmtfailed");
                exit();
            }
        }

        $this->setPendingComplaint($complaintId, $complaintDate);

        $stmt = null;
    }

    private function setPendingComplaint($complaintId, $complaintDate) {
        $status = "pending"; //default status
        $stmt = $this->connect()->prepare('INSERT 
        INTO pending_complaint 
            (complaint_id, 
            pending_date, 
            status) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $complaintDate, $status))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}