<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>F.A.Q|Excalibur OJ
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
        常见判题结果解释
    </h3>
</div>
<article id="wrapper">
    <pre>


    Queueing: 系统正在做评判的准备工作，这个过程不会太久，请您稍等片刻再刷新浏览器

    Accepted: 您的程序是正确的，恭喜！

    Presentation Error: 虽然您的程序貌似输出了正确的结果，但是这个结果的格式有点问题。请检查程序的输出是否多了或者少了空格（’ ‘）、制表符（’\t’）或者换行符（’\n’）。

    Wrong Answer: 你的程序正常运行并输出了结果，不过是答案错误

    Runtime Error: 运行时错误，这个一般是程序在运行期间执行了非法的操作造成的。以下列出常见的错误类型：

    Runtime Error(ARRAY_BOUNDS_EXCEEDED) //数组越界

    Runtime Error(DIVIDE_BY_ZERO) //除零

    Runtime Error(ACCESS_VIOLATION) //非法内存访问

    Runtime Error(STACK_OVERFLOW) //堆栈溢出

    Time Limit Exceeded: 您的程序运行的时间已经超出了这个题目的时间限制。

    Memory Limit Exceeded: 您的程序运行的内存已经超出了这个题目的内存限制。

    Output Limit Exceeded:你的程序往控制台输出了太多信息，请检查程序是否死循环。

    Compile Error: 您的程序语法有问题，编译器无法编译。具体的出错信息可以点击链接查看。

    System Error: OJ内部出现错误。由于我们的OJ可能存在一些小问题，所以出现这个信息请原谅，同时请及时与管理员联系。
    </pre>

</article>
<!--主体-->


<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
