<?php
/**
 * User: NEVER
 * Date: 2018/7/30
 * Time: 上午11:19
 */

define('DIR_ROOT', dirname(dirname(__FILE__)));
define("OAPI_HOST", "https://oapi.dingtalk.com");

// 数据库
define("DB_HOST", "");
define("DB_USER", "");
define("DB_PWD", "");
define("DB_DBNAME", "");
define("DB_CHARSET", "UTF-8");

// 钉钉
define("CORPID", "");
define("SECRET", "");
define("AGENTID", "");//必填，在创建微应用的时候会分配
define("ENCODING_AES_KEY", "123456"); //加解密需要用到的token，普通企业可以随机填写,例如:123456
define("TOKEN", ""); //数据加密密钥。用于回调数据的加密，长度固定为43个字符，从a-z, A-Z, 0-9共62个字符中选取,您可以随机生成