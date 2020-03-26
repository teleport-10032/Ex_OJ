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

$str = "select problem_id from problem order by problem_id desc limit 1";
$result = $conn->query($str);
$f = 1;
while (list($problem_id) = $result->fetch_row())
{
    $id = $problem_id+1;
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
                    <li  class="active"><a href="../problem_create">创建问题</a></li>
                    <li><a href="../contest_admin">比赛列表</a></li>
                    <li><a href="../contest_create">创建比赛</a></li>
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
                                <h3>&nbsp;&nbsp;Create Problem</h3>
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
                                            <label >描述</label>
                                            <textarea id="txt-content" name="description" data-autosave="editor-content" autofocus required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >输入描述</label>
                                            <textarea id="txt-content1" name="input_description" data-autosave="editor-content" autofocus required";></textarea>
<!--                                            <textarea type="text" name="input_description" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >输出描述</label>
                                            <textarea id="txt-content2" name="output_description" data-autosave="editor-content" autofocus required></textarea>
                                        </div>
                                    </div>
                                </div>


<!--                                <div class="row clearfix">-->
<!--                                    <div class="col-md-4 column">-->
<!--                                        <div class="form-group">-->
<!--                                            <label >时间限制(ms)</label>-->
<!--                                            <input name="timelimit" value="1000" type="text" class="form-control" style="width: 100px;";/>-->
<!--                                        </div>-->
<!--                                        -->
<!--                                    </div>-->
<!---->
<!---->
<!--                                    <div class="col-md-4 column">-->
<!--                                        <div class="form-group">-->
<!--                                            <label >内存限制(MB)</label>-->
<!--                                            <input name="memorylimit" value="256" type="text" class="form-control"  style="width: 100px;";/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例1</label>
                                            <textarea name="input_example" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例1</label>
                                            <textarea name="output_example"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例2(可选)</label>
                                            <textarea name="input_example2" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例2(可选)</label>
                                            <textarea name="output_example2"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例3(可选)</label>
                                            <textarea name="input_example3" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例3(可选)</label>
                                            <textarea name="output_example3"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >提示</label>
                                            <textarea id="txt-content3" name="hint" data-autosave="editor-content" autofocus required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
<!--                                    <div class="col-md-4 column">-->
<!--                                        <label >代码模板</label><br><input type="checkbox"  />C<br>-->
<!--                                        <input type="checkbox" />C++<br>-->
<!--                                        <input type="checkbox" />JAVA<br><input type="checkbox" />Python2<br>-->
<!--                                        <input type="checkbox" />Python3<br>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4 column">-->
<!--                                        <div class="form-group">-->
<!--                                            <label >测试类型：ACM</label>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >source</label>
                                            <textarea name="source" type="text" class="form-control" style="width:100%; height:100%; resize:none;"  ></textarea>
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
