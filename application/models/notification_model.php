<?php

class notification_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    function pushNotification($message, $registrationIds,$auth_id) {

// prep the bundle
        $api_key = "AIzaSyBioJOZXv_StQyhEDtnVhZk3E9loTVbF4o";
        $msg = array(
            'message' => $message,
            'title' => 'PocketDrug Notification',
            'subtitle' => 'This is a subtitle. subtitle',
            'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
            'vibrate' => 1,
            'sound' => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );

        $fields = array(
            'registration_ids' => array($registrationIds),
            'data' => $msg
        );

        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        //echo $result;
        $field_array = array(
            'notification_message' => $message,
            'auth_id' => $auth_id,
            'created' => date('Y-m-d H:i:s'),
        );
        //var_dump($result);
       return $this->db->insert('notification',$field_array);
       
    }

}
