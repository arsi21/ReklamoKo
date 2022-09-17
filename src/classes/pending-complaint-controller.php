<?php

class PendingComplaintController extends PendingComplaint {

    //add

    public function addOngoingComplaint($complaintId, $luponId, $scheduleDate, $scheduleTime, $ongoingDate) {
        if(!$this->emptyInput($complaintId, $luponId, $scheduleDate, $scheduleTime)){
            header("location: ../pending-complaint.php?id=$complaintId&error=emptyInput");
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
            header("location: ../pending-complaint.php?id=$complaintId&error=emptyInput");
            exit();
        }

        $this->updatePendingComplaintMessage($complaintId, $message);
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