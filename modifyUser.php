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
                <h3 class="panel-title">修改用户授权</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-10">

                    <?php
                    if (isset($_POST['userName']) && isset($_POST['userAuthority']) && isset($_GET['modifyUser'])) {

                        $iduser_auth = trim($_GET['modifyUser']);
                        $name_authcol = trim($_POST['userName']);
                        $role_authcol = trim($_POST['userAuthority']);
                        require_once "User.php";
                        $user = new User();
                        $project = array("iduser_auth" => $iduser_auth);
                        $colums = array("role_authcol" => $role_authcol);
                        $r = $user->modifyUser($colums, $project);
                        if ($r > 0) {
                            echo "<h3 style='color:green'>权限修改成功</h3>";
                            goURL("/index.php?location=authorityUser");
                        } else {
                            echo "<h3 style='color:red'>权限修改失败</h3>";
                            goURL("/index.php?location=authorityUser");
                        }

                    } elseif (isset($_GET['deleteUser'])) {
                        $iduser_auth = trim($_GET['deleteUser']);
                        require_once "User.php";
                        $user = new User();
                        $project = array("iduser_auth" => $iduser_auth);
                        $r = $user->deleteUser($project);
                        if ($r > 0) {
                            echo "<h3 style='color:green'>成功删除</h3>";
                            goURL("/index.php?location=authorityUser");
                        } else {
                            echo "<h3 style='color:red'>删除失败</h3>";
                            goURL("/index.php?location=authorityUser");
                        }
                    } else {

                        $userID = isset($_GET['modifyUser']) ? $_GET['modifyUser'] : null;
                        if (!is_null($userID)) {
                            require_once "User.php";
                            $user = new User();
                            $userInfo = $user->getUser($userID);

                        }


                        if (!is_null($userInfo)) {
                            ?>

                            <form name="modifyUser" id="modifyPassword" method="post"
                                  action="/index.php?location=modifyUser&modifyUser=<?= $userInfo['iduser_auth'] ?>"
                                  accept-charset="UTF-8">
                                <div class="form-group">
                                    <label for="userName">用户名</label>
                                    <input type="text" class="form-control" id="userName"
                                           value="<?= $userInfo['name_authcol'] ?>" name="userName">
                                </div>
                                <div class="form-group">
                                    <label for="userAuthority">用户权限</label>
                                    <?php
                                    $user->showAuth($userInfo['role_authcol']);
                                    ?>
                                </div>
                                <input type="hidden" name="formID" value="modifyPassword">
                                <button type="submit" class="btn btn-primary" name="signup" value="Sign up">提交</button>
                            </form>
                        <?php }
                    } ?>


                </div>

            </div>
        </div>
        <!-- END BASIC TABLE -->
    </div>
</div>
