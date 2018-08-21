<?php

/**
 * 状态码解释
 * 200 返回成功
 * 400 未查询到数据
 * 401 参数不合法
 * 402 连接数据库失败
 * 403 数据查询失败
 */


class Response {
	const JSON = "json";
	/**
	* 按综合方式输出通信数据
	* @param integer $code 状态码
    * @param string $success 成功信息
	* @param string $msg 提示信息
	* @param array $data 数据
	* @param string $type 数据类型
	* @return string
	*/
	public static function show($code, $success, $msg = '', $data = array(), $type = self::JSON) {
		if(!is_numeric($code)) {
			return '';
		}

		$type = isset($_GET['format']) ? $_GET['format'] : self::JSON;

		$result = array(
			'code' => $code,
			'success' => $success,
			'msg' => $msg,
			'data' => $data,
		);

		if($type == 'json') {
			self::json($code, $success, $msg, $data);
			exit;
		} elseif($type == 'array') {
			var_dump($result);
		} elseif($type == 'xml') {
			self::xmlEncode($code, $success, $msg, $data);
			exit;
		} else {
			// TODO
		}
	}

	/**
	* 按json方式输出通信数据
	* @param integer $code 状态码
    * @param string $success 成功信息
	* @param string $msg 提示信息
	* @param array $data 数据
	* @return string
	*/
	public static function json($code, $success, $msg = '', $data = array()) {
		
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
            'success' => $success,
			'msg' => $msg,
			'data' => $data
		);
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		exit;
	}

	/**
	* 按xml方式输出通信数据
	* @param integer $code 状态码
    * @param string $success 成功信息
	* @param string $msg 提示信息
	* @param array $data 数据
	* @return string
	*/
	public static function xmlEncode($code, $success, $msg, $data = array()) {
		if(!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
            'success' => $success,
			'msg' => $msg,
			'data' => $data,
		);

		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<root>\n";

		$xml .= self::xmlToEncode($result);

		$xml .= "</root>";
		echo $xml;
	}

	public static function xmlToEncode($data) {

		$xml = $attr = "";
		foreach($data as $key => $value) {
			if(is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= is_array($value) ? self::xmlToEncode($value) : $value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}

}