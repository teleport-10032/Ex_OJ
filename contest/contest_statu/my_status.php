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
            echo "<a class=\"navbar-brand\" href=\"/contest/contest_page?contest_id=$contest_id&contest_passwd=$contest_passwd\">$title</a>";
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
<div class="container">
    <h3>
        <?php
        echo "
        <a href=\"/contest/contest_statu?contest_id=$contest_id&contest_passwd=$contest_passwd\">ALL Status</a>
        ";
        ?>
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
$sql = "select count(*) as amount from contest_status";
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
                    $str = "select submit_problem,submit_id,submit_when,contest_problem,submit_statu ,submit_time, submit_memory, submit_language,submit_length,submit_user_mail,user_name,user_cheat,user_judgement,user_permission from contest_status,user where submit_user_mail=user_mail and submit_contest='$contest_id'  and submit_user_mail='$user_mail' order by submit_id desc limit " . ($page - 1) * $page_size . "," . $page_size;
                    $result = $mysqli->query($str);
                    while (list($submit_problem,$submit_id, $submit_when, $contest_problem, $submit_statu, $submit_time, $submit_memory, $submit_language, $submit_length, $submit_user_mail,$user_name,$user_cheat,$user_judgement,$user_permission) = $result->fetch_row())
                    {
                        $cheat = $user_cheat;
                        $judgement = $user_judgement;
                        $permission = $user_permission;
                        echo "<tr>";
                        if ($submit_user_mail == $user_mail || isset($_SESSION['admin_mail']) || isset($_SESSION['teacher_mail'])) {
                            echo "<td><a href='../contest_statu_page?submit_id=$submit_id&contest_id=$contest_id&contest_passwd=$contest_passwd'>$submit_id</a></td>";
                        } else {
                            echo "<td>$submit_id"."</td>";
                        }
                        echo "
                                    <td>
                                    $submit_when
                                    </td>
                                    <td>
                                        <a href='/contest/contest_problem_page?contest_problem_id=$contest_problem&problem=$submit_problem&contest_id=$contest_id&contest_passwd=$contest_passwd'>$contest_problem</a>
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
                    if($page_count == $page)
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