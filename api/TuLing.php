<?php
class TuLing
{
  public static function GetData ($info)
  {
    $url = 'http://www.tuling123.com/openapi/api';
    $key = '018d7b365e3140a9bf9e7f77ab7e977a';
    $data = Curl::CurlGet($url.'?key='.$key.'&info='.$info);
    return $data;
  }
}