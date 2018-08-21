<?php
require_once './util/Config.php';
require_once './util/Log.php';
require_once './util/Cache.php';
require_once './util/Response.php';
require_once './api/Auth.php';
require_once './api/User.php';

// 允许跨域访问
header('Access-Control-Allow-Origin:*');

$auth = new Auth();
$user = new User();

$event = $_REQUEST["event"];
switch($event){
    case '':
        Response::show(401,false,"不存在的参数");
        break;
    case 'get_userinfo':
        $accessToken = $auth->getAccessToken();
        $code = $_POST["code"];
        $userInfo = $user->getUserInfo($accessToken, $code);
        if ($userInfo->errcode == 0) {
            Response::show(200,true,'用户信息获取成功', $userInfo);
        } else {
            Response::show(400,false,'未获得用户信息', $userInfo);
        }
        break;
    case 'jsapi_oauth':
        $href = $_GET["href"];
        $configs = $auth->getConfig($href);
        $configs['errcode'] = 0;
        Response::show(200,true,'数据获取成功', $configs);
        break;
}
