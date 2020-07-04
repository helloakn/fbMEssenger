<?php
//echo $_REQUEST['fb_verify_token'];//'84570639';
//echo 'abcdefgVerifi@##token12!@#$D';
//#echo $_REQUEST['hub_verify_token'];
$hubVerifyToken = 'thisistokenalal';
$accessToken = 'EAAeznZADzvjQBAPjbNZBGQ0psPpl22miMJzD2EIZBvTHERaeATvBrCBmK6fHoDpsTxoKw4B9az0mZAtPyhBCjAH2xsK9aZAAB79YLMBX2Abb5VozuSQOyY4ZAUPQfZAaK99ZAuBXpr49XxKr37OtlCLsZA33AeiA2yU0O4jW7p4onlQZDZD';
if($_REQUEST['hub_verify_token'] === $hubVerifyToken){
echo $_REQUEST['hub_challenge'];
exit;
}

// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$response = null;
//set Message
if($messageText == "hi") {
    $answer = "Hello";
}
//send message to facebook bot
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);