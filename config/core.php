<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus - PC
 * Date: 6/1/2019
 * Time: 11:42 PM
 */

$config = array();

$config["ANONYMOUS_ALLOWED"] = array(
    "/user/login(/[a-zA-Z\d\%]+)?",
    "/user/authenticate",
    "/user/userreg",
    "/user/doRegistration[.]*",
    "/user/exists",
    "/user/UserActivate",
    "/user/checkCode",
    "/user/activate",
    "/main/index",
    "/main/login",
    "/main/ConfirmEmail",
    "/main/doRegistration[.]*",
    "/main/checkCode",
    "/main/activate"
);

$config["SMS_CONFIG"] = array(
    "host" => "localhost",
    "port" => "9710",
    "username"=>"admin",
    "password"=>"123"
);

$config["OTP_CONFIG"] = array(
    "ttl" => 30 //Currently, OTP is valid for only 30 seconds. Could be changed with this configuration
);

require_once 'mysql.php';

foreach ($config as $k=>$v) {
    define($k, $v);
}