<?php

class LogController extends Log {

    public function addLog($userId, $actionMade) {
        $this->setLog($userId, $actionMade);
    }
}