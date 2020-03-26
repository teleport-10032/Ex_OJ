<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
date_default_timezone_set("PRC");
?>

<?php
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$str = "select user_avatar_path from user where user_mail='$user_mail'";
$result = $conn->query($str);
while (list($user_avatar_path) = $result->fetch_row())
{
    $avatar_path = $user_avatar_path;
}

$str = "select contest_id from contest order by contest_id desc limit 1";
$result = $conn->query($str);
$f = 1;
while (list($contest_id) = $result->fetch_row())
{
    $id = $contest_id+1;
    $f = 0;
}
if($f == 1)
    $id = 1000;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Excalibur OJ</title>
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7-dist/css/bootstrap-switch.css" rel="stylesheet">
    <link href="/css/Admin.css" rel="stylesheet">
    <link  rel="stylesheet" type="text/css" href="/simditor/site/assets/styles/simditor.css" />

    <script type="text/javascript" src="/simditor/site/assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/mobilecheck.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/module.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/uploader.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/simditor.js"></script>
    <script type="text/javascript" src="/simditor/site/assets/scripts/page-demo.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap-switch.js"></script>



    <script type="text/javascript">
        $(function(){
            $('#mySwitch input').bootstrapSwitch();
        })
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>
<body>
<div class="container" style="width: 100% ; height:100%; ">
    <div class="row clearfix" style="height: 100% ;" >
        <div class="col-md-2 column" style="height: 100% ; background-color:white;" id="align_nav">
            <?php
            echo "<img src='"."$avatar_path"."' alt=\"140x140\" class=\"img-circle\" style=\"width: 100px; height: 100px; margin-left: 50px;
            margin-bottom: 20px;\">";
            echo "<h4 style='text-align: center;'>$user_name</h4>";
            ?>
            <nav >
                <ul class="nav nav-pills nav-stacked">
                    <li ><a href="../problem_admin">问题列表</a></li>
                    <li><a href="../problem_create">创建问题</a></li>
                    <li><a href="../contest_admin">比赛列表</a></li>
                    <li  class="active"><a href="../contest_create">创建比赛</a></li>
                    <li><a href="../user_admin">用户列表</a></li>
                    <li><a href="../user_plugin">导入&生成用户</a></li>
                    <li><a href="../board_admin">公告列表</a></li>
                    <li><a href="../board_create">创建公告</a></li>
                    <li><a href="/">返回主站</a></li>
                    <li><a href="/functions/login_out">退出登录</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-md-10 column col-md-offset-2">
            <article id="wrapper" >
                <nav class="navbar navbar-default" role="navigation" style="border:0px;background-color: white;box-shadow:0px 0px 0px 0px #666;">

                    <div>
                        <ul class="nav navbar-nav">
                            <li >
                                <h3>&nbsp;&nbsp;Create Contest</h3>
                            </li >
                        </ul>
                    </div>
                </nav>

                <div class="row clearfix" >
                    <div class="col-md-12 column" style="margin-bottom: 20px;">
                        <div class="col-md-12 column">
                            <form role="form" action="submit.php" method="post">

                                <div class="row clearfix">
                                    <div class="col-md-8 column">

                                        <div class="form-group">
                                            <label >ID</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"uid\"  value=\"$id\" maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; disabled/>";
                                            //echo "<input type=\"hiddenw\" name=\"id\"  value=\"$id\" maxlength=\"128\"/>";
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <form action="submit.php" method="post">

                                    <div class="row clearfix">
                                        <div class="col-md-8 column">

                                            <div class="form-group">
                                                <label >标题</label>
                                                <input type="text" name="title" maxlength="128" class="form-control" style="width: 350px;"; />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row clearfix">
                                        <div class="col-md-12 column">
                                            <div class="form-group">
                                                <label >描述</label>
                                                <textarea id="txt-content" name="description" data-autosave="editor-content" autofocus required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-4 column">
                                            <div class="form-group">
                                                <label >开始时间</label>
                                                <input name="start_time" id="startTime" type="text" class="form-control" placeholder='开始时间' style="width: 200px;";/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-4 column">
                                            <div class="form-group">
                                                <label >结束时间</label>
                                                <input name="end_time"  id="endTime" type="text" class="form-control" placeholder='结束时间' style="width: 200px;";/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-4 column">
                                            <div class="form-group">
                                                <label >密码保护(留空表示公开)</label>
                                                <input name="passwd"  type="text" class="form-control" placeholder='密码' style="width: 200px;";/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-4 column">
                                            <div class="form-group">
                                                <label >竞赛题目(输入题号，以"."分隔。如"1000.1001.1002")</label>
                                                <input name="problems"  type="text" class="form-control" placeholder='题号' maxlength="1000" style="width: 900px;";/>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default btn-primary" >Save</button>
                                </form>
                        </div>
                    </div>
                </div>
            </article>


        </div>
    </div>
</div>

<!--时间选择器-->
<script src="/laydate/laydate.js"></script>
<script>
    function changeDate(){
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        m = m<10 ? ('0'+ m) :m;
        var d = date.getDate();
        d = d<10 ? ('0'+ d) :d;
        var h = date.getHours();
        h = h<10 ? ('0'+ h) :h;
        var i = date.getMinutes();
        i = i<10 ? ('0'+ i) :i;
        var s = date.getSeconds();
        s = s<10 ? ('0'+ s) :s;
        return y+'-'+m+'-'+d+' '+h+':'+i+':'+s;
    }
    var now = changeDate();
    var startTime =laydate.render({
        elem: '#startTime',
        type: 'datetime',
        min: now,
        max: '2035-12-31 12:30:00',
        done: function(value, date, endDate)
        {
            endLayDate.config.min = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds +1
            };
        },
    });
    var endLayDate = laydate.render({
        elem: '#endTime',
        type: 'datetime',
        max: '2035-12-31 12:30:00',
        btns: ['clear', 'confirm'],  //clear、now、confirm
        done: function(value, date, endDate) {
            startTime.config.max = {
                year: date.year,
                month: date.month - 1,
                date: date.date,
                hours: date.hours,
                minutes: date.minutes,
                seconds: date.seconds -1
            };
        },
    });
</script>
<!--时间选择器-->


</body>
<!--            页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--            页脚-->
</html>
