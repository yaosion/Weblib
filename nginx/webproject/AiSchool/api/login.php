<?php
header("Content-type: text/html; charset=utf-8");
require('curl.class.php');

$host="http://192.168.21.46";
$curl=new curl($host);

$curl->setUserAgent('Koala Admin');

// {"password":"123456","username":"chenzhiquan@qtone.cn"}
$path='/auth/login';
$username = $_POST['username'];
$pwd = $_POST['password'];
$data=array("username"=>$username, "password" => $pwd);

$result = $curl->post($path,$data,false);

echo $result;
exit;

// print_r($curl->object_array(json_decode($result)));
?>