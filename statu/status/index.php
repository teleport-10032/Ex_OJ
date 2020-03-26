<?php
session_start();
date_default_timezone_set("PRC");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Status|Excalibur OJ</title>

    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/problem.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            height: 940px;
            min-height: 300px;
            height: auto;
        }

        #page {
            float: right;
            94
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
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Excalibur Online Judge</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li><a href="/contest/contests"> ♛ Contests</a></li>
                <li class="reactive"><a href="/statu/status"> ❖ Status</a></li>
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
        <a href="/statu/status/user_status.php">My Status</a>
    </h3>
</div>


<?php
include '../../functions/conn.php';
$mysqli = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (mysqli_connect_errno()) {
    exit('连接失败');
}
$mysqli->query("set names 'utf8'");
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}
$page_size = 10;
$sql = "select count(*) as amount from status";
$result = $mysqli->query($sql);
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
//是否是风纪委员
$sql = "select user_judgement from user where user_mail='$user_mail'";
$mysqli->query("set names 'utf8'");
$result = $mysqli->query($sql);
while (list($perm) = $result->fetch_row())
{
    $per = $perm;
}
$user_mail = "";
if (isset($_SESSION['admin_name'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
} else if (isset($_SESSION['teacher_mail'])) {
    $user_mail = $_SESSION['teacher_mail'];
    $user_name = $_SESSION['teacher_name'];
    $flag = 0;
} else if (isset($_SESSION['LV0_mail'])) {
    $user_mail = $_SESSION['LV0_mail'];
    $user_name = $_SESSION['LV0_name'];
    $flag = 0;
} else if (isset($_SESSION['LV1_mail'])) {
    $user_mail = $_SESSION['LV1_mail'];
    $user_name = $_SESSION['LV1_name'];
    $flag = 0;
} else if (isset($_SESSION['LV2_mail'])) {
    $user_mail = $_SESSION['LV2_mail'];
    $user_name = $_SESSION['LV2_name'];
    $flag = 0;
} else if (isset($_SESSION['LV3_mail'])) {
    $user_mail = $_SESSION['LV3_mail'];
    $user_name = $_SESSION['LV3_name'];
    $flag = 0;
} else if (isset($_SESSION['LV4_mail'])) {
    $user_mail = $_SESSION['LV4_mail'];
    $user_name = $_SESSION['LV4_name'];
    $flag = 0;
} else if (isset($_SESSION['LV5_mail'])) {
    $user_mail = $_SESSION['LV5_mail'];
    $user_name = $_SESSION['LV5_name'];
    $flag = 0;
} else if (isset($_SESSION['LV6_mail'])) {
    $user_mail = $_SESSION['LV6_mail'];
    $user_name = $_SESSION['LV6_name'];
    $flag = 0;
}
?>

<article id="wrapper">

    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            When
                        </th>
                        <th style="width: 15%;">
                            Problem
                        </th>
                        <th>
                            Statu
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Memory
                        </th>
                        <th>
                            Language
                        </th>
                        <th>
                            Length
                        </th>
                        <th>
                            Author
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $str = "select submit_id,submit_when,submit_problem,submit_statu ,submit_time, submit_memory, submit_language,submit_length,submit_user_mail,user_name,user_cheat,user_judgement,user_permission from status,user where submit_user_mail=user_mail  order by submit_id desc limit " . ($page - 1) * $page_size . "," . $page_size;
                    $mysqli->query("set names 'utf8'");
                    $result = $mysqli->query($str);
                    while (list($submit_id, $submit_when, $submit_problem, $submit_statu, $submit_time, $submit_memory, $submit_language, $submit_length, $submit_user_mail,$user_name,$user_cheat,$user_judgement,$user_permission) = $result->fetch_row())
                    {
                        $cheat = $user_cheat;
                        $judgement = $user_judgement;
                        $permission = $user_permission;
                        echo "<tr>";
                        if ($submit_user_mail == $user_mail || isset($_SESSION['admin_mail']) || isset($_SESSION['teacher_mail']) || $per==1)
                        {
                            echo "<td><a href='../statu_page?id=$submit_id'>$submit_id</a></td>";
                        } else {
                            echo "<td>$submit_id"."</td>";
                        }
                        echo "
                                    <td>
                                    $submit_when
                                    </td>
                                    <td>
                                        <a href='/problem/problem_page?id=$submit_problem'>$submit_problem</a>
                                    </td>
                                    ";
                                if($submit_statu == 'Accepted')
                                    echo "<td>
                                            <span class='label label-success' >$submit_statu</span>
                                           </td>";
                                else if($submit_statu == "Queueing")
                                {
                                    echo "<td>
                                            <span class='label label-warning' >$submit_statu</span>
                                           </td>";
                                }
                                else if($submit_statu == "Compile Error")
                                {
                                    echo "<td>
                                            <span class='label label-warning' >$submit_statu</span>
                                           </td>";
                                }
                                else
                                {
                                    echo "<td>
                                            <span class='label label-danger' >$submit_statu</span>
                                           </td>";
                                }

                                    echo "
                                    <td>
                                        $submit_time
                                        ms
                                    </td>
                                    <td>
                                        $submit_memory
                                        KB
                                    </td>
                                    <td>
                                        $submit_language
                                    </td>
                                    <td>
                                        $submit_length
                                    </td>
                                    <td>";
                        //用户名字颜色
                        if($cheat == 1)
                            echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #8B4513' >$user_name</a>";
                        else
                        {
                            if($judgement == 1)
                                echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #48D1CC' >$user_name</a>";
                            else
                            {
                                if($permission == 'LV0')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #ADADAD' >$user_name</a>";
                                else if($permission == 'LV1')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #000000' >$user_name</a>";
                                else if($permission == 'LV2')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #73BF00' >$user_name</a>";
                                else if($permission == 'LV3')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #0000E3' >$user_name</a>";
                                else if($permission == 'LV4')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #FF9224' >$user_name</a>";
                                else if($permission == 'LV5')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #DC143C' >$user_name</a>";
                                else if($permission == 'LV6')
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #800080' >$user_name</a>";
                                else
                                    echo "<a href='/pages/user_index?mail=$submit_user_mail' style='color: #000000' ><i>$user_name</i></a>";
                            }

                        }
                        //用户名字颜色
                        echo "</td>
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
                    $result->close();
                    $mysqli->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="pagination pagination-right" id="page">
        <ul class="pagination">
            <?php
            $pre = $page - 1;
            $nex = $page + 1;
            if($page != 1)
                echo "<li> <a href=/statu/status?page=$pre><</a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
            for ($i = 1; $i <= $page_count; $i++)
                if ($i == $page)
                    echo "<li> <a href=/statu/status?page=$i><b><i>$i</i></b></a></li>";
                else
                    echo "<li> <a href=/statu/status?page=$i>$i</a></li>";
            if($page != $page_count)
                echo "<li> <a href=/statu/status?page=$nex>></a></li>";
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
</html>