<?php

date_default_timezone_set("PRC");
session_start();
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
            <a class="navbar-brand" href="/">Excalibur Online Judge</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li class="reactive"><a href="/contest/contests"> ♛ Contests</a></li>
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
        Contests
    </h3>
</div>
<article id="wrapper">
    <div class="panel-body">

<!---->
<!--        <nav class="navbar navbar-default" role="navigation"-->
<!--             style="border:0px;background-color: white;box-shadow:0px 0px 0px 0px #666;">-->
<!--            <div class="container-fluid">-->
<!--                <div class="navbar-header">-->
<!--                </div>-->
<!--                <div>-->
<!--                    <form class="navbar-form navbar-right" role="search">-->
<!--                        <div class="form-group">-->
<!--                            <input type="text" class="form-control" placeholder="Search">-->
<!--                        </div>-->
<!--                        <button type="submit" class="btn btn-default">查找</button>-->
<!--                    </form>-->
<!--                    <ul class="nav navbar-nav navbar-right">-->
<!--                        <li class="dropdown">-->
<!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                                Status <b class="caret"></b>-->
<!--                            </a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a href="#">all</a></li>-->
<!--                                <li><a href="#">underway</a></li>-->
<!--                                <li><a href="#">not start</a></li>-->
<!--                                <li><a href="#">ended</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </nav>-->


        <?php
        date_default_timezone_set("PRC");
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
        $page_size = 3;
        $sql = "select count(*) as amount from contest where contest_visible!='0'";
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
        ?>

        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Start
                            </th>
                            <th>
                                Duration
                            </th>
                            <th>
                                Problems
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Author
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $str = "select contest_id,contest_title,contest_start_time,contest_end_time,user_name,user_mail,contest_problem from contest,user where contest_author=user_id and contest_visible!='0' order by contest_id desc  limit " . ($page - 1) * $page_size . "," . $page_size;
                        $result = $mysqli->query($str);
                        while (list($contest_id, $contest_title, $contest_start_time, $contest_end_time,$user_name,$user_mail,$contest_problem) = $result->fetch_row())
                        {

                            $problems_array = explode(".",$contest_problem);
                            $problem_count = count($problems_array);
                            echo "<tr> <td> <a href='/contest/passwd_judge.php?contest_id=$contest_id' target='_blank'>$contest_title</a> </td>
                                        <td>$contest_start_time</td>";


                            $time = strtotime($contest_end_time)-strtotime($contest_start_time);
                            $day = (int)($time/(3600*24));
                            $hour = (int)(($time%(3600*24))/(3600));
                            $min = (int)($time%(3600)/60);
                            echo "<td>";
                            if($day != 0)
                            {
                                echo "$day"; echo "天";
                            }
                            if($hour != 0)
                            {
                                echo $hour; echo "小时";
                            }
                            if($min != 0)
                            {
                                echo $min;echo "分";
                            }

                                echo "</td>";
                            date_default_timezone_set("PRC");
                            $now = time();
                            echo"
                                         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$problem_count&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
//                            echo "!!"."<br>";
//                            echo strtotime($contest_start_time);echo "<br>";
//                            echo strtotime($now);echo "<br>";
//                            echo strtotime($contest_end_time);echo "<br>";
//                            echo "!!"."<br>";

                            if(strtotime($contest_start_time)>$now)
                            {
                                echo "<td><span class='label label-warning' >Not started</span></td>";
                            }
                            if(strtotime($contest_start_time)<$now && strtotime($contest_end_time)>$now){
                                echo "<td><span class='label label-success' >Running</span></td>";
                            }
                            if(strtotime($contest_end_time)<$now)
                            {
                                echo "<td><span class='label label-danger' >Ended</span></td>";
                            }
                            echo "
                                <td><a href='/pages/user_index?mail=$user_mail'>$user_name</a></td></tr>";
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
                    echo "<li> <a href=/contest/contests?page=$pre><</a></li>";
                else
                    echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
                for ($i = 1; $i <= $page_count; $i++)
                    if ($i == $page)
                        echo "<li> <a href=/contest/contests?page=$i><b><i>$i</i></b></a></li>";
                    else
                        echo "<li> <a href=/contest/contests?page=$i>$i</a></li>";
                if($page != $page_count)
                    echo "<li> <a href=/contest/contests?page=$nex>></a></li>";
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