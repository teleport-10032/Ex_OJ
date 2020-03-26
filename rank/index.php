<?php
session_start();
date_default_timezone_set("PRC");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Rank|Excalibur OJ</title>
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/problem.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            min-height: 300px;
            height: auto;
        }
    </style>
</head>
<body>

<!--导航栏-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
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

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li><a href="/contest/contests"> ♛ Contests</a></li>
                <li><a href="/statu/status"> ❖ Status</a></li>
                <li class="reactive"><a href="/rank"> ➹ Rank</a></li>
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


<!--    主体-->
<div class="container" id="title">

    <h3>
        Rank
    </h3>
</div>

<?php
include '../functions/conn.php';
$mysqli = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (mysqli_connect_errno()) {
    exit('连接失败');
}
$mysqli->query("set names 'utf8'");
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$page_size = 20;
$sql = "select count(*) as amount from user";
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
                            AC
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Rating
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $str = "select user_mail,user_name,user_AC_NUM,user_ALL_NUM,user_cheat,user_judgement,user_permission from user order by user_AC_NUM desc,user_ALL_NUM asc limit " . ($page - 1) * $page_size . "," . $page_size;;
                    $result = $mysqli->query($str);
                    echo $mysqli->error;
                    $cnt = 1;
                    while (list($user_mail,$user_name, $user_AC_NUM, $user_ALL_NUM,$user_cheat,$user_judgement,$user_permission) = $result->fetch_row())
                    {
                        $rank = $cnt + ($page - 1) * $page_size;
                        $cheat = $user_cheat;
                        $judgement = $user_judgement;
                        $permission = $user_permission;
                        if ($user_ALL_NUM == 0)
                            $AC = 0;
                        else
                            $AC = ($user_AC_NUM / $user_ALL_NUM) * 100;
                        echo " 
                                    <td>
                                       $rank
                                    </td>
                                    <td>";
                        $AC = round(($AC),2);
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


                        echo      "</td>
                                    <td>
                                        $user_AC_NUM
                                    </td>
                                    <td>
                                        $user_ALL_NUM
                                    </td>
                                    <td>
                                        $AC%
                                    </td>
                                </tr>";

                        $cnt++;
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
                echo "<li> <a href=/rank?page=$pre><</a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
            for ($i = 1; $i <= $page_count; $i++)
                if ($i == $page)
                    echo "<li> <a href=/rank?page=$i><b><i>$i</i></b></a></li>";
                else
                    echo "<li> <a href=/rank?page=$i>$i</a></li>";
            if($page != $page_count)
                echo "<li> <a href=/rank?page=$nex>></a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\">></i></a></li>";
            ?>
        </ul>
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