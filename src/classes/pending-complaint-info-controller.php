<?php

class PendingComplaintInfoController extends PendingComplaintInfo {

    //add

    public function addOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate) {
        if(!$this->emptyInput($complaintId, $luponId, $scheduleDate, $scheduleTime)){
            header("location: ../pending-complaint-info.php?id=$complaintId&message=emptyInput");
            exit();
        }

        $this->setOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate);
    }






    
    //edit

    public function editPendingComplaintStatus($complaintId, $status) {
        $this->updatePendingComplaintStatus($complaintId, $status);
    }

    public function editPendingComplaintMessage($complaintId, $message) {
        if(!$this->emptyInputMessage($message)){
            header("location: ../pending-complaint-info.php?id=$complaintId&message=emptyInput");
            exit();
        }

        $this->updatePendingComplaintMessage($complaintId, $message);
    }

    public function editComplainee($complaintId, $complaineeId) {
        $this->updateComplainee($complaintId, $complaineeId);
    }

    public function editComplaintType($complaintId, $complaintTypeId) {
        $this->updateComplaintType($complaintId, $complaintTypeId);
    }

    public function editComplaintDesc($complaintId, $complaintDesc) {
        $this->updateComplaintDesc($complaintId, $complaintDesc);
    }

    public function editComplaintProof($complaintId, $proof1NameNew, $proof2NameNew, $proof3NameNew) {
        $this->updateComplaintProof($complaintId, $proof1NameNew, $proof2NameNew, $proof3NameNew);
    }





    //delete

    public function removeComplaint($complaintId) {
        $this->deleteComplaint($complaintId);
    }









    private function emptyInput($complaintId, $luponId, $scheduleDate, $scheduleTime) {
        $result;
        if(empty($complaintId) || empty($luponId) || empty($scheduleDate) || empty($scheduleTime)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }

    private function emptyInputMessage($message) {
        $result;
        if(empty($message)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}