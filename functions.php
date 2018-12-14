<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}


function goURL($url)
{

    echo <<< BOF
<script>
    function delayer() {
        window.location = "$url";
    }

    setTimeout('delayer()', 3500);
</script>
BOF;

}


function goURLImm($url)
{

    echo <<< BOF
<script>
        window.location = "$url";
</script>
BOF;

}

function checkCookie()
{
    global $salt;
    if (!isset($_SESSION['userInfo']) && isset($_COOKIE['info'])) {
        $userInfo = unserialize($_COOKIE['info']);
        $user = new User();
        $r = $user->getUser($userInfo['hashID']);
        if (!is_null($r) && $r) {
            $hash = $r['password_authcol'] . $salt;
            if ($userInfo['hashValue'] == md5($hash)) {

                $_SESSION['userInfo']['userName'] = $r['name_authcol'];
                $_SESSION['userInfo']['userID'] = $r['iduser_auth'];
                $_SESSION['userInfo']['userRole'] = $r['role_authcol'];
            }
        }
    }
}

function checkSession()
{
    if (isset($_SESSION['userInfo'])) {
        $user = new User();
        if (!$user->getUser($_SESSION['userInfo']['userID'])) {
            if (isset($_SESSION["userInfo"])) unset($_SESSION["userInfo"]);
            if (isset($_COOKIE["info"])) setcookie("info", '', 0);
            header('Location: /login.html');
            exit();
        }
    }
}