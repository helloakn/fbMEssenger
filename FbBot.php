<?php
require 'vendor/autoload.php';

useGuzzleHttpClient;
useGuzzleHttpExceptionRequestException;
useGuzzleHttpPsr7Request;
class FbBot
{
    private $hubVerifyToken = null;
    private $accessToken = null;
    private $tokken = false;
    protected $client = null;
    function __construct()
    {
    }

    public function setHubVerifyToken($value)
    {
        $this->hubVerifyToken = $value;
    }

    public function setAccessToken($value)
    {
        $this->accessToken = $value;
    }

    public function verifyTokken($hub_verify_token, $challange)
    {
        try
        {
            if ($hub_verify_token === $this->hubVerifyToken)
            {
                return $challange;
            }
            else
            {
                throw new Exception("Tokken not verified");
            }
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
    }

    public function readMessage($input)
    {
        try
        {
            $payloads = null;
            $senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
            $messageText = $input['entry'][0]['messaging'][0]['message']['text'];
            $postback = $input['entry'][0]['messaging'][0]['postback'];
            $loctitle = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['title'];
            if (!empty($postback))
            {
                $payloads = $input['entry'][0]['messaging'][0]['postback']['payload'];
                return ['senderid' => $senderId, 'message' => $payloads];
            }
            if (!empty($loctitle))
            {
                $payloads = $input['entry'][0]['messaging'][0]['postback']['payload'];
                return ['senderid' => $senderId, 'message' => $messageText, 'location' => $loctitle];
            }
            // file_put_contents('abc.txt', $payloads);
            // var_dump($senderId,$messageText,$payload);
            //   $payload_txt = $input['entry'][0]['messaging'][0]['message']['quick_reply']‌​['payload'];
            return ['senderid' => $senderId, 'message' => $messageText];
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
    }

    public function sendMessage($input)
    {
        try
        {
            $client = new GuzzleHttpClient();
            $url = "https://graph.facebook.com/v2.6/me/messages";
            $messageText = strtolower($input['message']);
            $senderId = $input['senderid'];
            $msgarray = explode(' ', $messageText);

            $response = null;
            $header = array(
                'content-type' => 'application/json'
            );
            if (in_array('hi', $msgarray))
            {
                $answer = "Hello! how may I help you today?";
                $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $answer], 'access_token' => $this->accessToken];
            }
            elseif (in_array('blog', $msgarray))
            {
                $answer = ["attachment" => ["type" => "template", "payload" => ["template_type" => "generic", "elements" => [["title" => "Migrate your symfony application", "item_url" => "https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/", "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg", "subtitle" => "Migrate your symfony application from Cpanel to Cloud.", "buttons" => [["type" => "web_url", "url" => "www.cloudways.com", "title" => "View Website"], ["type" => "postback", "title" => "Start Chatting", "payload" => "get started"]]]]]]];
                $response = ['recipient' => ['id' => $senderId], 'message' => $answer, 'access_token' => $this->accessToken];

                // file_put_contents('abc.txt', print_r($response));
            }
            elseif (in_array('list', $msgarray))
            {
                $answer = ["attachment" => ["type" => "template", "payload" => ["template_type" => "list", "elements" => [["title" => "Welcome to Peter\'s Hats", "item_url" => "https://www.cloudways.com/blog/migrate-symfony-from-cpanel-to-cloud-hosting/", "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg", "subtitle" => "We\'ve got the right hat for everyone.", "buttons" => [["type" => "web_url", "url" => "https://cloudways.com", "title" => "View Website"], ]], ["title" => "Multipurpose Theme Design and Versatility", "item_url" => "https://www.cloudways.com/blog/multipurpose-wordpress-theme-for-agency/", "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/How-a-multipurpose-WordPress-theme-can-help-your-agency-Banner.jpg", "subtitle" => "We've got the right theme for everyone.", "buttons" => [["type" => "web_url", "url" => "https://cloudways.com", "title" => "View Website"], ]], ["title" => "Add Custom Discount in Magento 2", "item_url" => "https://www.cloudways.com/blog/add-custom-discount-magento-2/", "image_url" => "https://www.cloudways.com/blog/wp-content/uploads/M2-Custom-Discount-Banner.jpg", "subtitle" => "Learn adding magento 2 custom discounts.", "buttons" => [["type" => "web_url", "url" => "https://cloudways.com", "title" => "View Website"], ]]]]]];
                $response = ['recipient' => ['id' => $senderId], 'message' => $answer, 'access_token' => $this->accessToken];
            }
            elseif ($messageText == 'get started')
            {
                $answer = ["text" => "Please share your location:", "quick_replies" => [["content_type" => "location", ]]];
                $response = ['recipient' => ['id' => $senderId], 'message' => $answer, 'access_token' => $this->accessToken];
            }
            elseif (!empty($input['location']))
            {
                $answer = ["text" => 'great you are at' . $input['location'], ];
                $response = ['recipient' => ['id' => $senderId], 'message' => $answer, 'access_token' => $this->accessToken];
            }
            elseif (!empty($messageText))
            {
                $answer = 'I can not Understand you ask me about blogs';
                $response = ['recipient' => ['id' => $senderId], 'message' => ['text' => $answer], 'access_token' => $this->accessToken];
            }
            $response = $client->post($url, ['query' => $response, 'headers' => $header]);

            // file_put_contents("payytorrrr.json", json_encode($response));
            return true;
        }
        catch(RequestException $e)
        {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            file_put_contents("payytorrrre.json", json_encode($response));
            return $response;
        }
    }
}
?>