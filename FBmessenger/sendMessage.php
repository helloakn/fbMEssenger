<?php
$accessToken = 'EAAeznZADzvjQBAPjbNZBGQ0psPpl22miMJzD2EIZBvTHERaeATvBrCBmK6fHoDpsTxoKw4B9az0mZAtPyhBCjAH2xsK9aZAAB79YLMBX2Abb5VozuSQOyY4ZAUPQfZAaK99ZAuBXpr49XxKr37OtlCLsZA33AeiA2yU0O4jW7p4onlQZDZD';

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
$senderId = '1761548720559381';
$response = "";
$json = false;
if($argv[1] =="ma aye thaung"){
    
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
else if($argv[1] =="template"){
    
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
else if($argv[1] =="ask"){
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
                "text":"is she cute?",
                "buttons":[
                  {
                    "type":"postback",
                    "title":"Yes",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_YES"
                  },
                  {
                    "type":"postback",
                    "title":"No",
                    "payload":"DEVELOPER_DEFINED_PAYLOAD_NO"
                  }
                ]
              }
            }
          }
      }';
    
}
else if($argv[1] =="share"){
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
else{
    $answer = $argv[1];
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

echo json_encode($response);
/*
echo "\n\n".$url."\n\n";

echo "\n\n".json_encode($response)."\n\n";

echo "\n\n".$result."\n\n";
*/
echo "\n\n".$result."\n\n";
echo "\nsuccess\n\n";