<?php
require 'vendor/autoload.php';
use Stichoza\GoogleTranslate\TranslateClient;

$hubVerifyToken = 'sha1=18301444bc39dee953d1c162b63f56a7';
//Translate
$accessToken = 'EAAdS5QjpZB1oBAMJyhBrPw8eiC3L1Gzy7h636GWZA3BCKXJ5CgKLbDo8hVI7EUuT8ArcXKMB68zn7TyD1mZBBDpr0WdyuJw8MEGKTlBx2ZCi0AkYk3L5KBw3VGaP1tkJ9L2HAhreupQFJ4ZANs7V4RCTguA3aXhLWf360tQvDfgZDZD';
//aknPage
//$accessToken = 'EAAeznZADzvjQBAPjbNZBGQ0psPpl22miMJzD2EIZBvTHERaeATvBrCBmK6fHoDpsTxoKw4B9az0mZAtPyhBCjAH2xsK9aZAAB79YLMBX2Abb5VozuSQOyY4ZAUPQfZAaK99ZAuBXpr49XxKr37OtlCLsZA33AeiA2yU0O4jW7p4onlQZDZD';
//hellomyanmar
//$accessToken = 'EAAeznZADzvjQBAJIddeITZCcy1gG4Oi0UZBOyKfI6Eu0K2NMcSZAUDCEbOXNW7xmUe6JJE5ZB4dAvpy9bC89zjgR21A1mGfoLHwGZA1nAN5Germe5jbkHLALR5MmB3aBI3qdHDxpTyRpjDz5Qz1BSv8QicFcVmmYo5LFgIVjWG5wZDZD';

/*LOG*/
/*
if(isset($_REQUEST)){
    $myfile = "/tmp/tranlog.txt";
    $tmp = file_get_contents($myfile);
    foreach($_REQUEST as $k=>$v){
        $tmp = $tmp . $k . ' = ' . $v .' \n';
    }
    //$tmp = $tmp .file_get_contents('php://input')."\n\n\n";
    file_put_contents($myfile, $tmp);
}
*/
/*endLOG*/

