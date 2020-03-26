<?php
session_start();
date_default_timezone_set("PRC");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <meta charset="UTF-8">
    <title>Home|Excalibur OJ</title>

    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <style type="text/css">
        article {
            margin-top: 50px;
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
                <li class="reactive"><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li><a href="/contest/contests"> ♛ Contests</a></li>
                <li><a href="/statu/status"> ❖ Status</a></li>
                <li><a href="/rank"> ➹ Rank</a></li>
            </ul>

            <!--不同用户的导航栏-->
            <?php
            include "pages/bar/index.php";
            ?>
            <!--不同用户的导航栏-->

        </div>
    </div>
</nav>
<!--导航栏-->

<!--登录注册-->
<?php
include "pages/register_and_login/index.php";
?>
<!--登录注册-->

<!--主体-->
<article id="wrapper">
    <div class="carousel slide" id="carousel-845389" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-slide-to="0" data-target="#carousel-845389">
            </li>
            <li data-slide-to="1" data-target="#carousel-845389">
            </li>
            <li data-slide-to="2" data-target="#carousel-845389" class="active">
            </li>
        </ol>
        <div class="carousel-inner">
            <div class="item">
                <img alt="" src="/images/index/1.jpg"/>
                <div class="carousel-caption">
                    <h4>
                        ACM International Collegiate Programming Contest
                    </h4>
                    <p>
                        国际大学生程序设计竞赛(ACM International Collegiate Programming
                        Contest简称ACM-ICPC或ICPC)是由国际计算机界历史最悠久的权威性组织ACM学会(Association for Computing
                        Machinery)主办的面向大学生的计算机程序设计竞赛。
                     </p>
                </div>
            </div>
            <div class="item">
                <img alt="" src="/images/index/2.jpg"/>
                <div class="carousel-caption">
                    <h4>
                        ACM International Collegiate Programming Contest
                    </h4>
                    <p>
                        竞赛规定每支参赛队伍至多由三名在校大学生组成，他们需要在规定的五个小时内解决八个或更多的复杂实际编程问题。每队使用一台电脑，参赛者争分夺秒，与其他参赛队伍拼比逻辑、策略和心理素质。
                    </p>
                </div>
            </div>
            <div class="item active">
                <img alt="" src="/images/index/3.jpg"/>
                <div class="carousel-caption">
                    <h4>
                        ACM International Collegiate Programming Contest
                    </h4>
                    <p>
                        ACM-ICPC大赛是一项旨在展示大学生创新能力、团队精神和在压力下编写程序、分析和解决问题能力的年度竞赛。
                    </p>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-845389" data-slide="prev"><span
                    class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control"
                                                                            href="#carousel-845389"
                                                                            data-slide="next"><span
                    class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</article>
<!--主体-->

<!--页脚-->
<?php
include "pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>