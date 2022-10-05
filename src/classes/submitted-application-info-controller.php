<?php

class SubmittedApplicationInfoController extends SubmittedApplicationInfo {

    //edit

    public function editApplicationStatus($applicationId, $status) {
        $this->updateApplicationStatus($applicationId, $status);
    }

    public function editUserAccessType($userId, $accessType) {
        $this->updateUserAccessType($userId, $accessType);
    }






    //remove
    public function removeApplication($applicationId) {
        $this->deleteApplication($applicationId);
    }

}