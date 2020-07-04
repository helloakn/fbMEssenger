<?php

error_reporting(E_ALL); 
$myfile = fopen("/tmp/log.txt", "w");
//print_r($_POST);exit();
//$txt = $_POST;



$fb = json_decode(file_get_contents("php://input")); //data of an incoming request
fwrite($myfile, $fb);
fclose($myfile);
if (isset($fb->entry[0]->messaging[0]->sender->id)) {
   $id = $fb->entry[0]->messaging[0]->sender->id;	//a field with user's ID
} else {
   exit();
}
if (isset($fb->entry[0]->messaging[0]->message->text)) {
$message = $fb->entry[0]->messaging[0]->message->text;  //a field with the text of the message
}
if (isset($fb->entry[0]->messaging[0]->postback->payload)) {
$payload = $fb->entry[0]->messaging[0]->postback->payload; //a field with the text on the button
}
if (isset($fb->entry[0]->messaging[0]->message->quick_reply->payload)) {
$payload_quick = $fb->entry[0]->messaging[0]->message->quick_reply->payload; 
} 								//a field with the text of the quick reply
//The function of sending a message
function send($data,$token)	//data and token are sent to the function
{
   $url = "https://graph.facebook.com/v2.7/me/messages?access_token=" . $token; 
 
   $data_string = json_encode($data);		//we convert data to JSON
 
   $ch = curl_init($url);				//we send POST request using curl
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json',
           'Content-Length: ' . strlen($data_string))
   );
 
   curl_exec($ch);
   curl_close($ch);
}
 
//choosing an answer for a user
if ($message == "Hello") { //if there is a message from a user with the text “Hello”
   $menu_keyboard = [		//an array with buttons
       [
           "content_type" => "text",
           "title" => "I'm happy!",
           "payload" => "happy"
       ],
       [
           "content_type" => "text",
           "title" => "I'm sad!",
           "payload" => "sad"
       ]
   ];
 
   $data = array(				//message data
       'recipient' => array(
           'id' => $id				//user's ID
       ),
       'message' => array(
           'text' => "Hello my dear subscriber!",	//message text
           'quick_replies' => $menu_keyboard	//adding buttons to the messages
       )
   );
 
   send($data, $token);				//sending message
 
} elseif ($payload_quick == "happy") {  //if a user presses the button which has a payload ‘happy”
   $menu_keyboard = [
       [
           "content_type" => "text",
           "title" => "To start!",
           "payload" => "start"
       ]
   ];
 
   $data = array(
       'recipient' => array(
           'id' => $id
       ),
       'message' => array(
           'text' => "I'm happy too!",
           'quick_replies' => $menu_keyboard
       )
   );
   send($data, $token);
 
} elseif ($payload_quick == "sad") { 	//if a user presses the button which has a payload ‘sad”
   $menu_keyboard = [
       [
           "content_type" => "text",
           "title" => "To start!",
           "payload" => "start"
       ]
   ];
 
   $data = array(
       'recipient' => array(
           'id' => $id
       ),
       'message' => array(
           'text' => "I'm sad too!",
           'quick_replies' => $menu_keyboard
 
       )
   );
   send($data, $token);
 
} else { 				//the rest of cases
   $menu_keyboard = [
       [
           "content_type" => "text",
           "title" => "I'm happy!",
           "payload" => "happy"
       ],
       [
           "content_type" => "text",
           "title" => "I'm sad!",
           "payload" => "sad"
       ]
   ];
 
   $data = array(
       'recipient' => array(
           'id' => $id
       ),
       'message' => array(
           'text' => "I don't understand you :(",
           'quick_replies' => $menu_keyboard
       )
   );
 
   send($data, $token);
}