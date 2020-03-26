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
                    <li class="active"><a href="../user_plugin">导入&生成用户</a></li>
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
                                <h3>&nbsp;&nbsp;Import/Generate  User</h3>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="row clearfix" >
                    <div class="col-md-12 column" style="margin-bottom: 20px;">
                        <div class="col-md-12 column">
                            您可以使用包含"user_mail"(必填)，"user_name"(必填)，"user_realname","user_passwd"(必填)字段的csv文件导入用户，以下提供两种用户：
                        </div>
                    </div>

                    <div class="col-md-12 column" style="margin-bottom: 20px;">
                        <div class="col-md-12 column">
                        1.导入比赛专用用户（用户等级为LV0且不能获取经验）
                            <form  action="contest_user_import.php" method="post" enctype="multipart/form-data">
                                <br>
                                请选择要导入的csv文件：
                                <br><br>
                                <input type="file" name="f1" id="file1"/>
                                <br>
                                <button type="submit" class="btn btn-default btn-primary" >Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12 column" style="margin-bottom: 20px;">
                        <div class="col-md-12 column">
                            2.导入普通用户（用户等级为LV1）
                            <form action="common_user_import.php" method="post" enctype="multipart/form-data">
                                <br>
                                请选择要导入的csv文件：
                                <br><br>
                                <input type="file" name="f2" id="file2"/>
                                <br>
                                <button type="submit" class="btn btn-default btn-primary" >Submit</button>
                            </form>
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
