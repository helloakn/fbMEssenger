<?php
error_reporting(E_ALL); 
$myfile = "/tmp/log.txt";
//print_r($_POST);exit();
//$txt = $_POST;

$tmp = file_get_contents($myfile);
foreach ($_POST as $k => $v) {
  $tmp .= $tmp . " $k => $v , \n";
}

file_put_contents($myfile, $tmp);

include 'FbBot.php';
$tokken = $_REQUEST['hub_verify_token'];
$hubVerifyToken = 'fb_token';
$challange = $_REQUEST['hub_challenge'];
$accessToken = 'EAADFXrKyZAXkBAImzFLZBo5ZB6ZBQ86KrUdDWGkMaLJJGsTzQCj7a5cs7tO1ZCZBxGpqf2hd1BPnIo55L1eFTN7aPVqZAJu2HD0URS4ulSAZAP1zIgaZAnKFirnG9h5zcFwqBSR5onSo1LMofJD4lDnOgVQOuzfhf59wxLAIuX8BL9QZDZD';
$bot = new FbBot();
$bot->setHubVerifyToken($hubVerifyToken);
$bot->setaccessToken($accessToken);
echo $bot->verifyTokken($tokken,$challange);
$input = json_decode(file_get_contents('php://input'), true);
$test = file_get_contents('php://input');
file_put_contents($myfile, $test);
$message = $bot->readMessage($input);
$textmessage = $bot->sendMessage($message);