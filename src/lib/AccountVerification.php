<?php
/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 11/1/18
 * Time: 10:29 PM
 */

require_once(__DIR__.'/../config/config.php');



class AccountVerification {

    private $userID;
    private $verificationType;

    public function __construct($id)
    {
        $this->userID = $id;
        $this->verificationType = "email";
    }

    public function sendVerification()
    {
        if ($this->verification != "email"){

        }


    }

    public function sendVerification_TEST()
    {
        $to = "stephenfritchie@gmail.com";
        $subject = "[TEST] Verify your email address";
        $message = "http://$_SERVER[HTTP_HOST]";

        mail($to, $subject, "http://$_SERVER[HTTP_HOST]");
    }

    public function getUserID(){
        return $this->userID;
    }

    public function setUserID($id)
    {
        $this->userID = $id;
    }



}

$actual_link = "http://$_SERVER[HTTP_HOST]";
echo $actual_link;


$verification = new AccountVerification(1234);
echo "  Sending email - ";
$verification->sendVerification_TEST();
echo "sent";


?>