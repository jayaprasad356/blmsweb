<?php 
include_once('crud.php');

class Firebase {
    protected $db;
        function __construct(){
            $this->db = new Database();
            $this->db->connect();
            date_default_timezone_set('Asia/Kolkata');
            }

    public function send($registration_ids, $message) {
        // echo 'registration id :'.$registration_ids;
        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
    
    /*
    * This function will make the actuall curl request to firebase server
    * and then the message is sent 
    */
    private function sendPushNotification($fields) {
        
        // firebase server url to send the curl request
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        // $sql="SELECT value FROM settings WHERE variable='fcm_server_key'";
        // $this->db->sql($sql);
        // $res = $this->db->getResult();
        define("FIREBASE_API_KEY","AAAAK4JlzoU:APA91bGMw4BZh3PA_4lWueWgF8Rf5PQVwhVIDg5qOvcdl9oUwe7D1-Oa_wg--sLYJYsnAm1E5Zeagt6nIeF2G5S97hwdZLyHJdekZuN4uKg3HcUFaovJy_91J4CTnijn9SQ75iSv2MQh");
        
        //building headers for the request
        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        //Initializing curl to open a connection
        $ch = curl_init();
 
        //Setting the curl url
        curl_setopt($ch, CURLOPT_URL, $url);
        
        //setting the method as post
        curl_setopt($ch, CURLOPT_POST, true);

        //adding headers 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        //disabling ssl support
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        //adding the fields in json format 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //finally executing the curl request 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        //Now close the connection
        curl_close($ch);
        // print_r($result);
 
        //and return the result 
        return $result;
    }
}