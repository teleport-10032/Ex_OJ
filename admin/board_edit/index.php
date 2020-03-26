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


<?php

if(isset($_GET['id']))
    $id = $_GET['id'];
if(isset($_GET['page']))
    $page = $_GET['page'];

$str = "select ann_title,ann_text from announcement where ann_id='$id'";
$result = $conn->query($str);
while (list($ann_title,$ann_text) = $result->fetch_row()) {
    $title = $ann_title;
    $description = $ann_text;
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
                    <li class="active"><a href="../board_edit">编辑公告</a></li>
                    <?php
                    echo " <li><a href=\"/admin/board_admin?page=$page\">返回公告列表</a></li>";
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
                                <h3>&nbsp;&nbsp;Edit Problem</h3>
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

                                        <div class="row clearfix">
                                            <div class="col-md-8 column">
                                                <div class="form-group">
                                                    <label >ID</label>
                                                    <?php
                                                    echo "<input type=\"text\" name=\"uid\"  value=\"$id\" maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; disabled/>";
                                                    echo "<input name=\"page\" value=\"$page\" type='hidden'/>";
                                                    echo "<input name=\"ann_id\" value=\"$id\" type='hidden'/>";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label >标题</label>
                                            <?php
                                            echo "<input type=\"text\" name=\"title\" value='$title' maxlength=\"128\" class=\"form-control\" style=\"width: 350px;\"; />";
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >正文</label>
                                            <textarea id="txt-content" name="description" data-autosave="editor-content" autofocus required>
                                                <?php
                                                echo "$description";
                                                ?>
                                            </textarea>
                                            <?php
                                            echo "
                                            <script>
                                            txt-content.setValue(value);
                                            </script>
                                            ";
                                            ?>
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
</body>
<!--            页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--            页脚-->
</html>
