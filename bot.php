<?php
$access_token = 'AdlGlZFCmua0+/PYr/y/iI7dF2c7DeVXkhG/FKp9K4Pp8qAuEWTv7yAx7vDX1t3B31gVTyIwIMhyO4g1XWptfVyFJ7kmUGdDrfB4Pd/UspZp0iIMrLeVq+YJIV0ZY0arNIDv4eVmwLOCm2yns5ezewdB04t89/1O/w1cDnyilFU=';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '1efe3c53bbd84320ce616b832c262094']);
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
//Restaurant lists
$kin = array("โรงอาหาร","เป็ด","เต๊นท์","ราเมง","กินคลีน","ไม่กิน ลดความอ้วน");
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			//$messages = [
				
				//'type' => 'template',
				//'template' => [ 'type' => 'button','text'=>'what']
				
				//=>['type'=>'confirm','text'=>'what','action'=>[['type'=>'message','label'=>'google','text'=>'www.google.com']]]
				
				
				
			//];

			
			if ($text == "สวัสดี"){
			$messages = [ 'type'=>'text','text'=>"สวัสดีจ้าาาา"]; }
			else if ($text == "ทำไรอยู่") {
			$messages = [ 'type'=>'text','text'=>"ไม่บอก อิอิ"]; }
			else if ($text == "ไอซ์") {
			$messages = [ 'type'=>'text','text'=>"จ๋าาาาาา"]; }
			else if ($text == "กินไรดี") {
			$messages = [ 'type'=>'text','text'=>$kin[rand(0, count($kin) - 1)]]; }
			else {
			$messages = [ 'type'=>'text','text'=>"อิอิ"];	
			}
			/*
			if ($text == "สวัสดี"){
			$messages = [ 'type'=>'text','text'=>"สวัสดีจ้า"]; 
			}
			else {
			$messages = [ 'type'=>'text','text'=>"อิอิ"];
			}*/
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
