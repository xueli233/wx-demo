<?php 
function checkSignature()
{

	file_put_contents('input.log', serialize($_POST), FILE_APPEND);
	if (empty($_GET['echostr'])) {
		return;
	}
		// file_put_contents('wx.log', serialize($_GET), FILE_APPEND);
    // 获取微信发送过来的3个参数
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    
	$token = 'alue'; // 用户token
	$tmpArr = array($token, $timestamp, $nonce); //拼接数组,用来排序
	sort($tmpArr, SORT_STRING); //字典排序
	$tmpStr = implode( $tmpArr ); //数组组合成字符串
	$tmpStr = sha1( $tmpStr );//sha1加密
  // 判断是否一致
	if( $tmpStr == $signature ){
    echo $_GET['echostr']; // 返回echostr验证成功
		// file_put_contents('echostr.log', serialize($_GET['echostr']), FILE_APPEND);
	}else{
		echo 'failed';
	}
	exit;
}

checkSignature();


