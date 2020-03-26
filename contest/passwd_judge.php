<?php
include "../functions/user_judger.php";
session_start();
date_default_timezone_set("PRC");
if(isset($_GET["contest_id"]))
    $contest_id = $_GET['contest_id'];
include "../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$str = "select contest_visible,contest_title,contest_passwd,contest_start_time,contest_end_time from contest where contest_id='$contest_id' limit 1";
$result = $conn->query($str);
while (list($contest_visible,$contest_title,$contest_passwd,$start_time,$end_time) = $result->fetch_row())
{
    $passwd = $contest_passwd;
    $title = $contest_title;
    $now = strtotime('now');
    if(strtotime($start_time)>$now)
    {
        echo "<script>alert('比赛尚未开始！')</script>";
        echo "<script>url=\"/contest/contests\";window.location.href=url;</script>";
        exit;
    }
    if(strtotime($end_time)<$now)
    {
        echo "<script>alert('比赛已结束！')</script>";
        echo "<script>url=\"/contest/contests\";window.location.href=url;</script>";
        exit;
    }
    if($contest_visible=='0')
    {
        echo "<script>alert('该比赛已设置为隐藏！')</script>";
        echo "<script>url=\"/contest/contests\";window.location.href=url;</script>";
        exit;
    }
    if($passwd == "")
    {
        echo "<script>url=\"/contest/contest_page?contest_id=$contest_id\";window.location.href=url;</script>";
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
            echo "<a class=\"navbar-brand\" href=\"/contest/contest_page?contest_id=$contest_id\">$title</a>";
            ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
<!--                --><?php
//                echo "
//                <li class=\"reactive\"><a href=\"/contest/contest_page?contest_id=$contest_id\">۩ Home </a></li>
//                <li><a href=\"/contest/contest_problem?contest_id=$contest_id\">✎ Problems</a></li>
//                <li><a href=\"/contest/contest_statu?contest_id=$contest_id\"> ❖ Status</a></li>
//                <li><a href=\"/contest/contest_rank?contest_id=$contest_id\"> ➹ Rank</a></li>
//                ";
//                ?>
            </ul>
            <!--不同用户的导航栏-->
            <?php
            include "../pages/bar/index.php";
            ?>
            <!--不同用户的导航栏-->
        </div>
    </div>
</nav>
<!--导航栏-->



<!--登录注册-->
<?php
include "../pages/register_and_login/index.php";
?>
<!--登录注册-->



<!--主体-->

<article id="wrapper">
    <div class="container">
        <h3>
            该场比赛是私有比赛。请输入密码
        </h3>
        <form style="font-size:1.3em; margin-top:35px;" action="contest_page/index.php" method="post">

            <?php
            echo "<input type='text' name='contest_passwd' maxlength='20' class='form-control' size='20'>";
            echo "<input type='hidden' value='$contest_id' name='contest_id' maxlength='20'>";
            echo "<br>";
            echo " <button type=\"submit\" class=\"btn btn-default\">Submit</button>";
            ?>
        </form>
    </div>
    </div>
</article>
<!--主体-->

<!--页脚-->
<?php
include "../pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>