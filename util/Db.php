<?php
/**
 * User: NEVER
 * Date: 2018/7/20
 * Time: 下午4:39
 */

require_once 'Config.php';
require_once 'Log.php';

class Db {

    static private $_instance;
    static private $_link;
    private $serverName = DB_HOST;
    private $connectionInfo = array(
        'UID'=>DB_USER,
        'PWD'=>DB_PWD,
        'Database'=>DB_DBNAME,
        'CharacterSet'=>DB_CHARSET
    );
    private function __construct() {
    }
    static public function getInstance() {
        if (!(self::$_instance instanceof self))  {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function connect() {
        if (!self::$_link) {
            self::$_link = sqlsrv_connect( $this->serverName, $this->connectionInfo);

            // 检查连接
            if (!self::$_link) {
                Log::e('连接失败');
            } else {
                Log::i('连接成功');
            }
        }

        return self::$_link;
    }
}
