<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] != 1) {
    goURLImm("/login.html");
    exit();
}
?>


<div class="row">
    <div class="col-lg-6">
        <!-- BASIC TABLE -->
        <div class="panel col-lg-12">
            <div class="panel-heading">
                <h3 class="panel-title">修改密码</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-10">

                    <?php

                    $formID = isset($_POST["formID"]) ? $_POST["formID"] : null;
                    if ($formID == "modifyPassword") {
                    if (isset($_POST["userName"]) || isset($_POST["userPassword"]) || isset($_POST["newPassword"])) {

                        //check user
                        require_once "User.php";
                        $user = new User();
                        $project = array("name_authcol|AND" => trim($_POST["userName"]),
                            "password_authcol" => md5(trim($_POST["userPassword"])));
                        if ($user->checkUser($project)) {

                            $colums = array("password_authcol" => md5(trim($_POST["newPassword"])));
                            if (!is_null($user->modifyUser($colums, $project))) {

                                echo "<h3 style='color:green'>密码修改成功</h3>";
                                goURL("/index.php?location=modifyPassword");

                            }

                        } else {
                            echo "<h3 style='color:red'>原始密码错误</h3>";
                            goURL("/index.php?location=modifyPassword");
                        }
                    }


                    } else { ?>

                        <form name="modifyPassword" id="modifyPassword" method="post"
                              action="/index.php?location=modifyPassword"
                              accept-charset="UTF-8">
                            <div class="form-group">
                                <label for="userName">用户名</label>
                                <input type="text" class="form-control" id="userName" value="<?= $_SESSION['userInfo']['userName'] ?>"
                                       name="userName">
                            </div>
                            <div class="form-group">
                                <label for="userPassword">请输入原始密码</label>
                                <input type="password" class="form-control" id="userPassword" name="userPassword">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">请输入新密码</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword">
                            </div>
                            <div class="form-group">
                                <label for="confirmNewPassword">请重复新密码</label>
                                <input type="password" class="form-control" id="confirmNewPassword"
                                       name="confirmNewPassword">
                            </div>
                            <input type="hidden" name="formID" value="modifyPassword">
                            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">提交</button>
                        </form>
                    <?php } ?>


                </div>

            </div>
        </div>
        <!-- END BASIC TABLE -->
    </div>
</div>





