<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
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

$str = "select ann_id from announcement order by ann_id desc limit 1";
$result = $conn->query($str);
$flag = 0;
while (list($ann_id) = $result->fetch_row())
{
    $id = $ann_id+1;
    $flag = 1;
}
if($flag == 0)
    $id = 1000;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Excalibur OJ</title>
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
                    <li><a href="../contest_create">创建比赛</a></li>
                    <li><a href="../user_admin">用户列表</a></li>
                    <li><a href="../user_plugin">导入&生成用户</a></li>
                    <li><a href="../board_admin">公告列表</a></li>
                    <li   class="active"><a href="../board_create">创建公告</a></li>
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
                                <h3>&nbsp;&nbsp;Create Announcement</h3>
                            </li>
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
                                            <label >正文</label>
                                            <textarea id="txt-content" name="description" data-autosave="editor-content" autofocus required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-default btn-primary" >Save</button>
                            </form>
                            <br>
                            <!--                            <form action="test_case_submit.php" method="post">-->
                            <!--                                    <div class="form-group">-->
                            <!--                                        <label >测试样例上传</label>-->
                            <!--                                        <input name="file" type="file" accept=".zip" id="file" />-->
                            <!--                                    </div>-->
                            <!--                            </form>-->

                        </div>
                    </div>
                </div>


            </article>


        </div>
    </div>
</div>
</body>
<!--            页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--            页脚-->
</html>
