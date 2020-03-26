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
                <li><a href=\"/contest/contest_statu?contest_id=$contest_id&contest_passwd=$contest_passwd\"> ❖ Status</a></li>
                <li  class=\"reactive\"><a href=\"/contest/contest_rank?contest_id=$contest_id&contest_passwd=$contest_passwd\"> ➹ Rank</a></li>
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



<!--    主体-->
<div class="container" id="title">

    <h3>
        Rank
    </h3>
</div>
<article id="wrapper" style="height: 100%;">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            Ranking
                        </th>
                        <th>
                            user
                        </th>
                        <th>
                            solved
                        </th>
                        <th>
                            time_cost
                        </th>
                        <?php
                        $mysqli = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                        // 检测连接
                        if (!$mysqli) {
                            die("连接失败: " . $mysqli->connect_error);
                        }

                        $str = "select contest_problem from contest where contest_id='$contest_id'";
                        $result = $mysqli->query($str);
                        $cnt = 'A';
                        while (list($problems) = $result->fetch_row())
                        {
                            $problems_array = explode(".",$problems);
                            for($i = 0 ; $i < count($problems_array) ; $i ++)
                            {
                                echo "<th>$cnt</th>";
                                if($i != count($problems_array)-1)
                                    $cnt ++;

                            }
                        }
                        ?>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $mysqli->query("set names 'utf8'");
                    $str = "select distinct user_name,user_mail from contest_status,user where submit_contest='$contest_id'  and submit_user_mail=user_mail";
                    $result = $mysqli->query($str);
                    $ranking = 1;

                    //第一遍循环，计算出每个用户的做题数量，耗费时间，连同用户邮箱一起存数组
                    $struct = [505][3];
                    $s_cnt = 0;
                    //对于参加该场比赛的每一个用户
                    while (list($user_name,$user_mail) = $result->fetch_row())
                    {
                        $str1 = "select contest_problem,submit_statu,submit_when from contest_status where submit_contest='$contest_id'  and submit_user_mail='$user_mail'";
                        $result1 = $mysqli->query($str1);

                        //该比赛的开始时间
                        $str2 = "select contest_start_time from contest where contest_id='$contest_id'";
                        $result2 = $mysqli->query($str2);
                        while (list($start_time) = $result2->fetch_row())
                        {
                            $contest_start_time = $start_time;
                        }
                        //总耗费时间
                        $time_cost_num = 0;
                        //存储每个题目耗费的时间
                        $time_cost= [100];
                        //存储每个题目是否做出来
                        $problem_statu=[100];
                        //存储每个题目的错误次数
                        $wrong_times = [100];

                        for($i = 0 ; $i < 100 ; $i ++)
                        {
                            $time_cost[$i] = 0;
                            $wrong_times[$i] = 0;
                            $problem_statu[$i]=0;
                        }

                        //对于该用户的每一个提交记录
                        while (list($problem,$statu,$when) = $result1->fetch_row())
                        {
                            $num  = 0;
                            //对于该用户提交的每一个题目
                            for($i = 'A' ; $i <= $cnt ; $i ++)
                            {
//                                echo "$i"."<br>";
                                if($problem == $i)
                                {
                                    if($statu == "Accepted")
                                    {
                                        $time_cost[$num] += (strtotime($when) - strtotime($contest_start_time));
                                        $problem_statu[$num] = 1;
                                    }
                                    else if($statu != 'Queueing' && $statu != "Compile Error")
                                    {
                                        $wrong_times[$num] += 1;
                                        $time_cost[$num] += 1200;
                                    }
                                }
                                $num ++;
                            }
                        }

                        $solved = 0;
                        //计算作出的题目数量
                        for($i = 0; $i < count($problem_statu) ; $i ++)
                            if($problem_statu[$i] == 1)
                                $solved ++;

                        //计算总时间
                        for($i = 0; $i < count($problem_statu) ; $i ++)
                            if($problem_statu[$i] == 1)
                                $time_cost_num += $time_cost[$i];


                        $struct[$s_cnt][0] = $user_mail;
                        $struct[$s_cnt][1] = $solved;
                        $struct[$s_cnt][2] = $time_cost_num;
                        $s_cnt ++;
                    }
                    $s_cnt -= 1;
//                    for($i = 0 ; $i <= $s_cnt ; $i ++)
//                        echo $struct[$i][0]." ".$struct[$i][1]." ".$struct[$i][2]."!<br>";


