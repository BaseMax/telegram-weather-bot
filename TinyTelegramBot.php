<?php
// Max Base
// https://github.com/BaseMax/TinyTelegramBotPHP
include "NetPHP.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if(!function_exists("startsWith")) {
	function startsWith($string, $startString) {
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}
}
$token="****:***-*******";
$uri="https://api.telegram.org/bot".$token."/";
$fileuri="https://api.telegram.org/file/bot".$token."/";
$input=file_get_contents("php://input");
$json=json_decode($input, true);
// if($input == "") {
// 	exit("Error!\n");
// }
function sendMessage($chatID, $message, $replyID=null, $html=false, $preview=false, $keyboard=[]) {
	global $token, $uri;
	$param=[];
	$param["text"]=$message;
	$param["chat_id"]=$chatID;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	if($html == true) {
		$param["parse_mode"]="HTML";
	}
	if($keyboard != []) {
		$keyboard=json_encode([
			'keyboard'=>$keyboard,
			'resize_keyboard'=>true,
			'one_time_keyboard'=>true,
			'selective'=>true,
		]);
		$param['reply_markup']=$keyboard;
		// $param["reply_markup"]=$keyboard;
		$param["resize_keyboard"]=true; 
		$param["one_time_keyboard"]=true;
	}
	$param["disable_web_page_preview"]=$preview;
	return post($uri."sendMessage", $param)[0];
}
function getFile($fileID) {
	global $token, $uri;
	$param=[];
	$param["file_id"]=$fileID;
	return post($uri."getFile", $param)[0];
}
function sendPhoto($chatID, $photo, $caption="", $replyID=null, $keyboard=[]) {
	global $token, $uri;
	$param=[];
	$param["chat_id"]=$chatID;
	$param["photo"]=new CURLFile($photo);
	$param["caption"]=$caption;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	if($keyboard != []) {
		$keyboard=json_encode([
			'keyboard'=>$keyboard,
			'resize_keyboard'=>true,
			'one_time_keyboard'=>true,
			'selective'=>true,
		]);
		$param['reply_markup']=$keyboard;
		$param["resize_keyboard"]=true; 
		$param["one_time_keyboard"]=true;
	}
	return post($uri."sendPhoto", $param)[0];
}
function sendDocument($chatID, $document, $caption="", $replyID=null, $keyboard=[]) {
	global $token, $uri;
	$param=[];
	$param["chat_id"]=$chatID;
	$param["document"]=new CURLFile($document);
	$param["caption"]=$caption;
	if($replyID != null) {
		$param["reply_to_message_id"]=$replyID;
	}
	if($keyboard != []) {
		$keyboard=json_encode([
			'keyboard'=>$keyboard,
			'resize_keyboard'=>true,
			'one_time_keyboard'=>true,
			'selective'=>true,
		]);
		$param['reply_markup']=$keyboard;
		$param["resize_keyboard"]=true; 
		$param["one_time_keyboard"]=true;
	}
	return post($uri."sendDocument", $param)[0];
}
/////////////////////////////////////////////////////
