<?php

class SubmittedApplicationInfoController extends SubmittedApplicationInfo {

    //edit

    public function editApplicationStatus($applicationId, $status) {
        $this->updateApplicationStatus($applicationId, $status);
    }
}