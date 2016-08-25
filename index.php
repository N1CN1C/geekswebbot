<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
* 
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('233107016:AAGdAYHuOxcpVgDf4Y05tM1nHhzGniGDQbQ'); // Set your access token
//$url = 'http://rss.cnn.com/rss/cnn_topstories.rss'; // URL RSS feed
$update = json_decode(file_get_contents('php://input'));

$randomChoice  = function($array) {return $array[array_rand($array)];};
$locations = ['Canteen A', 'Canteen B', '118', 'Vivo City', 'Telok Blangah', 'Depot Heights', 'Queensway', 'Good News Cafe', 'Bukit Merah Interchange'];

//your app
try {

    if($update->message->text == '/start')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "Welcome to Where To Eat. Type /eat to generate a random place to eat at. Type /locations to view the lsit of places. Type /about to view developer"
     	]);
    }
    else if($update->message->text == '/eat')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	//$pin = generatePIN();
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => ('Today we shall eat at ' .$randomChoice($locations))
    		]);

    }
    else if($update->message->text == '/locations')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Canteen A \n Canteen B \n 118 \n Vivo City \n Telok Blangah \n Depot Heights \n Queensway \n Good News Cafe \n Bukit Merah Interchange"
    		]);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands :\n /eat -> Generate a place to eat at \n /locations-> Get the list of locations to eat at
    		/help -> Shows list of available commands"
    		]);
    }
    else if($update->message->text == '/about')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Developer: N1CN1C 2016"
    		]);
    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Invalid command, please use /help to get list of available commands"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}

//function generatePIN($digits = 4){
    //$i = 0; //counter
    //$pin = ""; //our default pin is blank.
    //while($i < $digits){
        //generate a random number between 0 and 9.
       // $pin .= mt_rand(0, 9);
        //$i++;
    //}
    //return $pin;
//}