//                    $data = [1005];
//                    $data[0] = array('mail' => 'qq.com','volume' => 67, 'edition' => 122);
//                    $data[1] = array('mail' => 'qq.com','volume' => 86, 'edition' => 10);
//                    $data[2] = array('mail' => 'qq.com','volume' => 85, 'edition' => 6);
//                    $data[3] = array('mail' => 'qq.com','volume' => 98, 'edition' => 2);
//                    $data[4] = array('mail' => 'qq.com','volume' => 86, 'edition' => 6);
//                    $data[5] = array('mail' => 'qq.com','volume' => 67, 'edition' => 7);
//                    $data[6] = array('mail' => 'qq.com','volume' => 67, 'edition' => 6);
//
//                    foreach($data as $key=>$val)
//                    {
//                        $mail[$key]=$val['mail'];
//                        echo $mail[$key]. " ";
//                        $volume[$key]=$val['volume'];
//                        echo $volume[$key]. " ";
//                        $edition[$key] = $val['edition'];
//                        echo  $edition[$key]."<br>";
//                    }
//
//                    array_multisort($volume,SORT_DESC,$edition,SORT_ASC,$data);
//
//
//                    echo "<br><br><br><br>";
//                    foreach($data as $key=>$val)
//                    {
//                        echo $mail[$key]. " ";
//                        echo $volume[$key]. " ";
//                        echo  $edition[$key]."<br>";
//                    }

                    $data = [1005];

                    for($i = 0 ; $i <= $s_cnt ; $i ++)
                    {
                        $data[$i] = array('mail' => $struct[$i][0] ,'solve' => $struct[$i][1], 'time' => $struct[$i][2]);
                    }
                    foreach($data as $key=>$val)
                    {
                        $mail[$key]=$val['mail'];
//                        echo $mail[$key]. " ";
                        $solve[$key]=$val['solve'];
//                        echo $solve[$key]. " ";
                        $time[$key] = $val['time'];
//                        echo  $time[$key]."<br>";
                    }

//                    for($i = 0 ; $i <= $s_cnt ; $i ++)
//                        echo $struct[$i][0]." ".$struct[$i][1]." ".$struct[$i][2]."!<br>";

                    array_multisort($solve,SORT_DESC,$time,SORT_ASC,$mail,SORT_ASC,$data);


                    //                    for($i = 0 ; $i <= $s_cnt ; $i ++)
                    //                        echo $struct[$i][0]." ".$struct[$i][1]." ".$struct[$i][2]."!<br>";
                    $i = 0;
                    foreach($data as $key=>$val)
                    {
                        $struct[$i][0] = $mail[$key];
                        $struct[$i][1] = $solve[$key];
                        $struct[$i][2] = $time[$key];
                        $i ++;
                    }
//                                        for($i = 0 ; $i <= $s_cnt ; $i ++)
//                                            echo $struct[$i][0]." ".$struct[$i][1]." ".$struct[$i][2]."!<br>";
                    //模拟结排

//                    void BubbleSort(int arr[], int n)
//                    {
//                        for (int i = 0; i < n - 1; i++)
//                        {
//                            for (int j = 0; j < n - i - 1; j++)
//                                {
//                                    if (arr[j] > arr[j + 1])
//                                    {
//                                        int temp = arr[j];
//                                                arr[j] = arr[j + 1];
//                                                arr[j + 1] = temp;
//                                            }
//                                }
//                             }
//                    }

