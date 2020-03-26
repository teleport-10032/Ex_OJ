<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>F.A.Q|Excalibur OJ
    </title>
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
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
                <li  class="reactive"><a href="/">۩ Home </a></li>
                <li><a href="">◄): Board</a></li>
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
        用户等级机制详解
    </h3>
</div>
<article id="wrapper">
    <pre>

        当你获取了足够多的经验时，继续通过任意一道题目即可提升等级。
        各个等级升级所需经验如下：
            LV1 0
            LV2 200
            LV3 1500
            LV4 3200
            LV5 6480
            LV6 12000
        各个等级的名字颜色如下：
            LV1 <font style="color: #000000;">黑色</font>
            LV2 <font style="color: #73BF00;">绿色</font>
            LV3 <font style="color: #0000E3;">蓝色</font>
            LV4 <font style="color: #FF9224;">橙色</font>
            LV5 <font style="color: #DC143C;">红色</font>
            LV6 <font style="color: #800080;">紫色</font>
            管理员，教师等特殊权限者 <i><font style="color: #000000;">黑色斜体</font></i>
        各个等级的测试样例下载次数如下（每周四凌晨四点刷新）：
            LV1 每周0次
            LV2 每周1次
            LV3 每周2次
            LV4 每周4次
            LV5 每周6次
            LV6 每周8次
        获取经验的途径如下：
            每当你在问题列表中解决一道题目，将会获得12点exp。
            单位时间内无上限。
        注意：
            除以上六种用户权限外，还有两种特殊的用户，分别为系统管理员和教师用户，可以对公告，题目，比赛等进行操作。
        以上六种用户有两种状态，分别为风纪委员和作弊者，分别用<font style="color: #48D1CC;">青色</font>和<font style="color: #8B4513;">棕色</font>名字标识。风纪委员可查看其他人提交的代码（仅限题目列表），若发现
        有疑似舞弊者可通过邮件向教师或者系统管理员举报。若作弊实锤，则会变成作弊者状态一段时间（棕色名字）。风纪委员由教师或管理员指定。
            另外教师或管理员可生成LV0的比赛专用账户，该类型账户不可获得经验升级（这点同教师或管理员），使用<font style="color: #ADADAD;;">灰色</font>名字标识。
    </pre>

</article>
<!--主体-->


<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
