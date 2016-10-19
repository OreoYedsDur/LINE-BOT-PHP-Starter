<?php
$access_token = 'ZRkfUwSeA73UqLf8DYvAzBE9sr32ILmx0DCy+7O7e/LKyvIXxCs8qkljoAW0MIR0UWPFgCiEb+sWjafTOJztfVli9FBq20QTOpfDP2gDEeR76id+4Zg3LYn8om2A5pIULkia9CrYiUMZXGMjUCGF7gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;