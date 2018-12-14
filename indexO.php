<?php
define('Books', true);
require_once "config.php";
require_once "MyDB.php";
require_once "functions.php";
require_once "Books.php";
require_once "User.php";
require_once "init.php";

session_start();
checkCookie();
if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['userRole'] == 0) {
    header('Location: /login.html');
    exit();
}

$location = isset($_GET["location"]) ? $_GET["location"] : null;
?>

    <!DOCTYPE HTML>
    <html lang="en">

    <head>
        <title>御世尚品-留言管理后台</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- VENDOR CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrapValidator.css">
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
        <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">

        <!-- VENDOR JS -->
        <script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>
        <script type="text/javascript" src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/vendor/bootstrap/js/bootstrapValidator.js"></script>
        <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/scripts/klorofil-common.js"></script>
        <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="assets/vendor/chartist/js/chartist.min.js"></script>

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        <link rel="stylesheet" href="assets/css/demo.css">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/logo.ico">
    </head>

    <body>
    <!-- WRAPPER -->
    <div id="wrapper">

        <?php require "navigation.php" ?>

        <?php require "menu.php" ?>


        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">

                    <?php
                    if (isset($location)) require "$location.php";
                    ?>

                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright"><a href="http://www.yssp88.com" target="_blank">御世尚品</a> 版权所有 Copyright
                    &copy; <?= date("Y", time()) ?>
                    YSSP. All Rights Reserved. </p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->


    </body>


    <script>
        $("tr").hover(function () {

            $(this).css("background", "#eee")
        }, function () {
            $(this).css("background", "none")
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#modifyPassword').bootstrapValidator({
                // live: 'disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    userName: {
                        validators: {
                            notEmpty: {
                                message: '请输入用户名'
                            },
                            stringLength: {
                                min: 5,
                                max: 20,
                                message: '用户名必须是6~20个字符'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '用户名只能由英文或数字组成'
                            },
                        }
                    },
                    userPassword: {
                        validators: {
                            notEmpty: {
                                message: '请输入密码'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: '密码必须是6~20个字符'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '密码只能由英文或数字组成'
                            }
                        }
                    },
                    newPassword: {
                        validators: {
                            notEmpty: {
                                message: '请输入密码'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: '密码必须是6~20个字符'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '密码只能由英文或数字组成'
                            },
                            identical: {
                                field: 'confirmPassword',
                                message: '两次输入密码不一致'
                            },
                            different: {
                                field: 'userName',
                                message: '密码不能和用户名相同'
                            },
                            different: {
                                field: 'userPassword',
                                message: '密码不能和旧密码相同'
                            }
                        }
                    },
                    confirmNewPassword: {
                        validators: {
                            notEmpty: {
                                message: '请再次输入密码'
                            },
                            identical: {
                                field: 'newPassword',
                                message: '两次输入密码不一致'
                            }
                        }
                    }
                }
            });

            $('#modifyUser').bootstrapValidator({
                // live: 'disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    userName: {
                        validators: {
                            notEmpty: {
                                message: '请输入用户名'
                            },
                            stringLength: {
                                min: 5,
                                max: 20,
                                message: '用户名必须是6~20个字符'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '用户名只能由英文或数字组成'
                            },
                        }
                    }
                }
            });
        });

        $(document).ready(function () {


        });
    </script>
    </html>
<?php
require_once "end.php";
?>