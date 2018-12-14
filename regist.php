<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] != 1) {
    goURLImm("/login.html");
    exit();
}

require_once "config.php";
require_once "MyDB.php";
require_once "User.php";

if (isset($_POST["userName"]) || isset($_POST["userPassword"])) {
    $name_authcol = trim($_POST["userName"]);
    if ($name_authcol == "") {
        $url = "?location=addUser";
        $messageHeader = "<span style='color: red;'>注册失败</span>";
        $messageBody = "注册失败,请填写用户名！";
    }else{

        $password_authcol = trim($_POST["userPassword"]);
        $email_authcol = isset($_POST["userEmail"])?trim($_POST["userEmail"]):null;


        $user = new User();
        if ($user->userExist($name_authcol)) {
            $colums = array("name_authcol" => $name_authcol,
                "password_authcol" => md5($password_authcol),
                "email_authcol" => $email_authcol);
            if ($user->addUser($colums)) {
                $url = "/index.php?location=authorityUser&pageNum=1";
                $messageHeader = "<span style='color: green;'>注册成功</span>";
                $messageBody = "恭喜！，注册已经完成，<span style='color: red;'>请给用户授权</span>";
            } else {
                $url = "?location=addUser";
                $messageHeader = "<span style='color: red;'>注册失败</span>";
                $messageBody = "非法操作，请重新注册！";
            }
        } else {
            $url = "?location=addUser";
            $messageHeader = "<span style='color: red;'>注册失败</span>";
            $messageBody = "用户名已经被<span style='color: red;'>其他人使用</span>，请选择另外一个用户名重新注册";
        }
    }


}else {
    $url = "?location=addUser";
    $messageHeader = "<span style='color: red;'>注册失败</span>";
    $messageBody = "请重新注册！";
}
?>
<div class="row text-center margin-top-30">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading"><h3><?php echo $messageHeader ?></h3></div>
            <div class="panel-body">
                <p><?php echo $messageBody ?></p>
                <script>
                    function delayer(){
                        window.location = "<?php echo $url ?>";
                    }
                    setTimeout('delayer()', 3500);
                </script>
            </div>
        </div>
    </div>
</div>

