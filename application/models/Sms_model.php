<?php

include APPPATH . 'third_party/phpMailer/class.phpmailer.php';
include APPPATH . 'third_party/phpMailer/class.smtp.php';

class Sms_model extends CI_Model {

    function sendsms($mobile, $messages, $medical_id = 0) {
        $authKey = "78106A1u8VLmCC054cb666b";
        $mobileNumber = $mobile;
        $senderId = "PMTLNT";
        $message = $messages;
        $finalmessage = rawurlencode($message);
        $smsUser = 'manish';
        $smsPassword = '123456';
//Define route 
        $route = "4";
//Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $finalmessage,
            'sender' => $senderId,
            'route' => $route
        );
//API URL
        $url = "https://control.msg91.com/sendhttp.php";
// init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
//,CURLOPT_FOLLOWLOCATION => true
        ));
//Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//get response
        $output = curl_exec($ch);
//Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
//echo $output;
        $this->countSMS($messages, $mobile, $medical_id);
        return $output;
    }

    function countSMS($message, $mobile, $medical_id = 0) {
        $finalMessage = $message;
        $msg_count = 0;
        if (strlen($finalMessage) > 0 && strlen($finalMessage) < 161) {
            $msg_count = 1;
        } elseif (strlen($finalMessage) > 161 && strlen($finalMessage) < 307) {
            $msg_count = 2;
        } elseif (strlen($finalMessage) > 307) {
            $msg_count = 3;
        } else {
            echo 'msg not sent';
        }
        $mobileNoCount = count(explode(",", $mobile));

        $field_array = array('created' => date("Y-m-d H:i:s", time()), 'mobile' => $mobile, 'message' => $message, 'count' => ($msg_count * $mobileNoCount));
        $this->db->insert('sms', $field_array);
//    $smsCount->create();
    }

    function sendMail($email, $message) {
        // echo $email . '<br/>';


        $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

        $mail->IsSMTP(); // telling the class to use SMTP

        try {
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the server
            $mail->Host = "smtpout.asia.secureserver.net";      // sets the SMTP server
            $mail->Port = 465;                   // set the SMTP port for the MAIL server
            $mail->Username = "zypedia@instacom.in";  //  username
            $mail->Password = "zypedia";            // password

            $mail->FromName = "PharmaTalent";
            $mail->From = "admin@pharmatalent.in";
            $mail->AddAddress($email, "PharmaTalent");
            //$mail->AddAddress('akshay@techvertica.com', "BI-Tracking");
            $mail->Subject = "Login Credentials";

            $mail->IsHTML(true);

            $mail->Body = <<<EMAILBODY

{$message}
EMAILBODY;

            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }

}
