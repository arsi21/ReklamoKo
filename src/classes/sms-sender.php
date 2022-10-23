<?php 
require 'phpdotenv-vendor/autoload.php';
//for environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '../vendor/autoload.php';

use Twilio\Rest\Client;

class SmsSender {

    public function sendSms($to, $content){
        $FROM = $_ENV['SENDER'];;
    
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid = $_ENV['SID'];
        $token = $_ENV['TOKEN'];
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