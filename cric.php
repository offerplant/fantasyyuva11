<?php

 //$api_url  = "http://cricapi.com/api/matches?apikey=ThMVp9ScvjXSWyZgiVXVY5808lk2";
 $api_url  = "https://cricapi.com/api/fantasySummary?apikey=ThMVp9ScvjXSWyZgiVXVY5808lk2&unique_id=1034809";

//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$api_url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a json - you can save in variable and use the json
$cricketMatches=json_decode($result,true);

$team1 = $cricketMatches['data']['team'][0];
$team2 = $cricketMatches['data']['team'][1];
$batting1 = $cricketMatches['data']['batting'][0]['scores'];
$bowling = $cricketMatches['data']['bowling'][0]['scores'];

echo"<pre>";

print_r();
  
?>