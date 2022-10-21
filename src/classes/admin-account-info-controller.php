<?php

class AdminAccountInfoController extends AdminAccountInfo {

    //edit

    public function editAccessType($id) {
        $this->updateAccessType($id);
    }
}