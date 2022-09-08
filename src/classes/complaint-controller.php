<?php

class ComplaintController extends Complaint {
    private $userId;
    private $complainee;
    private $complaintDescription;
    private $proof1;
    private $proof2;
    private $proof3;
    private $complaintDate;

    public function __construct($userId, $complainee, $complaintDescription, $proof1, $proof2, $proof3, $complaintDate) {
        $this->userId = $userId;
        $this->complainee = $complainee;
        $this->complaintDescription = $complaintDescription;
        $this->proof1 = $proof1;
        $this->proof2 = $proof2;
        $this->proof3 = $proof3;
        $this->complaintDate = $complaintDate;
    }

    public function addComplaint() {
        if(!$this->emptyInput()){
            header("location: ../pending-complaints.php?error=emptyInput");
            exit();
        }

        $this->setComplaint($this->userId, $this->complainee, $this->complaintDescription, $this->proof1, $this->proof2, $this->proof3, $this->complaintDate);
    }

    private function emptyInput() {
        $result;
        if(empty($this->userId) || empty($this->complainee)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}