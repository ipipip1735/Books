<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if ($_SESSION['userInfo']['userRole'] == 0) {
    goURLImm("/login.html");
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
                    $page = new Books();

                    if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                        $like = "%" . $_REQUEST['search'] . "%";
                        $where = "(retext LIKE '%pc%') AND (lyid LIKE '$like' OR name LIKE '$like' OR email LIKE '$like' OR mycall LIKE '$like' OR lytime LIKE '$like' OR lytext LIKE '$like')";
                        $r = $page->pageContentFree($pageNum, $where);
                    } else {
                        $project = array("retext||LIKE" => "%pc%");
                        $r = $page->pageContent($pageNum, $project);
                    }

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
                            if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                                echo "<li>
                                                    <a href=\"?location=showBooksPC&pageNum=$n&search=" . $_REQUEST['search'] . "\" aria-label=\"Previous\">
                                                        <span aria-hidden=\"true\">&laquo;</span>
                                                    </a>
                                                </li>";
                            } else {
                                echo "<li>
                                                    <a href=\"?location=showBooksPC&pageNum=$n\" aria-label=\"Previous\">
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
                                    echo "<li><a href=\"?location=showBooksPC&pageNum=$i&search=" . $_REQUEST['search'] . "\">$i</a></li>";
                                } else {
                                    echo "<li><a href=\"?location=showBooksPC&pageNum=$i\">$i</a></li>";
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
                                                    <a href=\"?location=showBooksPC&pageNum=$n&search=" . $_REQUEST['search'] . "\" aria-label=\"Next\">
                                                        <span aria-hidden=\"true\">&raquo;</span>
                                                    </a>
                                                </li>";
                            } else {
                                echo "<li>
                                                    <a href=\"?location=showBooksPC&pageNum=$n\" aria-label=\"Next\">
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