//                    for($i = 0 ; $i < $s_cnt  ;$i ++)
//                        for($j = 0; $j < $s_cnt -$i  ;$j++)
//                            if($struct[$j][1] < $struct[$j+1][1])
//                            {
//                                $tem = $struct[$j][1];
//                                $struct[$j][1] = $struct[$j+1][1];
//                                $struct[$j+1][1] = $tem;
//
//                                $tem = $struct[$j][0];
//                                $struct[$j][0] = $struct[$j+1][0];
//                                $struct[$j+1][0] = $tem;
//
//                                $tem = $struct[$j][2];
//                                $struct[$j][2] = $struct[$j+1][2];
//                                $struct[$j+1][2] = $tem;
//                            }


                    ?>







                    <?php

                    //开始显示
                    $mysqli->query("set names 'utf8'");


                    $ranking = 1;
                    //对于参加该场比赛的每一个用户
                    for($j = 0 ; $j <= $s_cnt ; $j ++)
                    {
                        $mail = $struct[$j][0];
                        $str = "select distinct user_name,user_mail from contest_status,user where submit_contest='$contest_id'  and submit_user_mail=user_mail and user_mail='$mail'";
                        $result = $mysqli->query($str);
                        while (list($user_name,$user_mail) = $result->fetch_row())
                        {
                            $str1 = "select contest_problem,submit_statu,submit_when from contest_status where submit_contest='$contest_id'  and submit_user_mail='$user_mail' order by submit_when";
                            $result1 = $mysqli->query($str1);

                            //该比赛的开始时间
                            $str2 = "select contest_start_time from contest where contest_id='$contest_id'";
                            $result2 = $mysqli->query($str2);
                            while (list($start_time) = $result2->fetch_row())
                            {
                                $contest_start_time = $start_time;
                            }

                            echo "<tr>";
                            echo "<td>$ranking</td>";
                            echo "<td>";
                            //用户名字颜色
                            if($cheat == 1)
                                echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #8B4513' >$user_name</a>";
                            else
                            {
                                if($judgement == 1)
                                    echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #48D1CC' >$user_name</a>";
                                else
                                {
                                    if($permission == 'LV0')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #ADADAD' >$user_name</a>";
                                    else if($permission == 'LV1')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #000000' >$user_name</a>";
                                    else if($permission == 'LV2')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #73BF00' >$user_name</a>";
                                    else if($permission == 'LV3')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #0000E3' >$user_name</a>";
                                    else if($permission == 'LV4')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #FF9224' >$user_name</a>";
                                    else if($permission == 'LV5')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #DC143C' >$user_name</a>";
                                    else if($permission == 'LV6')
                                        echo "<a href='/pages/user_index?mail=$user_mail'  style='color: #800080' >$user_name</a>";
                                    else
                                        echo "<a href='/pages/user_index?mail=$user_mail' style='color: #000000' ><i>$user_name</i></a>";
                                }

                            }
                            //用户名字颜色

                            echo "</td>";

                            //总耗费时间
                            $time_cost_num = 0;
                            //存储每个题目耗费的时间
                            $time_cost= [100];
                            //存储每个题目是否做出来
                            $problem_statu=[100];
                            //存储每个题目的错误次数
                            $wrong_times = [100];


                            for($i = 0 ; $i < 100 ; $i ++)
                            {

                                $time_cost[$i] = 0;
                                $wrong_times[$i] = 0;
                                $problem_statu[$i]=0;
                            }

                            //对于该用户的每一个提交记录
                            while (list($problem,$statu,$when) = $result1->fetch_row())
                            {
                                $num  = 0;
                                //如果该记录是某个题目
                                for($i = 'A' ; $i <= $cnt ; $i ++)
                                {
//                                echo "$i"."<br>";
                                    if($problem == $i)
                                    {
                                        if($statu == "Accepted" && $problem_statu[$num] != 1)
                                        {
//                                            echo "$when"."<br>";
//                                            echo "$contest_start_time"."<br>";
                                            $time_cost[$num] += (strtotime($when) - strtotime($contest_start_time));
                                            $problem_statu[$num] = 1;
                                        }
                                        else if($statu != 'Queueing' && $statu != "Compile Error" && $problem_statu[$num] != 1)
                                        {
                                            $wrong_times[$num] += 1;
                                            $time_cost[$num] += 1200;
                                        }
                                    }
                                    $num ++;
                                }
                            }

                            $solved = 0;
                            //计算作出的题目数量
                            for($i = 0; $i < count($problem_statu) ; $i ++)
                                if($problem_statu[$i] == 1)
                                    $solved ++;

                            echo "<td>$solved</td>";
                            //计算总时间
                            for($i = 0; $i < count($problem_stat) ; $i ++)
                                if($problem_statu[$i] == 1)
                                    $time_cost_num += $time_cost[$i];

                            $time = $time_cost_num;
                            $hour = (int)(($time/3600));
                            $min = (int)($time%(3600)/60);
                            $sec = (int)($time%60);
                            echo "<td>";
                            if($hour != 0)
                            {
                                echo "$hour"; echo ":";
                            }
                            else
                            {
                                echo "0:";
                            }

                            if($min != 0)
                            {
                                echo $min; echo ":";
                            }
                            else
                            {
                                echo "0:";
                            }
                            if($sec != 0)
                            {
                                echo $sec;
                            }
                            if($hour == 0 && $min == 0 && $sec == 0)
                            {
                                echo 0;
                            }
                            echo "</td>";


                            //每个题目所用时间
                            for($i = 0; $i < $num ; $i ++)
                                if($problem_statu[$i] == 1)
                                {
                                    $time = $time_cost[$i];
                                    $hour = (int)(($time/3600));
                                    $min = (int)($time%(3600)/60);
                                    $sec = (int)($time%60);
                                    echo "<td style='background:springgreen;'>";
                                    if($hour != 0)
                                    {
                                        echo "$hour"; echo ":";
                                    }
                                    else
                                    {
                                        echo "0:";
                                    }
                                    if($min != 0)
                                    {
                                        echo $min; echo ":";
                                    }
                                    else
                                    {
                                        echo "0:";
                                    }
                                    if($sec != 0)
                                    {
                                        echo $sec;
                                    }
                                    if($wrong_times[$i] != 0 && $problem_statu[$i] != 0)
                                        echo "(-$wrong_times[$i])";
                                    echo "</td>";

                                }
                                else
                                {
                                    if($wrong_times[$i] != 0)
                                        echo "<td style='background: red'>-$wrong_times[$i]</td>";
                                    else
                                        echo "<td></td>";
                                }

                            echo "</tr>";
                            $ranking++;
                        }
                    }


                    ?>

                    </tbody>
                </table>
            </div>
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
</html>