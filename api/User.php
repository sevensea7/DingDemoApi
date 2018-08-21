<?php
require_once(__DIR__ . "/../util/Http.php");

class User
{
    private $http;
    public function __construct() {
        $this->http = new Http();
    }   

    public function getUserInfo($accessToken, $code) {
        $responseId = $this->http->get("/user/getuserinfo",
            array("access_token" => $accessToken, "code" => $code));
        if ($responseId->errcode == 0) {
            $userId = $responseId->userid;
            $response = $this->http->get("/user/get",
                array("access_token" => $accessToken, "userid" => $userId));
            return $response;
        } else {
           return $responseId;
        }
    }

    public function getUserId($accessToken, $code) {
        $response = $this->http->get("/user/getuserinfo",
            array("access_token" => $accessToken, "userid" => $code));
        return $response;
    }

    public function simpleList($accessToken,$deptId) {
        $response = $this->http->get("/user/simplelist",
            array("access_token" => $accessToken,"department_id"=>$deptId));
        return $response;

    }
}