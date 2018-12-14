<?php
session_start();
define('Books', true);

require_once "config.php";
require_once "MyDB.php";
require_once "User.php";

if (isset($_POST["userName"]) || isset($_POST["userPassword"])) {
    $name_authcol = trim($_POST["userName"]);
    $password_authcol = trim($_POST["userPassword"]);
    $remember = isset($_POST["remember"]) && $_POST["remember"][0] == "true" ? true : false;

    $user = new User();
    $project = array("name_authcol|AND" => $name_authcol,
        "password_authcol" => md5($password_authcol));


    if (!is_null($r = $user->checkUser($project))) {
        if ($r['role_authcol'] == 0) {
            $url = "/login.html";
            $messageHeader = "<span style='color: red;'>登录失败</span>";
            $messageBody = "用户<span style='color: red;'>未授权</span>，请等待管理员授权";
        } else {

            if (!isset($_COOKIE['userInfo']) && $remember) {
                $hash = $r['password_authcol'] . $salt;
                $userCookie = serialize(array("hashID" => $r['iduser_auth'], "hashValue" => md5($hash)));
                setcookie("info", $userCookie, time() + 2*30*24*3600);
            }

            $_SESSION['userInfo']['userName'] = $name_authcol;
            $_SESSION['userInfo']['userID'] = $r['iduser_auth'];
            $_SESSION['userInfo']['userRole'] = $r['role_authcol'];

            $url = "/index.php";
            $messageHeader = "<span style='color: green;'>成功登录</span>";
            $messageBody = "登录成功，即将转到后台";
        }

    } else {
        $url = "/login.html";
        $messageHeader = "<span style='color: red;'>登录失败</span>";
        $messageBody = "您的<span style='color: red;'>用户名</span>或<span style='color: red;'>密码</span>错误，请重新登录！";
    }
} else {
    $url = "/login.html";
    $messageHeader = "<span style='color: red;'>未登录</span>";
    $messageBody = "请先登录！";
}

require_once "message.php";