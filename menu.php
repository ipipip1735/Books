<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
?>


<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <?php
                if ($_SESSION['userInfo']['userRole'] == 1){
                ?>

                <li>
                    <?php
                    if ($location == "modifyPassword" || $location == "authorityUser" || $location == "addUser") {
                        echo "<a href=\"#users\" data-toggle=\"collapse\" aria-expanded=\"true\" class=\"active\">";
                    } else {
                        echo "<a href=\"#users\" data-toggle=\"collapse\" aria-expanded=\"true\" class=\"collapsed\">";
                    }
                    ?>
                    <i class="lnr lnr-user"></i>
                    <span>用户管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <?php
                    if ($location == "modifyPassword" || $location == "authorityUser" || $location == "addUser") {
                        echo "<div id=\"users\" class=\"collapse in\">";
                    } else {
                        echo "<div id=\"users\" class=\"collapse\">";
                    }
                    ?>
                    <ul class="nav">
                        <li>
                            <a href="?location=modifyPassword" <?php if ($location == "modifyPassword") echo "class=\"active\""; ?> ><span>修改密码</span></a>
                        </li>
                        <li>
                            <a href="?location=addUser" <?php if ($location == "addUser") echo "class=\"active\""; ?> ><span>注册用户</span></a>
                        </li>
                        <li>
                            <a href="?location=authorityUser&pageNum=1" <?php if ($location == "authorityUser") echo "class=\"active\""; ?> ><span>用户授权</span></a>
                        </li>
                    </ul>
    </div>
    </li>
    <?php
    }
    ?>

    <li>


        <?php
        if ($location == "showBooks" || $location == "showBooksPC" || $location == "showBooksJM" || $location == "managerBooks") {
            echo "<a href=\"#message\" data-toggle=\"collapse\" aria-expanded=\"true\" class=\"active\">";
        } else {
            echo "<a href=\"#message\" data-toggle=\"collapse\" aria-expanded=\"true\" class=\"collapsed\">";
        }
        ?>
        <i class="lnr lnr-database"></i>
        <span>留言管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
        <?php
        if ($location == "showBooks" || $location == "showBooksJM" || $location == "showBooksPC" || $location == "managerBooks") {
            echo "<div id=\"message\" class=\"collapse in\">";
        } else {
            echo "<div id=\"message\" class=\"collapse\">";
        }
        ?>
        <ul class="nav">
            <li>
                <a href="?location=showBooksPC&pageNum=1" <?php if ($location == "showBooksPC") echo "class=\"active\""; ?> ><span>官网留言</span></a>
            </li>
            <li>
                <a href="?location=showBooksJM&pageNum=1" <?php if ($location == "showBooksJM") echo "class=\"active\""; ?> ><span>加盟留言</span></a>
            </li>
            <li>
                <a href="?location=showBooks&pageNum=1" <?php if ($location == "showBooks") echo "class=\"active\""; ?> ><span>移动留言</span></a>
            </li>

            <?php
            if ($_SESSION['userInfo']['userRole'] == 1) {
                ?>
                <li>
                    <a href="?location=managerBooks&pageNum=1" <?php if ($location == "managerBooks") echo "class=\"active\""; ?> ><span>管理留言</span></a>
                </li>
                <?php
            }
            ?>

        </ul>
</div>
</li>
<li><a href="/loginOut.php"><i class="glyphicon glyphicon-log-out"></i> 安全退出</a></li>


</ul>
</nav>
</div>
</div>
<!-- END LEFT SIDEBAR -->