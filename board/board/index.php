<?php
date_default_timezone_set("PRC");
session_start();
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

        table {
            font-weight: lighter;
        }

        table a {
            color: #333333;
            font-weight: lighter;
        }

        table a:hover {
            color: #31a8f6;
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
                <li class="reactive"><a href="">◄): Board</a></li>
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


<!--计算页数-->
<?php
include '../../functions/conn.php';

$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
$conn->query("set names 'utf8'");
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$page_size = 5;
$sql = "select count(*) as amount from announcement where ann_visible!='0'";
$result = $conn->query($sql);
list($amount) = $result->fetch_row();
if ($amount) {
    if ($amount < $page_size) {
        $page_count = 1;
    } else if ($amount % $page_size) {
        $page_count = (int)($amount / $page_size) + 1;
    } else {
        $page_count = $amount / $page_size;
    }
} else {
    $page_count = 0;
}
?>

<!--主体-->
<div class="container">

    <h3>
        Announcements
    </h3>
</div>
<article id="wrapper">
    <div class="container">
        <table style="margin-top:20px;">
            <?php
            $str = "select ann_id,ann_title,ann_time,ann_author,user_name,user_mail from announcement,user where ann_author=user_id and ann_visible!='0' order by ann_time limit " . ($page - 1) * $page_size . "," . $page_size;
            $result = $conn->query($str);
            while (list($ann_id, $ann_title, $ann_time, $ann_author,$user_name,$user_mail) = $result->fetch_row())
            {
                    echo "<tr> <td><a href='../announcement?id=$ann_id&page=$page'>$ann_title</a></td>
                                    <td>$ann_time</td>
                        <td><a href='/pages/user_index?mail=$user_mail'>By $user_name</a></td>
                        </tr>";

            }
            if($page_count == $page && $page != 1)
            {

                if($amount % $page_size != 0)
                {
                    $y = $page_size - $amount % $page_size;
                    for($i = 1 ; $i <= $y ; $i ++)
                        echo "<tr>  </tr>";
                }
            }
            ?>
        </table>
    </div>

    <?php
    $result->close();
    $conn->close();
    ?>

    <div class="page" style="margin-top:30px;">
        <ul class="pagination">
            <?php
            $pre = $page - 1;
            $nex = $page + 1;
            if($page != 1)
                echo "<li> <a href=/board/board?page=$pre><</a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
            for ($i = 1; $i <= $page_count; $i++)
                if ($i == $page)
                    echo "<li> <a href=/board/board?page=$i><b><i>$i</i></b></a></li>";
                else
                    echo "<li> <a href=/board/board?page=$i>$i</a></li>";
            if($page != $page_count)
                echo "<li> <a href=/board/board?page=$nex>></a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\">></i></a></li>";
            ?>
        </ul>
    </div>


</article>
<!--主体-->


<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
