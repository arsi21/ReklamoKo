<?php 

class Logger {

    private $file = "C:/users/rouen/videos/z.txt";
    private $timestamp;

    public function setTimestamp($format) {
        date_default_timezone_set("Asia/Manila");
        $this->timestamp = date($format);
    }

    public function putLog($insert) {
        if (isset($this->timestamp)) {
            file_put_contents($this->file, $this->timestamp." >> ".$insert."\n", FILE_APPEND);
        } else {
            trigger_error("Timestamp not set", E_USER_ERROR);
        }
    }
}