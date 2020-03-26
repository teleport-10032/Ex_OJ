<?php
session_start();
date_default_timezone_set("PRC");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Problem|Excalibur OJ</title>

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

        footer {
            clear: both;
        }

        #page {
            float: right;
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

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li class="reactive"><a href="/problem/problems">✎ Problems</a></li>
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
        Problems List
        <form class="navbar-form navbar-right" action="problem_search/index.php" method="post" role="search">
            <div class="form-group">
                <input type="text" name= "search" class="form-control" placeholder="输入标题或ID进行查找...">
            </div>
            <button type="submit" class="btn btn-default">检索！</button>
        </form>
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
    $page = $_GET['page'];
} else {
    $page = 1;
}
$page_size = 3;
$sql = "select count(*) as amount from problem where problem_visible='1'";
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
                            ID
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
                        <th>
                            Author
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $str = "select problem_id,problem_title,problem_AC,problem_WA,problem_CE,problem_PE,problem_TLE,problem_MLE,problem_RE,user_name,user_mail from problem,user  where user_id=problem_author and problem_visible='1' order by problem_id limit " . ($page - 1) * $page_size . "," . $page_size;
                    $result = $mysqli->query($str);
                    while (list($problem_id, $problem_title, $problem_AC, $problem_WA, $problem_CE, $problem_PE, $problem_TLE, $problem_MLE, $problem_RE,$user_name,$user_mail2) = $result->fetch_row())
                    {
                        $total = ($problem_AC + $problem_WA + $problem_CE + $problem_PE + $problem_TLE + $problem_MLE + $problem_RE);
                        if ($total == 0)
                            $AC = 0;
                        else
                            $AC = $problem_AC / $total * 100;
                        $AC = round($AC,2);

                        $str1 = "select user_accept from user where user_mail='$user_mail'";
                        $result1 = $mysqli->query($str1);
                        while(list($accpet)  = $result1->fetch_row())
                        {
                            $user_accept = $accpet;
                        }

                        $problems_array = explode(".",$user_accept);
                        $flag = 1;
                        for($j = 0 ; $j < count($problems_array) ; $j ++)
                        {
//                            echo $problems_array[$j]."<br>";
                            if($problems_array[$j] == $problem_id)
                            {
                                $flag = 0;
                            }
                        }
                            if($flag == 1)
                            {
                                echo "<tr> <td></td></td><td>$problem_id</td> <td><a href='/problem/problem_page?id=$problem_id'>$problem_title</a></td><td>$total</td><td>$problem_AC</td>
                                <td>$AC%</td>
                                <td><a href='/pages/user_index?mail=$user_mail2'>$user_name</a></td></tr>";
                            }
                            else
                            {
                                echo "<tr> <td>
                                      <span class='label label-success' >Solved</span>
                                     </td></td><td>$problem_id</td> <td><a href='/problem/problem_page?id=$problem_id'>$problem_title</a></td><td>$total</td><td>$problem_AC</td>
                                <td>$AC%</td>
                                <td><a href='/pages/user_index?mail=$user_mail2'>$user_name</a></td></tr>";
                            }

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
            if ($page != 1)
                echo "<li> <a href=/problem/problems?page=$pre><</a></li>";
            else
                echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
            for ($i = 1; $i <= $page_count; $i++)
                if ($i == $page)
                    echo "<li> <a href=/problem/problems?page=$i><b><i>$i</i></b></a></li>";
                else
                    echo "<li> <a href=/problem/problems?page=$i>$i</a></li>";
            if ($page != $page_count)
                echo "<li> <a href=/problem/problems?page=$nex>></a></li>";
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