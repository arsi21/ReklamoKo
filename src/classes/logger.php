<?php 

class Logger {

    private
        $file,
        $timestamp;

    public function __construct($filename) {
        $this->file = "C:/videos/".$filename;
    }

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


// $log = new Logger("log.txt");
// $log->setTimestamp("D M d 'y h.i A");

// $log->putLog("Successful Login");
