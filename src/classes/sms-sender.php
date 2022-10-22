<?php 
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '../vendor/autoload.php';

use Twilio\Rest\Client;

class SmsSender {

    public function sendSms($to, $content){
        
        $FROM = "+13392178622";
    
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid = "ACac7cd00246b524b698143f018915b7ff";
        $token = "59834965722f83a3f353b82c5b2554ea";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                            ->create($to, // to
                                    [
                                        "body" => $content,
                                        "from" => $FROM
                                    ]
                            );
    }
    
}