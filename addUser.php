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
    <div class="col-lg-6 col-lg-offset-3 margin-top-30">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>注册用户</h3></div>
            <div class="panel-body">

                <form name="regist" id="regist" method="post" action="?location=regist" accept-charset="UTF-8">
                    <div class="form-group">
                        <label for="userName">用户名</label>
                        <input type="text" class="form-control" id="userName" name="userName">
                    </div>
                    <div class="form-group">
                        <label for="userPassword">登录密码</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">重复密码</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">您的邮箱</label>
                        <input type="text" class="form-control" id="userEmail" name="userEmail">
                    </div>
                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">提交</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#regist').bootstrapValidator({
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
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: '两次输入密码不一致'
                        },
                        different: {
                            field: 'userName',
                            message: '密码不能和用户名相同'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        notEmpty: {
                            message: '请再次输入密码'
                        },
                        identical: {
                            field: 'userPassword',
                            message: '两次输入密码不一致'
                        },
                        different: {
                            field: 'userName',
                            message: '密码不能和用户名相同'
                        }
                    }
                },
                userEmail: {
                    validators: {
                        notEmpty: {
                            message: '请输入您的邮箱'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+@[a-zA-Z0-9_\.]+$/,
                            message: '邮箱格式不正确'
                        },
                    }
                }
            }
        });
    });
</script>

</html>
