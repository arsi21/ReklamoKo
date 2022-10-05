<?php

class LuponInfoController extends LuponInfo {

    //remove

    public function removeLupon($luponId) {
        $this->deleteLupon($luponId);
    }
}