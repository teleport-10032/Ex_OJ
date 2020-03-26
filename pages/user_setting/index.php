<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
include '../../functions/user_judger.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>My Setting|Excalibur OJ
    </title>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/Public_users.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            margin-top: 50px;
            padding-bottom: 20px;
            height: auto;
        }

        #nav-right1 li a:hover {
            color: green;
            border: 2px solid green;
        }

        #nav-right1 .open > a, #nav-right1 .open > a:focus, #nav-right1 .open > a:hover {
            background-color: #eee;
            border-color: green;
            /*border: 2px solid green;*/
        }

        /*#nav-right1普通用户的右侧导航栏样式 绿色*/
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
            include "../bar/index.php";
            ?>
            <!--不同用户的导航栏-->
        </div>
    </div>
</nav>
<!--导航栏-->

<?php

include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$sql = "select user_id,user_name,user_realname,user_introduction,user_major,user_github,user_avatar_path from user where user_mail = '$user_mail' limit 1";
$result = $conn->query($sql);
//echo $conn->error;
while (list($user_id, $user_name, $user_realname, $user_introduction, $user_major, $user_github, $user_avatar_path) = $result->fetch_row()) {
    $id = $user_id;
    $name = $user_name;
    $realname = $user_realname;
    $mood = $user_introduction;
    $major = $user_major;
    $github = $user_github;
    $avatar_path = $user_avatar_path;
}
$result->close();
$conn->close();
?>

<!--主体-->
<article id="wrapper">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="row clearfix" style="margin-top: 20px;">
                    <div class="col-md-2 column">
                        <?php
                        echo "<img alt='140x140' src='$avatar_path' class='img-circle' style='width: 100px; height: 100px; border: 1px solid gray;' />";
                        ?>
                    </div>
                    <div class="col-md-10 column">
                        <div class="alert alert-dismissable alert-success">
                            <h4>
                                <?php
                                if (isset($_SESSION['admin_name'])) {
                                    echo "系统管理员  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                } else if (isset($_SESSION['teacher_mail'])) {
                                    echo "教师  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                } else if (isset($_SESSION['LV0_mail'])) {
                                    echo "lelevl 0  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                } else if (isset($_SESSION['LV1_mail'])) {
                                    echo "lelevl 1  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                } else if (isset($_SESSION['LV2_mail'])) {
                                    echo "lelevl 2  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                } else if (isset($_SESSION['LV3_mail'])) {
                                    echo "lelevl 3  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                    $user_mail = $_SESSION['LV3_mail'];
                                    $user_name = $_SESSION['LV3_name'];
                                } else if (isset($_SESSION['LV4_mail'])) {
                                    echo "lelevl 4  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                    $user_mail = $_SESSION['LV4_mail'];
                                    $user_name = $_SESSION['LV4_name'];
                                } else if (isset($_SESSION['LV5_mail'])) {
                                    echo "lelevl 5  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                    $user_mail = $_SESSION['LV5_mail'];
                                    $user_name = $_SESSION['LV5_name'];
                                } else if (isset($_SESSION['LV6_mail'])) {
                                    echo "lelevl 6  &nbsp;";
                                    echo "用户ID ";
                                    echo $id;
                                    $user_mail = $_SESSION['LV6_mail'];
                                    $user_name = $_SESSION['LV6_name'];
                                }
                                ?>
                            </h4>
                            <a href="/F.A.Q/user_permission" class="alert-link" target="_blank">点此查看用户等级机制</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabbable" id="tabs-712861" style="margin-top: 20px;">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#panel-330611" data-toggle="tab">个人信息设置</a>
                </li>
                <li>
                    <a href="#panel-278949" data-toggle="tab">账号设置</a>
                </li>
                <li>
                    <a href="#panel-278950" data-toggle="tab">更改头像</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="panel-330611">
                    <div class="row clearfix">
                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;个人信息设置</h4>
                        <!--表单1-->
                        <form role="form" action="info_update.php" method="post" enctype="multipart/form-data">
                            <div class="col-md-6 column">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Name(最多20个字符)</label>
                                    <?php
                                    echo "<input type='text' value='$name' name='name' maxlength='20'  class='form-control' >";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Real Name(最多20个字符)</label>
                                    <?php
                                    echo "<input type='text' value='$realname' name='realname' maxlength='20' class='form-control'>";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Introduction(最多50个字符)</label>
                                    <?php
                                    echo "<input type='text' value='$mood' name='mood' maxlength='50' class='form-control'>";
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 column">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Major(最多20个字符)</label>
                                    <?php
                                    echo "<input type='text' value='$major' name='major' maxlength='20' class='form-control'>";
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Github(最多50个字符)</label>
                                    <?php
                                    echo "<input type='text' value='$github' name='github' maxlength='50' class='form-control'>";
                                    ?>
                                </div>
                                <!--隐藏 传值用-->
                                <div class="form-group">
                                    <?php
                                    echo "<input type='hidden' value='$id' name='id' maxlength='50' class='form-control'>";
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-default">Save</button>
                            </div>
                        </form>
                        <!--表单1-->
                    </div>
                </div>

                <div class="tab-pane" id="panel-278949">
                    <div class="col-md-6 column">
                        <h4>更改密码</h4>
                        <!--表单2-->
                        <form role="form" action="passwd_change.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password</label>
                                <input type="password" maxlength="20" name="passwd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" maxlength="20" minlength="6" name="newpasswd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm New Password</label>
                                <input type="password" maxlength="20" minlength="6" name="repasswd" class="form-control"/>
                            </div>
                            <!--隐藏 传值用-->
                            <div class="form-group">
                                <?php
                                echo "<input type='hidden' value='$id' name='id' maxlength='50' class='form-control'>";
                                ?>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="panel-278950">
                <div class="col-md-6 column">
                    <h4>更改头像</h4>
                    <!--表单3-->
                    <form role="form" action="avatar_update.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">更改头像(格式为jpg或png,最大1MB)</label>
                            <input type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" id="file"/>
                            <p class="help-block">
                            </p>
                        </div>
                        <div class="form-group">
                            <?php
                            echo "<input type='hidden' value='$id' name='id' maxlength='50' class='form-control'>";
                            ?>
                        </div>
                        <button type="submit" class="btn btn-default">Save</button>
                    </form>
                </div>
            </div>



            </div>
        </div>
    </div>
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