<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.black-ribbon {
		  	position: fixed;
		  	z-index: 9999;
		  	width: 70px;
		}
		@media only all and (min-width: 768px) {
  			.black-ribbon {
    			width: auto;
  			}
		}
		.stick-left { left: 0; }
		.stick-right { right: 0; }
		.stick-top { top: 0; }
		.stick-bottom { bottom: 0; }
	</style>
</head>
<body>

<!-- Bottom Left -->
<img src="images/black_ribbon_bottom_left.png" class="black-ribbon stick-bottom stick-left"/>

</body>
</html>

<?php
$access_token = 'ZRkfUwSeA73UqLf8DYvAzBE9sr32ILmx0DCy+7O7e/LKyvIXxCs8qkljoAW0MIR0UWPFgCiEb+sWjafTOJztfVli9FBq20QTOpfDP2gDEeR76id+4Zg3LYn8om2A5pIULkia9CrYiUMZXGMjUCGF7gdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
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
			$messages = [
				'type' => 'text',
				'text' => $text
			];

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

?>