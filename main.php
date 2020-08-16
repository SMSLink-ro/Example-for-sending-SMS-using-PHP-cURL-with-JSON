<?php 

/*

  Get your SMSLink / SMS Gateway Connection ID and Password from 
  https://www.smslink.ro/get-api-key/

*/

$RequestData = array(
        "connection_id" => "... My Connection ID ...",        // SMS Gateway Connection ID
        "password"      => "... My Connection Password ...",  // SMS Gateway Password
        "to"            => "07xyzzzzzz",                      // SMS Recipient
        "message"       => "Test SMS",                        // SMS Message
    );

$ch = curl_init();

/*

  HTTPS JSON API Endpoint:  https://secure.smslink.ro/sms/gateway/communicate/json.php
  HTTP JSON API Endpoint:   http://www.smslink.ro/sms/gateway/communicate/json.php

*/

$RequestURL = "https://secure.smslink.ro/sms/gateway/communicate/json.php";

curl_setopt($ch, CURLOPT_URL, $RequestURL);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, 
        array('Content-Type: application/json')
    );

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

if (strpos($RequestURL, "https://") !== false)
{
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
}

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($RequestData));

$ResultData = json_decode(curl_exec($ch), true);

curl_close($ch);

var_export($ResultData);

?>