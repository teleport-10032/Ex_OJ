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

$str = "select problem_title,problem_description,problem_input_des,problem_output_des,problem_inputex,problem_outputex,problem_inputex2,problem_outputex2,problem_inputex3,problem_outputex3,problem_hint,problem_source,problem_create_time from problem where problem_id='$id'";
$result = $conn->query($str);
while (list($problem_title, $problem_description, $problem_input_des, $problem_output_des,$problem_inputex, $problem_outputex,$problem_inputex2, $problem_outputex2,$problem_inputex3, $problem_outputex3, $problem_hint,$problem_source,$problem_create_time) = $result->fetch_row()) {

    $title = $problem_title;
    $description = $problem_description;
    $input_description = $problem_input_des;
    $output_description = $problem_output_des;
    $input_example = $problem_inputex;
    $output_example = $problem_outputex;
    $input_example2 = $problem_inputex2;
    $output_example2 = $problem_outputex2;
    $input_example3 = $problem_inputex3;
    $output_example3 = $problem_outputex3;
    $hint = $problem_hint;
    $source = $problem_source;
    $create_time = $problem_create_time;
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
                    <li class="active"><a href="../problem_edit">编辑问题</a></li>
                    <?php
                    echo " <li><a href=\"../problem_admin?page=$page\">返回问题列表</a></li>";
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
                                                    echo "<input name=\"problem_id\" value=\"$id\" type='hidden'/>";
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
                                            <label >描述</label>
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

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >输入描述</label>
                                            <textarea id="txt-content1" name="input_description" data-autosave="editor-content" autofocus required";>
                                            <?php
                                            echo "$input_description";
                                            ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >输出描述</label>
                                            <textarea id="txt-content2" name="output_description" data-autosave="editor-content" autofocus required>
                                                <?php
                                                echo "$output_description";
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例</label>
                                            <textarea name="input_example" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$input_example"; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例</label>
                                            <textarea name="output_example"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$output_example"; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例2</label>
                                            <textarea name="input_example2" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$input_example2"; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例2</label>
                                            <textarea name="output_example2"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$output_example2"; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输入样例3</label>
                                            <textarea name="input_example3" type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$input_example3"; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 column">
                                        <div class="form-group">
                                            <label >输出样例3</label>
                                            <textarea name="output_example3"  type="text" class="form-control" style="width:100%; height:150px; resize:none;" ><?php echo "$output_example3  "; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >提示</label>

                                                <?php
                                                echo "<textarea id=\"txt-content3\" name=\"hint\" data-autosave=\"editor-content\" autofocus required>";
                                                echo "$hint";
                                                echo "</textarea>";
                                                ?>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="row clearfix">-->
<!--                                        <div class="form-group">-->
<!--                                            <label >测试样例上传</label>-->
<!--                                            <input name="file" type="file" id="exampleInputFile" />-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div class="row clearfix">
                                    <div class="col-md-12 column">
                                        <div class="form-group">
                                            <label >source</label>
                                            <?php
                                            echo "
                                                 <textarea name=\"source\" type=\"text\" class=\"form-control\" style=\"width:100%; height:100%; resize:none;\" >$source</textarea>
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
