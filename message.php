<?php
if(!defined('Books'))
{
    header('Location: /login.html');
    exit();
}
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>御世尚品-留言管理后台</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
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

<div class="row text-center">
    <div class="col-lg-6 col-lg-offset-3 vertical-center">
        <div class="panel panel-default">
            <div class="panel-heading"><h3><?php echo $messageHeader ?></h3></div>
            <div class="panel-body">
                <p><?php echo $messageBody ?></p>
                <script>
                    function delayer(){
                        window.location = "<?php echo $url ?>";
                    }
                    setTimeout('delayer()', 3500);
                </script>
            </div>
        </div>
    </div>
</div>
</body>

</html>
