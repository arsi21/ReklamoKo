<?php

class AdminAccountController extends AdminAccount {

    //edit

    public function editAccessType($residentId) {
        $this->updateAccessType($residentId);
    }
}