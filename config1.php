<?php
if(!defined('Books'))
{
    header('Location: /login.html');
    exit();
}

// database config
date_default_timezone_set("Asia/Shanghai");

$config = array();

//$config['evn']['debug']=true;
$config['evn']['debug']=false;

$config['db']['host']="localhost";
$config['db']['dbname']="yssp";
$config['db']['user']="BDyssp";
$config['db']['pass']="BDyssp";
$config['db']['charset']="utf8";
$config['db']['dbtbpre']="jzxs_";

$config['dbUser']['host']="localhost";
$config['dbUser']['dbname']="authority";
$config['dbUser']['user']="root";
$config['dbUser']['pass']="ysspYSSP";
$config['dbUser']['charset']="utf8";


$config['authority']['invaild']="0";
$config['authority']['admin']="1";
$config['authority']['user']="2";

$dbtbpre = $config['db']['dbtbpre'];