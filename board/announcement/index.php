<?php

date_default_timezone_set("PRC");
if( isset($_GET['id']) )
{
    $id = $_GET['id'];
}

include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
$conn->query("set names 'utf8'");
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$str = "select ann_visible from announcement where ann_id='$id'";
$result = $conn->query($str);
while (list($ann_visible) = $result->fetch_row())
{
    if($ann_visible=='0')
    {
        echo "<script>alert('您无权限访问此页面！')</script>";
        echo "<script>url=\"/\";window.location.href=url;</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Board|Excalibur OJ
    </title>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            margin-top: 30px;
            height: 220px;
            min-height: 300px;
            height: auto;
        }

        footer {
            clear: both;
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
            <a class="navbar-brand" href="/">Excalibur Online Judge</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li><a href="/">۩ Home </a></li>
                <li class="reactive"><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li><a href="/contest/contests"> ♛ Contests</a></li>
                <li><a href="/statu/status"> ❖ Status</a></li>
                <li><a href="/rank"> ➹ Rank</a></li>
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
<div class="container">
    <h3>
        Announcements
    </h3>
</div>

<article id="wrapper">
    <div class="container">
        <p style="font-size:1.3em; margin-top:35px;">
            <?php
            $str = "select ann_title,ann_text from announcement where ann_id='$id'";
            $result = $conn->query($str);
            while (list($ann_title, $ann_text) = $result->fetch_row()) {
                echo "<h3>"."$ann_title"."</h3>"."<br>";
                echo $ann_text;
            }
            $conn->close();
            $result->close();
            ?>
        </p>
    </div>
    </div>
</article>
<!--主体-->

<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
