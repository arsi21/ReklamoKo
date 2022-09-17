<?php

class ComplaintController extends Complaint {
    private $complainantId;
    private $complaineeId;
    private $complaintDescription;
    private $proof1;
    private $proof2;
    private $proof3;
    private $complaintDate;

    public function __construct($complainantId, $complaineeId, $complaintDescription, $proof1, $proof2, $proof3, $complaintDate) {
        $this->complainantId = $complainantId;
        $this->complaineeId = $complaineeId;
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

        $this->setComplaint($this->complainantId, $this->complaineeId, $this->complaintDescription, $this->proof1, $this->proof2, $this->proof3, $this->complaintDate);
    }

    private function emptyInput() {
        $result;
        if(empty($this->complainantId) || empty($this->complaineeId)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}