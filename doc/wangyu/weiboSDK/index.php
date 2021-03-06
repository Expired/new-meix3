<?php
session_start();
////////////////////////////////////////
//include_once( 'config.php' );
header('Content-Type: text/html; charset=UTF-8');

// 调试模式开关
define( 'DEBUG_MODE', false );

if ( !function_exists('curl_init') ) {
    echo '您的服务器不支持 PHP 的 Curl 模块，请安装或与服务器管理员联系。';
    exit;
}

define( "WB_AKEY" , '2829273577' );
define( "WB_SKEY" , '3b0bbd2f82d1c2d0243df140e958782c' );
define( "WB_CALLBACK_URL" , 'http://weibosdk.sinaapp.com/callback.php' );//http://weibosdk.sinaapp.com/callback.php

if ( DEBUG_MODE ) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}
//////////////////////////////////////////
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$o->set_debug( DEBUG_MODE );

// 生成state并存入SESSION，以供CALLBACK时验证使用
$state = uniqid( 'weibo_', true);
$_SESSION['weibo_state'] = $state;

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL , 'code', $state );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新浪微博PHP SDK V2版 Demo - Powered by Sina App Engine</title>
</head>

<body>
    <p><a href="<?=$code_url?>"><img src="weibo_login.png" title="点击进入授权页面" alt="点击进入授权页面" border="0" /></a></p>
	<hr />
	<p>新浪微博PHP SDK由新浪SAE团队开发和维护，已集成在新浪SAE平台，SAE团队会负责对其进行维护和更新，平台开发者无需自行下载更新即可直接调用最新SDK，使用微博最新API。</p>
	<p>本DEMO演示了PHP SDK的授权及接口调用方法，开发者可以在此基础上进行灵活多样的应用开发。</p>
	<hr />
	<p>什么是新浪SAE？</p>
	<p>新浪SAE，全称Sina App Engine( <a href="http://sae.sina.com.cn" target="_blank">http://sae.sina.com.cn</a> )，是新浪研发中心推出的国内首个公有云计算平台。</p>
	<p>SAE选择在国内流行最广的Web开发语言PHP作为首选的支持语言， 同时还提供JAVA与Python语言的支持。</p>
	<p>应用开发者可以通过SVN或者在线代码编辑器进行开发、部署、调试，并可以通过应用成员管理、SVN代码管理方便地进行团队协作开发。</p>
	<p>SAE为开发者提供MySQL、Storage、Memcache、KVDB、XHProf、定时任务、异步任务队列、计数器服务、分词服务、全文检索服务、苹果消息推送服务等众多服务，用户无需关心运维和一些高难度技术即可快速开发，极大提高开发效率。</p>
	<p>SAE采用“所付即所用，所付仅所用”的计费理念，通过日志和统计中心精确的计算每个应用的资源消耗，进行精确计费。并且SAE会对通过开发者认证的用户赠送免费额度，使开发者可以零成本创业。</p>
	<p>更多SAE相关内容，请点击 <a href="http://sae.sina.com.cn/?m=devcenter" target="_blank">http://sae.sina.com.cn/?m=devcenter</a> 。</p>
</body>
</html>