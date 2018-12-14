<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] == 0) {
    header('Location: /login.html');
    exit();
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- BASIC TABLE -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">留言板</h3>
            </div>
            <div class="panel-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th class="text-center">序号</th>
                        <th class="text-center">客户姓名</th>
                        <th class="text-center">手机号</th>
                        <th class="text-center">微信、QQ号</th>
                        <th class="text-center">留言时间</th>
                        <th class="text-center">留言分类</th>
                        <th class="text-center" width="36%">想学项目</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $pageNum = isset($_GET["pageNum"]) ? $_GET["pageNum"] : 1;
                    if (isset($_POST['search']) && !empty($_POST['search'])) {
                        $project = array("lyid|OR|LIKE" => "%" . $_POST['search'] . "%",
                            "name|OR|LIKE" => "%" . $_POST['search'] . "%",
                            "email|OR|LIKE" => "%" . $_POST['search'] . "%",
                            "mycall|OR|LIKE" => "%" . $_POST['search'] . "%",
                            "lytime|OR|LIKE" => "%" . $_POST['search'] . "%",
                            "lytext||LIKE" => "%" . $_POST['search'] . "%");
                    } else {
                        $project = array("retext||NOT LIKE" => "%pc%");
                    }

                    $page = new Books();
                    $r = $page->pageContent($pageNum, $project);
                    foreach ($r as $value) {
                        echo "<tr>";
                        foreach ($value as $k => $v) {
                            if ($k == "retext") {
                                if (substr($v, 0, 2) == "pc") {
                                    echo "<td><i class=\"fa fa-desktop\"></i></td>";
                                } else {
                                    echo "<td><i class=\"fa fa-mobile-phone\"  style=\"font-size: 26px;\"></i></td>";
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
                                                    <a href=\"?location=showBooks&pageNum=$n\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";
                        }

                        for ($i = 1; $i <= $page->pageTotal; $i++) {
                            if ($i == $pageNum) {
                                echo "<li class=\"active\"><a href=\"#\">$i</a></li>";
                            } else {
                                echo "<li><a href=\"?location=showBooks&pageNum=$i\">$i</a></li>";
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
                                                    <a href=\"?location=showBooks&pageNum=$n\" aria-label=\"Next\">
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