if(isset($_REQUEST['hub_verify_token'])){
    if($_REQUEST['hub_verify_token'] === $hubVerifyToken){
        echo $_REQUEST['hub_challenge'];
        exit;
    }
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$response = null;

/*LOG*/
$myfile = "/tmp/log.txt";
$tmp = file_get_contents($myfile);
$tmp = $tmp .file_get_contents('php://input')."\n\n\n";
file_put_contents($myfile, $tmp);
/*endLOG*/

$img = array(
    "https://2.bp.blogspot.com/-yEOM0Hohlh8/Wk-v6I6UYRI/AAAAAAAAl8I/TsHCg4s-amgjiJBfbQq5sspuaJ1ikS75wCLcBGAs/s1600/ma-aye-thaung-papawady25497946_10208535951594752_3922140602525020294_n.jpg",
    "https://4.bp.blogspot.com/-h4EHHU6vriw/Wk-v6GdF-3I/AAAAAAAAl8E/uZMwybqaeZwiFGESyUKA-KzJaIO6KjRYgCLcBGAs/s1600/ma-aye-thaung-papawady25498463_10208535950554726_2262971433322538344_n.jpg",
    "https://4.bp.blogspot.com/-KBn0dUGYrNg/Wk-v6d7HU8I/AAAAAAAAl8M/0H_pp_ZWWdEQ84cuthOMhruAs08Po-NXwCLcBGAs/s1600/ma-aye-thaung-papawady25507840_10208528751214747_1078134075320666489_n.jpg",
    "https://1.bp.blogspot.com/-edwNg9NOHZU/Wk-v7GrGx2I/AAAAAAAAl8Q/4bYyQ7khoYkTVOBXO7jQTgldKATFx3k7gCLcBGAs/s1600/ma-aye-thaung-papawady25507966_10208542038426919_4270755674086964542_n.jpg",
    "https://1.bp.blogspot.com/-DwFUNCWzQ6g/Wk-v7h1SmlI/AAAAAAAAl8U/_jg_vTet16kSYPGvYUowmuXLAIyDFmG8wCLcBGAs/s1600/ma-aye-thaung-papawady25550339_10208547044512068_5064718224624708726_n.jpg",
    "https://3.bp.blogspot.com/-HBdUVBQFZYU/Wk-v7_QcJdI/AAAAAAAAl8c/rC5K6nKUQUMFlOZhGyuII91nsrGYGfTEQCLcBGAs/s1600/ma-aye-thaung-papawady25591925_10208547564205060_5422880845706976171_n.jpg",
    "https://1.bp.blogspot.com/-_X48eQ4glac/Wk-v8qX4cVI/AAAAAAAAl8k/IOe2XbMYRbw0bCXx1bEtgfzF9Ih8vVb-gCLcBGAs/s1600/ma-aye-thaung-papawady25591928_10208535951554751_7647785216395793340_n.jpg",
    "https://4.bp.blogspot.com/-FlhM1DNZpnk/Wk-v8ejNfaI/AAAAAAAAl8g/MnZklDE3br4r2zT9ZyTAK_cR18J5vg6MwCLcBGAs/s1600/ma-aye-thaung-papawady25659947_10208560901658488_2381738198555253540_n.jpg",
);
$index = rand(0,count($img) -1);
$img_url = $img[$index];
//$senderId = '1761548720559381';
$response = "";
$json = false;

$message = $messageText;
if($message =="ma aye thaung"){
    
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'attachment' => [
                    'type' => 'image',
                    'payload' => [
                            'is_reusable' => true,
                            'url' => $img_url,
                    ]
            ] 
        ]
    ];
    
}
else if($message =="template"){
    
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 
            "attachment"=>[
                "type"=>"template",
                "payload"=>[
                  "template_type"=>"button",
                  "text"=>"What do you want to do next?",
                  "buttons"=>[
                            
                            [
                                "type"=>"web_url",
                                "url"=>"https://www.messenger.com",
                                "title"=>"this one?"
                                ]
                        ]
                    ]
                ]
            ] 
        ];
    
}
else if($message =="Translate to" || $message =="translate to" || $message =="translateto" || $message =="Translateto"){
    $json = true;
    $response = '{
    "recipient":{
        "id":"'.$senderId.'"
    },
    "message":{
        "attachment":{
            "type":"template",
            "payload":{
            "template_type":"button",
            "text":"Translate to?",
            "buttons":[
                {
                    "type":"postback",
                    "title":"English",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_Translater:en"
                },
                {
                    "type":"postback",
                    "title":"Japan",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_Translater:ja"
                },
                {
                    "type":"postback",
                    "title":"Myanmar",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_Translater:mm"
                },
            ]
            }
        }
        }
    }';
    
}
else if($message =="share"){
    $json = true;
    $response = '{
        "recipient":{
          "id":"'.$senderId.'"
        },
        "message":{
          "attachment":{
            "type":"template",
            "payload":{
              "template_type":"generic",
              "elements":[
                {
                  "title":"Breaking News: ma aye thaung is cute",
                  "subtitle":"she is singer, model, and my love, a lal",
                  "image_url":"https://1.bp.blogspot.com/-uRrgWVb2pqc/WK1oFM8KEMI/AAAAAAAAhuA/quv5GV9XdLsAxp4ZMKXTsD29mju_sFQDwCLcB/s1600/batch_16807534_10206581459373668_4436521742122094656_n.jpg",
                  "buttons": [
                    {
                      "type": "element_share",
                      "share_contents": { 
                        "attachment": {
                          "type": "template",
                          "payload": {
                            "template_type": "generic",
                            "elements": [
                              {
                                "title": "is she cute?",
                                "subtitle": "she is singer, and she is loving me.",
                                "image_url": "http://graph.facebook.com/1787146984/picture?type=square",
                                "default_action": {
                                  "type": "web_url",
                                  "url": "http://m.me/petershats?ref=100011333352048"
                                },
                                "buttons": [
                                  {
                                    "type": "web_url",
                                    "url": "https://www.facebook.com/ayewutyi.thaung.1", 
                                    "title": "Take a check"
                                  }
                                ]
                              }
                            ]
                          }
                        }
                      }
                    }
                  ]
                }
              ]
            }
          }
        }
      }';
    
}
else if($message=='help'){
    $answer = "set destination Language
    example: 
    setDL=en
    or
    setDL=ja
    -------
    Translate text
    example:
    tran: how are you.
    -------
    Default language is English🇬🇧 to Japan🇯🇵
    ";
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
    ];
}
else if($message=='hi'){
    $answer = "Hello, This page is to translate text, 
Example: 👉
English🇬🇧 to Japan🇯🇵,
Japan🇯🇵 to English🇬🇧, 
Italy to English🇬🇧, 
English🇬🇧 to Italy🇮🇹";
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
    ];
}
else if($message=='tran:"how are you?"'){
    $answer = "お元気ですか？ ";
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
    ];
}
else if($message=='tran:"how are you"'){
    $answer = "お元気ですか？ ";
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
    ];
}
else{
    $message =  TranslateClient::translate('en', 'ja', $message);
    $answer = $message;
    $response = [
        'recipient' => [ 'id' => $senderId ],
        'message' => [ 'text' => $answer ]
    ];
}





$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
if($json == true){
    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
}
else{
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
}

curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$result = curl_exec($ch);
curl_close($ch);