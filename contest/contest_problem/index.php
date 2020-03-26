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

include '../../functions/conn.php';
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
                <li  class=\"reactive\"><a href=\"/contest/contest_problem?contest_id=$contest_id&contest_passwd=$contest_passwd\">✎ Problems</a></li>
                <li><a href=\"/contest/contest_statu?contest_id=$contest_id&contest_passwd=$contest_passwd\"> ❖ Status</a></li>
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
        Problems
    </h3>
</div>


<!--主体-->
<article id="wrapper">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            AC
                        </th>
                        <th>
                            AC Rate
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $mysqli = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                    if (mysqli_connect_errno()) {
                        exit('连接失败');
                    }
                    $mysqli->query("set names 'utf8'");
                    $str = "select contest_problem from contest where contest_id='$contest_id'";
                    $result = $mysqli->query($str);
                    $cnt = 'A';
                    while (list($problems) = $result->fetch_row())
                    {
                        $problems_array = explode(".",$problems);
                        for($i = 0 ; $i < count($problems_array) ; $i ++)
                        {
                            $str = "select problem_title from problem where problem_id='$problems_array[$i]'";
                            $result1 = $mysqli->query($str);
                            while (list( $problem_title) = $result1->fetch_row())
                            {
                                $mysqli1 = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                                if (mysqli_connect_errno()) {
                                    exit('连接失败');
                                }
                                $str1 = "select count(*) from contest_status where submit_contest=$contest_id and contest_problem='$cnt'";
//                                echo $str1;
                                $result1 = $mysqli1->query($str1);
                                echo $mysqli1->error;
                                list($total) = $result1->fetch_row();


                                $str2 = "select count(*) from contest_status where submit_contest=$contest_id and submit_statu='Accepted' and contest_problem='$cnt' ";
                                $result2 = $mysqli1->query($str2);
                                list($problem_AC) = $result2->fetch_row();

                                if ($total == 0)
                                    $AC = 0;
                                else
                                    $AC = $problem_AC / $total * 100;
                                $AC = round($AC,2);
                                echo "<tr> <td>$cnt</td> <td><a href='/contest/contest_problem_page?contest_problem_id=$cnt&problem=$problems_array[$i]&contest_id=$contest_id&contest_passwd=$contest_passwd'>$problem_title</a></td>
                                <td>$total</td>
                                <td>$problem_AC</td>
                                <td>$AC%</td>";
                            }
                            $cnt ++;
                        }
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!--    <div class="pagination pagination-right" id="page">-->
<!--        <ul class="pagination">-->
<!--            --><?php
//            $pre = $page - 1;
//            $nex = $page + 1;
//            if ($page != 1)
//                echo "<li> <a href=/problem/problems?page=$pre><</a></li>";
//            else
//                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
//            for ($i = 1; $i <= $page_count; $i++)
//                if ($i == $page)
//                    echo "<li> <a href=/problem/problems?page=$i><b><i>$i</i></b></a></li>";
//                else
//                    echo "<li> <a href=/problem/problems?page=$i>$i</a></li>";
//            if ($page != $page_count)
//                echo "<li> <a href=/problem/problems?page=$nex>></a></li>";
//            else
//                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\">></i></a></li>";
//            ?>
<!--        </ul>-->
<!--    </div>-->

</article>
<!--主体-->

<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>