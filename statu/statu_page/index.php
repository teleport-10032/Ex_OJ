<?php
session_start();
date_default_timezone_set("PRC");
if(isset($_GET['id']))
    $id = $_GET['id'];
//echo $id;
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Statu|Excalibur OJ</title>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/problem.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
<div class="panel panel-default" style="width: 80%;margin:0 auto;" id="wrapper">
    <div class="panel-body">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <h4 style="color: #349cf3">
                        Info：
                    </h4>

                    <?php
                    $id = $_GET['id'];
                    include "../../functions/user_judger.php";
                    include "../../functions/conn.php";
                    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                    // 检测连接
                    if (!$conn) {
                        die("连接失败: " . $conn->connect_error);
                    }

                    $str = "select submit_when,submit_problem,submit_statu ,submit_time, submit_memory, submit_language,submit_length,submit_user_mail,submit_text,user_name,user_casedownload_times,user_judgement from status,user where submit_id='$id' and submit_user_mail=user_mail";
                    $conn->query("set names 'utf8'");
                    $result = $conn->query($str);
                    $flag = 1;
                    while (list($submit_when, $submit_problem, $submit_statu, $submit_time, $submit_memory, $submit_language, $submit_length, $submit_user_mail, $submit_text,$submit_user,$times,$user_judgement) = $result->fetch_row()) {

                        if ($submit_user_mail == $user_mail || isset($_SESSION['admin_mail']) || isset($_SESSION['teacher_mail']) || $user_judgement==1)
                        {
                            $flag = 0;
                            echo "提交编号:" . "$id" . "<br>";
                            echo "提交时间:" . "$submit_when" . "<br>";
                            echo "问题编号:" . "$submit_problem" . "<br>";
                            echo "状态:" . "$submit_statu" . "<br>";
                            echo "时间:" . "$submit_time" . "ms" . "<br>";
                            echo "内存:" . "$submit_memory" . "KB" . "<br>";
                            echo "代码长度:" . "$submit_length" . "<br>";
                            echo "用户:" . "$submit_user" . "<br>";
                            if($submit_statu != "Accepted" && $submit_statu != "Queueing")
                            {
                                echo "<br>";
                                echo "<a href='testcase_download.php?problem_id=$submit_problem'>下载本题测试样例</a>";
                                echo "<br>";
                                echo "您本周还有$times"."次下载机会";
                            }

                            $code = $submit_text;
                            $code = str_replace("\n", "<br>", $code);
                        }
                        else {
                            echo "<script>alert('您不具有访问该页面的权限！')</script>";
                            echo "<script>url=\"/\";window.location.href=url;</script>";
                            exit;
                        }
                    }
                    ?>
                    <h4 style="color: #349cf3">
                        Code:
                    </h4>
                    <dl>
                        <?php
//                        echo "<p style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'class = 'form-control'>";
                        echo $code;
//                        echo "</p>";
                        ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<!--主体-->


<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
<script type="text/javascript">

    jQuery.fn.extend({

        autoHeight: function(){

            return this.each(function(){

                var $this = jQuery(this);

                if( !$this.attr('_initAdjustHeight') ){

                    $this.attr('_initAdjustHeight', $this.outerHeight());

                }

                _adjustH(this).on('input', function(){

                    _adjustH(this);

                });

            });

            /**

             * 重置高度

             * @param {Object} elem

             */

            function _adjustH(elem){

                var $obj = jQuery(elem);

                return $obj.css({height: $obj.attr('_initAdjustHeight'), 'overflow-y': 'hidden'})

                    .height( elem.scrollHeight );

            }

        }

    });

    // 使用

    $(function(){

        $('textarea').autoHeight();

    });

</script>

<script >
    var editor = new Simditor({
        textarea: $('#editor')
        //optional options
    });
</script>>
</html>

