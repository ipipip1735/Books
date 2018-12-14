<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}
if (isset($_GET['location'])) $location = $_GET['location'];
?>
<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-btn">
        <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>
    <a href="index.html"><img src="assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
    <h2 class="col-lg-3">御世尚品餐饮实训</h2>
    <div class="container-fluid">

        <form class="navbar-form navbar-right" action="/index.php?location=<?=$location?>" method="post">
            <div class="input-group">
                <input type="text" value="" name="search" class="form-control" placeholder="智能搜索">
                <span class="input-group-btn"><button type="submit" class="btn btn-primary">Go</button></span>
            </div>
        </form>
    </div>
</nav>
<!-- END NAVBAR -->