<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] != 1) {
    goURLImm("/login.html");
    exit();
}
require_once "User.php";
?>
<div class="row">
    <div class="col-md-12">
        <!-- BASIC TABLE -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">用户列表</h3>
            </div>
            <div class="panel-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th class="text-center">序号</th>
                        <th class="text-center">用户名</th>
                        <th class="text-center">注册时间</th>
                        <th class="text-center">用户权限</th>
                        <th class="text-center" width="35%">编辑</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $pageNum = isset($_GET["pageNum"]) ? $_GET["pageNum"] : 1;
                    if (isset($_POST['search']) && !empty($_POST['search'])) {
                        $project = array("iduser_auth|OR|LIKE"=>"%".$_POST['search']."%",
                            "name_authcol|OR|LIKE"=>"%".$_POST['search']."%",
                            "time_authcol|OR|LIKE"=>"%".$_POST['search']."%",
                            "role_authcol||LIKE"=>"%".$_POST['search']."%");
                    } else {
                        $project = null;
                    }
                    $page = new User();
                    $r = $page->getUsers($pageNum, $project);
                    foreach ($r as $value) {
                        echo "<tr>";
                        foreach ($value as $k => $v) {
                            if ($k == 'role_authcol') {
                                echo "<td>";
                                switch ($v) {
                                    case 1:
                                        echo "<span style='color:red;'>管理员</span>";
                                        break;
                                    case 2:
                                        echo "<span style='color:green;'>普通用户</span>";
                                        break;
                                    default:
                                        echo "未授权用户";
                                        break;
                                }
                                echo "</td>";

                            } else {
                                echo "<td>$v</td>";
                            }
                        } ?>

                        <td>
                            <a href="/index.php?location=modifyUser&modifyUser=<?PHP echo $value['iduser_auth'] ?>"
                               class="btn btn-default">修改权限</a>
                            <a href="/index.php?location=modifyUser&deleteUser=<?PHP echo $value['iduser_auth'] ?>"
                               class="btn btn-default">删除</a>
                        </td>

                        <?php
                        echo "</tr>";
                    }
                    ?>

                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        if (($n = $pageNum - 1) < 1) {

                            echo "<li class='disabled'>
                                                    <a href=\"#\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";
                        } else {

                            echo "<li>
                                                    <a href=\"?location=authorityUser&pageNum=$n\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";
                        }

                        for ($i = 1; $i <= $page->pageTotal; $i++) {
                            if ($i == $pageNum) {
                                echo "<li class=\"active\"><a href=\"#\">$i</a></li>";
                            } else {
                                echo "<li><a href=\"?location=authorityUser&pageNum=$i\">$i</a></li>";
                            }
                        }

                        if (($n = $pageNum + 1) > $page->pageTotal) {

                            echo "<li class='disabled'>
                                                    <a href=\"#\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                        } else {

                            echo "<li>
                                                    <a href=\"?location=authorityUser&pageNum=$n\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END BASIC TABLE -->
    </div>
</div>