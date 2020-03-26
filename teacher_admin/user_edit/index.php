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

    <link rel="stylesheet" type="text/css" href="/css/radio.css">

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


<?php

if(isset($_GET['id']))
    $id = $_GET['id'];
if(isset($_GET['page']))
    $page = $_GET['page'];

$str = "select user_mail,user_name,user_realname,user_teacher,user_permission,user_judgement,user_cheat from user where user_id='$id'";
$result = $conn->query($str);
while (list($user_mail,$user_name,$user_realname,$user_teacher,$user_permission,$user_judgement,$user_cheat) = $result->fetch_row()) {

    $mail = $user_mail;
    $name = $user_name;
    $realname = $user_realname;
    $teacher = $user_teacher;
    $permission = $user_permission;
    $judgement = $user_judgement;
    $cheat  = $user_cheat;
}
?>

<div class="container" style="width: 100% ; height:100%; ">
    <div class="row clearfix" style="height: 100% ;" >
        <div class="col-md-2 column" style="height: 100% ; background-color:white;" id="align_nav">
            <?php

            if($avatar_path != "/images/avatar/default.jpeg")
                $avatar_path = "../".$avatar_path;
            echo "<img src='$avatar_path' alt=\"140x140\" class=\"img-circle\" style=\"width: 100px; height: 100px; margin-left: 50px;
            margin-bottom: 20px;\">";
            echo "<h4 style='text-align: center;'>$user_name</h4>";
            ?>
            <nav >
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="../user_edit">编辑用户资料</a></li>
                    <?php
                    echo " <li><a href=\"../user_admin?page=$page\">返回用户列表</a></li>";
                    ?>
                </ul>
            </nav>
        </div>
        <div class="col-md-10 column col-md-offset-2">
            <article id="wrapper" >
                <nav class="navbar navbar-default" role="navigation" style="border:0px;background-color: white;box-shadow:0px 0px 0px 0px #666;">

                    <div>
                        <ul class="nav navbar-nav">
                            <li >
                                <h3>&nbsp;&nbsp;Edit User Info</h3>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="row clearfix" >
                    <div class="col-md-6 column" style="margin-bottom: 20px;">
                        <div class="col-md-6 column">
                            <form role="form" action="submit.php" method="post">
                                <div class="row clearfix">
                                    <div class="col-md-8 column">

                                        <div class="row clearfix">
                                            <div class="col-md-8 column">
                                                <div class="form-group">
                                                    <label >ID</label>
                                                    <?php
                                                    echo "<input type=\"text\" name=\"uid\"  value=\"$id\" maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; disabled/>";
                                                    echo "<input name=\"page\" value=\"$page\" type='hidden'/>";
                                                    echo "<input name=\"user_id\" value=\"$id\" type='hidden'/>";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label >邮箱</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"realname\" value='$mail' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; disabled/>";
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label >用户名</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"name\" value='$name' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>


                                        <div class="form-group">
                                            <label >真实姓名</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"realname\" value='$realname' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label >任课教师</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"teacher\" value='$teacher' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>

                                        <div class="form-group" >
                                            <label >权限</label>

<!--                                            <div class="row clearfix">-->
<!--                                                <div class="col-md-12 column">-->
<!--                                                    <div class="btn-group">-->
<!--                                                        <button class="btn btn-default">Action</button> <button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>-->
<!--                                                        <ul class="dropdown-menu">-->
<!--                                                            <li>-->
<!--                                                                <a href="#">操作</a>-->
<!--                                                            </li>-->
<!--                                                            <li class="divider">-->
<!--                                                            </li>-->
<!--                                                            <li>-->
<!--                                                                <a href="#">其它</a>-->
<!--                                                            </li>-->
<!--                                                        </ul>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->

                                        <?php
                                            echo "<input type=\"text\" name=\"permission\" value='$permission' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>

                                        <div class="form-group" >
                                            <label >是否为风纪委员</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"judgement\" value='$judgement' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>

                                        <div class="form-group" >
                                            <label >是否为风纪委员</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"cheat\" value='$cheat' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>

<!--                                        --><?php
//                                        if($judgement == 1)
//                                        {
//                                            echo "
//                                            <div class=\"form-group\">
//                                            <label >是否为风纪委员</label>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"judgement1\" id=\"c1\">
//                                                <label for=\"c1\">是</label>
//                                            </div>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"judgement2\" id=\"c2\" checked>
//                                                <label for=\"c2\">否</label>
//                                            </div>
//
//                                            ";
//                                        }
//                                        else
//                                        {
//                                            echo "
//                                            <div class=\"form-group\">
//                                            <label >是否为风纪委员</label>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"judgement1\" id=\"c1\">
//                                                <label for=\"c1\">是</label>
//                                            </div>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"judgement2\" id=\"c2\" checked>
//                                                <label for=\"c2\">否</label>
//                                            </div>
//                                            ";
//                                        }
//                                        ?>
<!--                                        </div>-->
<!---->
<!---->
<!--                                    --><?php
//                                    if($cheat == 1)
//                                    {
//                                        echo "
//                                        <div class=\"form-group\">
//                                            <label >是否为作弊者</label>
//
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"cheat1\" id=\"c3\"  checked>
//                                                <label for=\"c3\">是</label>
//                                            </div>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"cheat2\" id=\"c4\">
//                                                <label for=\"c4\">否</label>
//                                            </div>
//                                        </div>
//                                        ";
//                                    }
//                                    else
//                                    {
//                                        echo "
//                                        <div class=\"form-group\">
//                                            <label >是否为作弊者</label>
//
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"cheat1\" id=\"c3\">
//                                                <label for=\"c3\">是</label>
//                                            </div>
//                                            <div class=\"opt\">
//                                                <input class=\"magic-checkbox\" type=\"radio\" name=\"cheat2\" id=\"c4\" checked>
//                                                <label for=\"c4\">否</label>
//                                            </div>
//                                        </div>
//                                        ";
//                                    }
//                                    ?>



                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default btn-primary" >Save</button>
                            </form>
                            <br>

                        </div>

                    </div>
                    <div class="col-md-6 column">
                        <label >重置密码</label>
                        <form role="form"  action="password_change.php" method="post">
                            <?php
                            echo "<input name=\"page\" value=\"$page\" type='hidden'/>";
                            echo "<input name=\"user_id\" value=\"$id\" type='hidden'/>";
                            ?>
                            <input type="text" name="password" class="form-control" style="width: 350px;";>
                            <br>
                            <button type="submit" class="btn btn-default btn-primary"  >Save</button>

                        </form>
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
