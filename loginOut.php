<?php
session_start();
if (isset($_SESSION["userInfo"])) unset($_SESSION["userInfo"]);
if (isset($_COOKIE["info"])) setcookie("info",'', 0);
header('Location: /login.html');
exit();
