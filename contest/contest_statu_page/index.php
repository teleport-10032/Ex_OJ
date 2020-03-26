<?php

date_default_timezone_set("PRC");
session_start();
if(isset($_GET["contest_id"]))
    $contest_id = $_GET['contest_id'];
if(isset($_POST["contest_id"]))
{
    $contest_id = $_POST['contest_id'];
}
if(isset($_POST["contest_passwd"]))
{
    $contest_passwd = $_POST['contest_passwd'];
}
if(isset($_GET["contest_passwd"]))
    $contest_passwd = $_GET['contest_passwd'];

include "../pwj.php";
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$str = "select contest_visible,contest_title from contest where contest_id='$contest_id' limit 1";
$result = $conn->query($str);
while (list($contest_visible,$contest_title) = $result->fetch_row())
{
    $title = $contest_title;
    if($contest_visible=='0')
    {
        echo "<script>alert('您无权限访问此页面！')</script>";
        echo "<script>url=\"/\";window.location.href=url;</script>";
        exit;
    }
}
$conn->close();
$result->close();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Contests|Excalibur OJ</title>

    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/Contests.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        footer {
            clear: both;
        }

        article {
            margin-top: 30px;
            min-height: 300px;
            height: auto;
        }
    </style>
</head>
<body>

<!--导航栏-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            echo "<a class=\"navbar-brand\" href=\"/contest/contest_page?id=$id&contest_passwd=$contest_passwd\">$title</a>";
            ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <?php
                echo "
                <li><a href=\"/contest/contest_page?contest_id=$contest_id&contest_passwd=$contest_passwd\">۩ Home </a></li>
                <li><a href=\"/contest/contest_problem?contest_id=$contest_id&contest_passwd=$contest_passwd\">✎ Problems</a></li>
                <li  class=\"reactive\"><a href=\"/contest/contest_statu?contest_id=$contest_id&contest_passwd=$contest_passwd\"> ❖ Status</a></li>
                <li><a href=\"/contest/contest_rank?contest_id=$contest_id&contest_passwd=$contest_passwd\"> ➹ Rank</a></li>
                ";
                ?>
            </ul>
            <!--不同用户的导航栏-->
            <?php
            include "../../pages/bar/index.php";
            ?>
            <!--不同用户的导航栏-->
        </div>
    </div>
</nav>
<!--导航栏-->



<!--登录注册-->
<?php
include "../../pages/register_and_login/index.php";
?>
<!--登录注册-->




<!--主体-->
<div class="panel panel-default" style="width: 80%;margin:0 auto;" id="wrapper">
    <div class="panel-body">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <h4 style="color: #349cf3">
                        Info：
                    </h4>

                    <?php
                    if(isset($_GET['submit_id']))
                        $submit_id= $_GET['submit_id'];
                    include "../../functions/user_judger.php";
                    include "../../functions/conn.php";

                    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                    // 检测连接
                    if (!$conn) {
                        die("连接失败: " . $conn->connect_error);
                    }
                    $conn->query("set names 'utf8'");
                    $str = "select submit_when,submit_problem,submit_statu ,submit_time, submit_memory, submit_language,submit_length,user_name,submit_text from contest_status,user where submit_id='$submit_id' and user_mail=submit_user_mail";
                    $result = $conn->query($str);
                    $flag = 1;
                    while (list($submit_when, $submit_problem, $submit_statu, $submit_time, $submit_memory, $submit_language, $submit_length, $submit_user, $submit_text) = $result->fetch_row()) {

                        if ($submit_user_mail == $user_mail || isset($_SESSION['admin_mail']) || isset($_SESSION['teacher_mail'])) {
                            $flag = 0;
                            echo "提交编号:" . "$submit_id" . "<br>";
                            echo "提交时间:" . "$submit_when" . "<br>";
                            echo "问题编号:" . "$submit_problem" . "<br>";
                            echo "状态:" . "$submit_statu" . "<br>";
                            echo "时间:" . "$submit_time" . "ms" . "<br>";
                            echo "内存:" . "$submit_memory" . "KB" . "<br>";
                            echo "代码长度:" . "$submit_length" . "<br>";
                            echo "用户:" . "$submit_user" . "<br>";
                            $code = $submit_text;
                            $code = str_replace("\n", "<br>", $code);
                        } else {
                            echo "<script>alert('您不具有访问该页面的权限！')</script>";
                            echo "<script>url=\"/\";window.location.href=url;</script>";
                            exit;
                        }
                    }
                    ?>
                    <h4 style="color: #349cf3">
                        Code:
                    </h4>
                    <dl>
                        <?php
//                        echo "<textarea style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'class = 'form-control' readonly>";
                        echo $code;
//                        echo "</textarea>";
                        ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<!--主体-->







<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>