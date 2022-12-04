<?php 

class PendingComplaintInfo extends Dbh {

    //set

    protected function setOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate) {
        $stmt = $this->connect()->prepare('INSERT 
        INTO ongoing_complaint 
            (complaint_id, 
            lupon_id, 
            ongoing_date) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $luponId, $ongoingDate))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;

        $status = "approved";

        $this->updatePendingComplaintStatus($complaintId, $status);
        $this->setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime);
    }

    protected function setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime) {
        $stmt = $this->connect()->prepare('INSERT 
        INTO meeting_schedule 
            (complaint_id, date, time) 
        VALUES (?, ?, ?)');
    
        if(!$stmt->execute(array($complaintId, $scheduleDate, $scheduleTime))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function setComment($complaintId, $message) {
        $stmt = $this->connect()->prepare('SELECT
        COUNT(id)
        AS count
        FROM comment
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }
        
        $result = $stmt->fetch();

        if($result['count'] == 0){
            $stmt = $this->connect()->prepare('INSERT 
            INTO comment
                (complaint_id, 
                message) 
            VALUES (?, ?)');
        
            if(!$stmt->execute(array($complaintId, $message))){
                $stmt = null;
                header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
                exit();
            }
        }else{
            $stmt = $this->connect()->prepare('UPDATE 
            comment
            SET message = ? 
            WHERE complaint_id = ?');
        
            if(!$stmt->execute(array($message, $complaintId))){
                $stmt = null;
                header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
                exit();
            }
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
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function updateComplainant($complaintId, $complainantIds) {
        $stmt = $this->connect()->prepare('DELETE 
        FROM complaint_complainant
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        //add complainee
        foreach($complainantIds as $complainantId){
            $stmt = $this->connect()->prepare('INSERT 
            INTO complaint_complainant 
                (complaint_id, 
                complainant_id) 
            VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $complainantId))){
                $stmt = null;
                header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
                exit();
            }
        }

        $stmt = null;
    }

    protected function updateComplainee($complaintId, $complaineeIds) {
        $stmt = $this->connect()->prepare('DELETE 
        FROM complaint_complainee
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        //add complainee
        foreach($complaineeIds as $complaineeId){
            $stmt = $this->connect()->prepare('INSERT 
            INTO complaint_complainee 
                (complaint_id, 
                complainee_id) 
            VALUES (?, ?)');

            if(!$stmt->execute(array($complaintId, $complaineeId))){
                $stmt = null;
                header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
                exit();
            }
        }

        $stmt = null;
    }


    protected function updateComplaintType($complaintId, $complaintTypeId) {
        $stmt = $this->connect()->prepare('UPDATE complaint
        SET complaint_type_id = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($complaintTypeId, $complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function updateComplaintDesc($complaintId, $complaintDesc) {
        $stmt = $this->connect()->prepare('UPDATE complaint
        SET complaint_description = ?
        WHERE id = ?');
    
        if(!$stmt->execute(array($complaintDesc, $complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    protected function updateComplaintProof($complaintId, $proof1NameNew, $proof2NameNew, $proof3NameNew) {  
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

        //delete old proof
        $stmt = $this->connect()->prepare('DELETE 
        FROM proof
        WHERE complaint_id = ?');

        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        //add new proof
        foreach($proofs as $proof){
            $stmt = $this->connect()->prepare('INSERT 
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

        $stmt = null;
    }








    //delete

    protected function deleteComplaint($complaintId) {
        $stmt = $this->connect()->prepare('UPDATE pending_complaint
        SET is_archive = 1
        WHERE complaint_id = ?');
    
        if(!$stmt->execute(array($complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        // $stmt = $this->connect()->prepare('DELETE 
        // FROM proof
        // WHERE complaint_id = ?');
    
        // if(!$stmt->execute(array($complaintId))){
        //     $stmt = null;
        //     header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
        //     exit();
        // }

        // $stmt = $this->connect()->prepare('DELETE 
        // FROM complaint
        // WHERE id = ?');
    
        // if(!$stmt->execute(array($complaintId))){
        //     $stmt = null;
        //     header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
        //     exit();
        // }

        $stmt = null;
    }







    //get


    public function getUserPendingComplaint($complaintId, $userId) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
            (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ")
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = ?
            GROUP BY cct.complaint_id) AS complainant,
            (SELECT COUNT(r.id)
            FROM complaint_complainant cct
            INNER JOIN resident r
            ON r.id = cct.complainant_id
            WHERE cct.complaint_id = ?
            GROUP BY cct.complaint_id) AS complainant_count,
            (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ") 
            FROM complaint_complainee cc
            INNER JOIN resident r
            ON r.id = cc.complainee_id
            WHERE cc.complaint_id = ?
            GROUP BY cc.complaint_id) AS complainee,
            (SELECT COUNT(r.id)
            FROM complaint_complainee cc
            INNER JOIN resident r
            ON r.id = cc.complainee_id
            WHERE cc.complaint_id = ?
            GROUP BY cc.complaint_id) AS complainee_count,
        ct.type,
        c.complaint_description,
        pc.pending_date,
        pc.status,
        cm.message,
        u.profile
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE c.id = ?
        AND pc.status != "approved"
        AND c.user_id = ?
        AND pc.is_archive != 1
        GROUP BY cct.complaint_id
        ORDER BY pc.complaint_id DESC');

        if(!$stmt->execute(array($complaintId, $complaintId, $complaintId, $complaintId, $complaintId, $userId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetch();

        $stmt = null;

        return $results;
    }

    public function getPendingComplaint($id) {
        $stmt = $this->connect()->prepare('SELECT c.id,
        r.first_name complainant_first_name,
        r.last_name complainant_last_name,
            (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant,
            (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ")
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant_number,
            (SELECT COUNT(r.id)
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?
                GROUP BY cct.complaint_id) AS complainant_count,
            (SELECT GROUP_CONCAT(r.first_name, " ", r.last_name SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee,
            (SELECT GROUP_CONCAT(r.mobile_number SEPARATOR ", ") 
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee_number,
            (SELECT COUNT(r.id)
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?
                GROUP BY cc.complaint_id) AS complainee_count,
        ct.type,
        c.complaint_description,
        pc.pending_date,
        pc.status,
        cm.message,
        u.profile
        FROM pending_complaint pc
        INNER JOIN complaint c
        ON c.id = pc.complaint_id 
        INNER JOIN complaint_type ct
        ON c.complaint_type_id = ct.id
        LEFT JOIN comment cm
        ON cm.complaint_id = c.id 
        INNER JOIN application a
        ON a.user_id = c.user_id
        INNER JOIN user u
        ON u.id = a.user_id
        INNER JOIN complaint_complainant cct
        ON cct.complaint_id = c.id
        INNER JOIN resident r
        ON r.id = cct.complainant_id
        WHERE c.id = ?
        AND pc.status != "approved"
        AND pc.is_archive != 1
        GROUP BY cct.complaint_id
        ORDER BY pc.complaint_id DESC');

        if(!$stmt->execute(array($id, $id, $id, $id, $id, $id, $id))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$id&message=stmtfailed");
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
            header("location: ../pending-complaint.php?id=$id&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }


    public function getLupons($complaintId) {
        $stmt = $this->connect()->prepare('SELECT l.id,
        r.first_name,
        r.last_name
        FROM lupon l
        INNER JOIN resident r
        ON l.resident_id = r.id
        WHERE l.is_archive != 1
        AND l.resident_id
        NOT IN (SELECT r.id
                FROM complaint_complainant cct
                INNER JOIN resident r
                ON r.id = cct.complainant_id
                WHERE cct.complaint_id = ?)
        AND l.resident_id
        NOT IN (SELECT r.id
                FROM complaint_complainee cc
                INNER JOIN resident r
                ON r.id = cc.complainee_id
                WHERE cc.complaint_id = ?)');

        if(!$stmt->execute(array($complaintId, $complaintId))){
            $stmt = null;
            header("location: ../pending-complaint.php?id=$complaintId&message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }



    public function getResidents($residentId) {
        $stmt = $this->connect()->prepare('SELECT * 
        FROM resident
        WHERE id != ?');

        if(!$stmt->execute(array($residentId))){
            $stmt = null;
            header("location: ../pending-complaints.php?message=stmtfailed");
            exit();
        }

        $results = $stmt->fetchAll();

        $stmt = null;

        return $results;
    }
}