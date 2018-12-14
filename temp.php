<?php
//$arr = array(array("a1", "a2"),array("b1", "b2"));
//
//$cNum = count($arr);
//echo $cNum;
//$s = "asd|df";
//$arr = explode("|", $s);
//echo $arr[0]."<br/>";
//echo $arr[1]."<br/>";

date_default_timezone_set("Asia/Shanghai");


$isCheckSession = true;

if (isset($isCheckSession)) {
    echo 'false';
} else {
    echo 'null';
}


//var_dump($_COOKIE["info"]);
//
//var_dump($_COOKIE["info"]);
//setcookie('info', null, 0);

//session_start();
//var_dump($_SESSION["userInfo"]);
//session_destroy();

//var_dump(unserialize($_COOKIE['info']));


//if(!isset($_COOKIE['info'])){
//    echo "dddddddd";
//    $userCookie = serialize(array("userName" => "123", "password" => "sdaf"));
//    setcookie("info", $userCookie, time()+3);
//}


// Print a cookie


//echo date("Y-m-d H:i:s", time());

//$tables = "{$dbtbpre}enewsgbook";
//$colums = array("name" => "98", "mycall" => "9ddd", "lytext" => "ccd");
//$project = array("lyid|AND" => "12", "mycall" => "9ddd");
//$order = "lyid ASC";
//$limit = "1";
//
//$order = "lyid ASC";
//$limit = "1";
//
//$conn->select($tables);
//echo $conn->getNum();
//var_dump($conn->getResult());


//$tables = "{$dbtbpre}enewsgbook";
//$colums = array("name" => "98", "mycall" => "9ddd", "lytext" => "ccd");
//$project = array("lyid|AND" => "12", "mycall" => "9ddd");
//$order = "lyid ASC";
//$limit = "1";
//echo $conn->update($tables, $colums, $project, $limit, $order);
//echo $conn->getNum();


//$tables = "{$dbtbpre}enewsgbook";
//$project = array("lyid|AND" => "13", "mycall" => "");
//$order = "lyid ASC";
//$limit = "1";
//echo $conn->delete($tables, $project, $limit, $order);
//echo $conn->getNum();


//$tables = "{$dbtbpre}enewsgbook";
//$colums = array("name" => "op", "lytext" => "gf", "retext" => "", "lytime" => date("Y-m-d h:i:s", time()));
//echo $conn->insert($tables, $colums);
//echo $conn->getNum();


//$db = $conn->getDbh();
//$sql= "update {$dbtbpre}enewsgbook set mycall=? where lyid=? and mycall=?";
//$sth = $db->prepare($sql);
//
//$name = "cdt";
//$sth->bindValue(1, "77");
//$sth->bindValue(2, "12");
//$sth->bindValue(3, "999");
//
//$sth->execute();
//echo $sth->debugDumpParams();
//echo $sth->rowCount();


//$conn->select($colums, $tables, $project, $order, $limit);


//if (empty($orders)) {
//    echo "ddf";
//}


//$colums = substr($colums,0, -1);
//echo $colums;
//$string=implode(",",$project);
//echo $string;


//$data = new Books();
//$data->page(0);
//$r->showAll();
//var_dump($r->showAll());


//$a=2;
//$b=3;
//echo ceil($a/$b);


//$aa = array("a"=>1,"b"=>2);
//$aa += array("c"=>3);
//
//var_dump($aa);

//echo md5("sadf");
//$project = array("lyid" => 1);
//array_push($project, 2, 3, 4);
//$project = $project + array("lyid" => 2);
//$project = $project + array("lyid" => 3);

//var_dump($project);
//
//$project = "1,2,";
//echo substr($project, 0, -1);
//$r=6;


//if ($r=1) {
//    echo ("dddd");
//} else {
//    die("fail");
//
//}
//$userID = 1;
//
//if(is_null($userID)){
//    echo "sadf";
//}else {
//    echo "ffff";
//
//}


//die();


//$config['db']['host']="localhost";
//$config['db']['dbname']="phome_ecms72";
//$config['db']['user']="ysspseo";
//$config['db']['pass']="seoyssp";
//$config['db']['charset']="utf8";
//$config['db']['dbtbpre']="phome_";

//$config['db']['host']="localhost";
//$config['db']['dbname']="ecms72";
//$config['db']['user']="ysspseo";
//$config['db']['pass']="seoyssp";
//$config['db']['charset']="utf8";
//$config['db']['dbtbpre']="phome_";

//$config['db']['host']="localhost";
//$config['db']['dbname']="yssp";
//$config['db']['user']="BDyssp";
//$config['db']['pass']="BDyssp";
//$config['db']['charset']="utf8";
//$config['db']['dbtbpre']="jzxs_";

//$config['dbUser']['host']="localhost";
//$config['dbUser']['dbname']="authority";
//$config['dbUser']['user']="root";
//$config['dbUser']['pass']="123123";
//$config['dbUser']['charset']="utf8";


//$config['db']['host'] = "121.199.42.235";
//$config['db']['dbname'] = "yssp";
//$config['db']['user'] = "yssp";
//$config['db']['pass'] = "yssp";
//$config['db']['charset'] = "utf8";


//$config['db']['host'] = "localhost";
//$config['db']['dbname'] = "seo";
//$config['db']['user'] = "root";
//$config['db']['pass'] = "123123";
//$config['db']['charset'] = "utf8";
//$config['db']['dbtbpre'] = "jzxs_";

//$name = isset($_POST["name"]) ? $_POST["name"] : "";
//$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
//$qqwx = isset($_POST["qqwx"]) ? $_POST["qqwx"] : "";
//$message = isset($_POST["message"]) ? $_POST["message"] : "";
//$ip = isset($_POST["ip"]) ? $_POST["ip"] : "";


//$name = "ssss";
//$tel = "ssss";
//$qqwx = "ssss";
//$message = "ssss";
//$ip = "ssss";

//echo "name is $name <br/>";
//echo "tel is $tel <br/>";
//echo "qqwx is $qqwx <br/>";
//echo "message is $message <br/>";
//echo "ip is $ip <br/>";


//$dsn = "mysql:host={$config['db']['host']};
//                dbname={$config['db']['dbname']};
//                charset={$config['db']['charset']}";
//$dbh = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
//
//$sql = "INSERT INTO phome_enewsgbook(name,mycall,email,lytext,ip,lytime,retext) VALUES(?,?,?,?,?,?,?)";
//$sth = $dbh->prepare($sql);
//
//$sth->bindValue(1,$name);
//$sth->bindValue(2,$tel);
//$sth->bindValue(3,$qqwx);
//$sth->bindValue(4,$message);
//$sth->bindValue(5,$ip);
//$sth->bindValue(6,date("Y-m-d H:i:s", time()));
//$sth->bindValue(7,"PHP");
//
//
//if ($sth->execute()) {
//
//    return $sth->rowCount() > 0 ? true : false;
//} else {
//    return "fail";
//}

//$dbh = null;




