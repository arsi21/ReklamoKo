<?php

class OngoingComplaintInfoController extends OngoingComplaintInfo {

    //add

    public function addMeetingSchedule($complaintId, $scheduleDate, $scheduleTime) {
        if(!$this->emptyInput($complaintId, $scheduleDate, $scheduleTime)){
            header("location: ../ongoing-complaint-info.php?id=$complaintId&error=emptyInput");
            exit();
        }

        $this->setMeetingSchedule($complaintId, $scheduleDate, $scheduleTime);
    }

    public function addSolvedComplaint($complaintId, $sovedDate) {
        $this->setSolvedComplaint($complaintId, $sovedDate);
    }

    public function addTransferredComplaint($complaintId, $transferredDate) {
        $this->setTransferredComplaint($complaintId, $transferredDate);
    }






    private function emptyInput($complaintId, $scheduleDate, $scheduleTime) {
        $result;
        if(empty($complaintId) || empty($scheduleDate) || empty($scheduleTime)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}