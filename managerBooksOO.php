<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] != 1) {
    goURLImm("/login.html");
    exit();
}

if (isset($_POST["bookID"]) ? true : false) {

    $n = count($_POST["bookID"]);
    if ($n == 1) {
        $project = array("lyid" => $_POST["bookID"][0]);
    } else {
        $project = "";
        foreach ($_POST["bookID"] as $item => $value) {
            $project .= "'$value',";
        }
        $project = substr($project, 0, -1);
    }


    $books = new Books();
    if ($n == 1) {
        $r = $books->deleteItem($project);
    } else {
        $r = $books->deleteItems($project);
    }

    if ($r) {
        echo "<h3 style='color:green'>成功删除<span style='color: red'>$r</span>条记录</h3>";
        goURL("/index.php?location=managerBooks");
    } else {
        echo "<h3 style='color:red'>删除失败</h3>";
        goURL("/index.php?location=managerBooks");
    }


} else {
    ?>


    <div class="row">
        <div class="col-lg-12">
            <!-- BASIC TABLE -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">留言板</h3>
                </div>
                <div class="panel-body">
                    <form name="managerBooks" id="managerBooks" method="post" action="?location=managerBooks&pageNum=1"
                          onsubmit="return confirm('确认要执行此操作？');">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="text-center" width="1%"><input id="cAll" name="cAll" type="checkbox"></th>
                                <th class="text-center" width="6%">序号</th>
                                <th class="text-center" width="8%">客户姓名</th>
                                <th class="text-center" width="10%">手机号</th>
                                <th class="text-center" width="15">微信、QQ号</th>
                                <th class="text-center" width="14%">留言时间</th>
                                <th class="text-center" width="8%">留言分类</th>
                                <th class="text-center" width="">想学项目</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pageNum = isset($_GET["pageNum"]) ? $_GET["pageNum"] : 1;
                            if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                                $project = array("lyid|OR|LIKE" => "%" . $_REQUEST['search'] . "%",
                                    "name|OR|LIKE" => "%" . $_REQUEST['search'] . "%",
                                    "email|OR|LIKE" => "%" . $_REQUEST['search'] . "%",
                                    "mycall|OR|LIKE" => "%" . $_REQUEST['search'] . "%",
                                    "lytime|OR|LIKE" => "%" . $_REQUEST['search'] . "%",
                                    "lytext||LIKE" => "%" . $_REQUEST['search'] . "%");
                            } else {
                                $project = null;
                            }
                            $page = new Books(2);
                            $r = $page->pageContent($pageNum, $project);
                            foreach ($r as $value) {
                                echo "<tr>";
                                echo "<td><input type=\"checkbox\" name=\"bookID[]\" value=\"" . $value['lyid'] . "\"></td>";
                                foreach ($value as $k => $v) {
                                    if ($k == "retext") {
                                        if (substr($v, 0, 2) == "pc") {
                                            echo "<td><i class=\"fa fa-desktop\"></i></td>";
                                        } elseif (substr($v, 0, 2) == "mb") {
                                            echo "<td><i class=\"fa fa-mobile-phone\" style=\"font-size: 26px;\"></i></td>";
                                        } elseif (substr($v, 0, 2) == "jm") {
                                            $type = explode(".", $v);
                                            if ($type[1] == "desktop") {
                                                echo "<td style='color: #c45300;'><i class=\"fa fa-desktop\"></i></td>";
                                            } else {
                                                echo "<td style='color: #c45300;'><i class=\"fa fa-mobile-phone\" style=\"font-size: 26px;\"></i></td>";
                                            }
                                        } else {
                                            echo "<td><i class=\"fa fa-mobile-phone\" style=\"font-size: 26px;\"></i></td>";
                                        }
                                    } else {
                                        echo "<td>$v</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-default pull-right">删除所选留言</button>
                    </form>
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

                                if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {

                                    echo "<li>
                                                    <a href=\"?location=managerBooks&pageNum=$n&search=" . $_REQUEST['search'] . "\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";
                                } else {

                                    echo "<li>
                                                    <a href=\"?location=managerBooks&pageNum=$n\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";


                                }


                            }

                            for ($i = 1; $i <= $page->pageTotal; $i++) {
                                if ($i == $pageNum) {
                                    echo "<li class=\"active\"><a href=\"#\">$i</a></li>";
                                } else {
                                    if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {

                                        echo "<li><a href=\"?location=managerBooks&pageNum=$i&search=" . $_REQUEST['search'] . "\">$i</a></li>";
                                    } else {

                                        echo "<li><a href=\"?location=managerBooks&pageNum=$i\">$i</a></li>";
                                    }
                                }
                            }

                            if (($n = $pageNum + 1) > $page->pageTotal) {

                                echo "<li class='disabled'>
                                                    <a href=\"#\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                            } else {
                                if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {

                                    echo "<li>
                                                    <a href=\"?location=managerBooks&pageNum=$n&search=" . $_REQUEST['search'] . "\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                                } else {

                                    echo "<li>
                                                    <a href=\"?location=managerBooks&pageNum=$n\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                                }

                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- END BASIC TABLE -->
        </div>
    </div>

<?php } ?>