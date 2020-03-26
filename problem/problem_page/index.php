<?php
session_start();
if(isset($_GET['id']))
    $id = $_GET['id'];
include "../../functions/conn.php";
date_default_timezone_set("PRC");
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$str = "select problem_visible from problem where problem_id='$id' limit 1";
$result = $conn->query($str);
while (list($problem_visible) = $result->fetch_row())
{
    if($problem_visible=='0')
    {
        echo "<script>alert('您无权限访问此页面！')</script>";
        echo "<script>url=\"/\";window.location.href=url;</script>";
        exit;
    }
}
$result->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Problem|Excalibur OJ</title>
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
                <li class="reactive"><a href="/problem/problems">✎ Problems</a></li>
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

<div class="panel panel-default" style="width: 80%;margin:0 auto;" id="wrapper">
    <div class="panel-body">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <h4 style="color: #349cf3">
                        ID <?php
                        echo $id;
                        ?>
                    </h4>
                    <?php
                    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
                    if (!$conn) {
                        die("连接失败: " . $conn->connect_error);
                    }
                    $conn->query("set names 'utf8'");
                    $str = "select problem_title,problem_description,problem_input_des,problem_output_des,problem_inputex,problem_outputex,problem_inputex2,problem_outputex2,problem_inputex3,problem_outputex3,problem_hint,problem_source from problem where problem_id='$id'";
                    $result = $conn->query($str);
                    while (list($problem_title, $problem_description, $problem_input_des, $problem_output_des, $problem_inputex, $problem_outputex, $problem_inputex2, $problem_outputex2, $problem_inputex3, $problem_outputex3, $problem_hint,$problem_source) = $result->fetch_row()) {

                        //echo "<dl> <dd>$id</dd><dl>";
                        echo " <h4 style='color: #349cf3'>  Title：</h4>
                        <dl> <dd> $problem_title</dd></dl>";
                        echo " <h4 style='color: #349cf3'>  Description：</h4>
                        <dl> <dd> $problem_description</dd></dl>";
                        echo "<dl> <dd> <h4 style='color: #349cf3'>Input：</h4></dd><dd>$problem_input_des</dd>
                        <dd><h4 style='color: #349cf3'>Output：</h4></dd><dd>$problem_output_des</dd></dl>";

                        echo "<dl>
                        <div class='row clearfix'>
                                <div class='col-md-3 column'>
                                <dd><h4 style='color: #349cf3'>Sample Input 1：</h4></dd>
                                <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly class = 'form-control'>$problem_inputex</textarea>
                </dd>
                            </div>
                            <div class='col-md-3 column'>
                             <dd>
                                 <h4 style='color: #349cf3'>Sample Output 1：</h4></dd><dd >
                             <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly
                    class = 'form-control'>$problem_outputex</textarea>
                </dd>
        </div>
    </div>
                       </dl>";

                        if($problem_inputex2 != "" || $problem_outputex2 != "")
                        {
                            echo "<dl>
                        <div class='row clearfix'>
                                <div class='col-md-3 column'>
                                <dd><h4 style='color: #349cf3'>Sample Input 2：</h4></dd>
                                <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly class = 'form-control'>$problem_inputex2</textarea>
                </dd>
                            </div>
                            <div class='col-md-3 column'>
                             <dd>
                                 <h4 style='color: #349cf3'>Sample Output 2：</h4></dd><dd >
                             <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly
                    class = 'form-control'>$problem_outputex2</textarea>
                </dd>
        </div>
    </div>
                       </dl>";
                        }

                        if($problem_inputex3 != "" || $problem_outputex3 != "")
                        {
                            echo "<dl>
                        <div class='row clearfix'>
                                <div class='col-md-3 column'>
                                <dd><h4 style='color: #349cf3'>Sample Input 3：</h4></dd>
                                <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly class = 'form-control'>$problem_inputex3</textarea>
                </dd>
                            </div>
                            <div class='col-md-3 column'>
                             <dd>
                                 <h4 style='color: #349cf3'>Sample Output 3：</h4></dd><dd >
                             <dd style='height: auto;'>
                    <textarea cols='20' style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  readonly
                    class = 'form-control'>$problem_outputex3</textarea>
                </dd>
        </div>
    </div>
                       </dl>";
                        }
                        echo "<h4 style='color: #349cf3'> Hint：  </h4><dl><dd > $problem_hint</dd></dl>";
                        echo "<h4 style='color: #349cf3'> Source：  </h4><dl><dd > $problem_source</dd></dl>";
                        echo "<h4 style='color: #349cf3'> Lang&Limit：  </h4><dl><dd >C/1000ms/256MB</dd></dl>";
                    }
                    ?>


                    <h4 style="color: #349cf3">
                        Submit：
                    </h4>
                    <dl>
                        <dd>
                            <form action="submit.php" method="post">
                                        <textarea name="code" cols="100" rows="30" style='LINE-HEIGHT:18px;padding: 3px;max-width: 1000px;max-height: 1000px;resize: none;'  class = 'form-control'></textarea>
                                <br>
                                <?php
                                echo "<input type='hidden' value='$id' name='problem_id' maxlength='50' class='form-control'>";
                                echo "<input type='hidden' value='$user_mail' name='user_mail' maxlength='50' class='form-control'>";
                                ?>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </dd>
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
