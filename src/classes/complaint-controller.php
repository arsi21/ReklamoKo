<?php

class ComplaintController extends Complaint {
    private $complaintPerson;
    private $complaintDescription;
    private $proof1;
    private $proof2;
    private $proof3;

    public function __construct($complaintPerson, $complaintDescription, $proof1, $proof2, $proof3) {
        $this->complaintPerson = $complaintPerson;
        $this->complaintDescription = $complaintDescription;
        $this->proof1 = $proof1;
        $this->proof2 = $proof2;
        $this->proof3 = $proof3;
    }

    public function addComplaint() {
        if(!$this->emptyInput()){
            header("location: ../pending-complaints.php?error=emptyInput");
            exit();
        }

        $this->setComplaint($this->complaintPerson, $this->complaintDescription, $this->proof1, $this->proof2, $this->proof3);
    }

    private function emptyInput() {
        $result;
        if(empty($this->complaintPerson) || empty($this->complaintDescription)){
            $result = false;
        }else {
            $result = true;
        }

        return $result;
    }
}