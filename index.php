<?php
require_once('./api/Curl.php');
require_once('./api/TuLing.php');

// 获取微信输入的信息
$postStr = file_get_contents('php://input');
if(empty($postStr)) {
  file_put_contents('input.log','数据为空'.FILE_APPEND."\n",FILE_APPEND);
  return;
}

// 提取内容
$xml = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
// 回复的消息模板
$info = $xml->Content;
$res = TuLing::GetData($info);

file_Put_contents("data.log", $res);

// $json_str = replyMsg($res);
$json_str = '{"code":100000,"text":"我在哦"}';
echo $json_str;
// $str_a = explode(",",$json_str);
// $str_b = explode(":",$str_a[1]);
// $str_c = explode("\"",$str_b[1]);
// file_Put_contents("data.log", $str_c[0]);
// echo $str_c[0]."";

// 消息回复模板
function replyMsg($content) {
	global $xml;
	$str = sprintf('<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
	<CreateTime>%d</CreateTime>
	<MsgType><![CDATA[text]]></MsgType>
	<Content><![CDATA[%s]]></Content></xml>',
  $xml->FromUserName,$xml->ToUserName,time(), $content);
  return $str;
}
