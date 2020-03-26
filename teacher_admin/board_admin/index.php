<?php
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
date_default_timezone_set("PRC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Excalibur OJ</title>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/Admin.css" rel="stylesheet">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap-switch.css" rel="stylesheet">
    <script src="/bootstrap-3.3.7-dist/js/bootstrap-switch.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#mySwitch input').bootstrapSwitch();
        })
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        }
    </script>
</head>

<!--计算页数-->
<?php
include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$page_size = 5;
//echo "<script>alert('$user_mail')</script>";
$sql = "select count(ann_id) as amount from announcement,user where ann_author=user_id and user_mail = '$user_mail'";
$result = $conn->query($sql);
list($amount) = $result->fetch_row();
//echo "<script>alert('$amount')</script>";
if ($amount) {
    if ($amount < $page_size) {
        $page_count = 1;
    } else if ($amount % $page_size) {
        $page_count = (int)($amount / $page_size) + 1;
    } else {
        $page_count = $amount / $page_size;
    }
} else {
    $page_count = 0;
}
?>
<!--计算页数-->


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

<body>
<div class="container" style="width: 100% ; height:100%; ">
    <div class="row clearfix" style="height: 100% ;">
        <!--                侧边导航栏-->
        <div class="col-md-2 column" style="height: 100% ; background-color:white;" id="align_nav">
            <?php
            echo "<img src='"."$avatar_path"."' alt=\"140x140\" class=\"img-circle\" style=\"width: 100px; height: 100px; margin-left: 50px;
            margin-bottom: 20px;\">";
            echo "<h4 style='text-align: center;'>$user_name</h4>";
            ?>

            <nav>
                <ul class="nav nav-pills nav-stacked">
                    <li ><a href="../problem_admin">问题列表</a></li>
                    <li><a href="../problem_create">创建问题</a></li>
                    <li><a href="../contest_admin">比赛列表</a></li>
                    <li><a href="../contest_create">创建比赛</a></li>
                    <li><a href="../user_admin">用户列表</a></li>
                    <li><a href="../user_plugin">导入&生成用户</a></li>
                    <li  class="active"><a href="../board_admin">公告列表</a></li>
                    <li><a href="../board_create">创建公告</a></li>
                    <li><a href="/">返回主站</a></li>
                    <li><a href="/functions/login_out">退出登录</a></li>
                </ul>
            </nav>
        </div>
        <!--                侧边导航栏-->
        <div class="col-md-10 column col-md-offset-2">
            <article id="wrapper">
                <nav class="navbar navbar-default" role="navigation"
                     style="border:0px;background-color: white;box-shadow:0px 0px 0px 0px #666;">

                    <div>
                        <ul class="nav navbar-nav">
                            <li>
                                <h3>&nbsp;&nbsp;Announcement List</h3>
                            </li>
                        </ul>
                    </div>
                </nav>


                <!--主体-->
                <div class="row clearfix">
                    <div class="col-md-12 column">
                        <table class="table table-striped table-hover table-responsive">
                            <thead>
                            <tr class="">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    LastUpdateTime
                                </th>
                                <th>
                                    Author
                                </th>
                                <th>
                                    Visible
                                </th>
                                <th>
                                    Operation
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $str = "select ann_id,ann_title,ann_time,user_name,ann_visible from announcement,user where ann_author=user_id and user_mail='$user_mail' order by ann_time desc limit " . ($page - 1) * $page_size . "," . $page_size;
                            $result = $conn->query($str);
                            while (list($ann_id, $ann_title, $ann_time, $ann_author,$ann_visible) = $result->fetch_row()) {
                                echo "
                                     <tr>
                            <td>
                                    $ann_id
                                </td>
                                <td>
                                    <a href='/board/announcement?id=$ann_id'>
                                        $ann_title
                                    </a>
                                </td>
                                <td>
                                    $ann_time
                                </td>
                                <td>
                                    $ann_author
                                </td>";
                                if($ann_visible == '1')
                                    echo "<td style='color: deepskyblue;'>
                                        <a href='visible_change.php?id=$ann_id&page=$page&visible=1'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;√&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </td>";
                                else
                                    echo "<td style='color: mediumvioletred;'>
                                        <a style='color: mediumvioletred'; href='visible_change.php?id=$ann_id&page=$page&visible=0'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✕&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </td>";
                                echo "
                                <td>
                                    <a href='../board_edit?id=$ann_id&page=$page'>
                                    <button type=\"button\" class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"> </span></button>
                                    </a>
                                    
                                    <a href='delete.php?id=$ann_id&page=$page' >
                                    <button onclick=\"return confirm('确定删除当前公告？')\"  type=\"button\" class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></button>
                                    </a>
                                    
                                    ";
                                //此处差一个上传按钮
                                echo "
                                   </td>
                            </tr>";
                            }

                            if($page_count == $page && $page != 1)
                            {
                                if($amount % $page_size != 0)
                                {
                                    $y = $page_size - $amount % $page_size;
                                    for($i = 1 ; $i <= $y ; $i ++)
                                        echo "<tr style='height: 50px;'><td> </td><td> </td><td> </td><td> </td><td> </td> <td> </td>  </tr>";
                                }
                            }


                            $result->close();
                            $conn->close();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pagination pagination-right" id="page">
                    <ul class="pagination">
                        <?php
                        $pre = $page - 1;
                        $nex = $page + 1;
                        if ($page != 1)
                            echo "<li> <a href=/admin/board_admin?page=$pre><</a></li>";
                        else
                            echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\"><</i></a></li>";
                        for ($i = 1; $i <= $page_count; $i++)
                            if ($i == $page)
                                echo "<li> <a href=/admin/board_admin?page=$i><b><i>$i</i></b></a></li>";
                            else
                                echo "<li> <a href=/admin/board_admin?page=$i>$i</a></li>";
                        if ($page != $page_count)
                            echo "<li> <a href=/admin/board_admin?page=$nex>></a></li>";
                        else
                            echo "<li> <a href =\"javascript:return false;\"> <i style=\"opacity: 0.2\">></i></a></li>";
                        ?>
                    </ul>
                </div>
            </article>




            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12 column">

                        <!--                        编辑公告DIV-->
                        <div class="modal fade" id="modal-container-414983" role="dialog" aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" style="width: 700px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            编辑公告
                                        </h4>

                                    </div>
                                    <div style="height: 30px;"></div>
                                    <div class="modal-body">
                                        <form role="form" action="save.php">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">标题</label>
                                                <input type="text" name="title" class="form-control"/>
                                            </div>
                                    </div>
                                    <input type="hidden" name="id" value=""/>
                                    <label style="padding-left: 20px;" for="exampleInputEmail1">内容</label>
                                    <br>
                                    <textarea name="text" maxlength="100"></textarea>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="button" class="btn btn-primary">保存</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--                     编辑公告DIV-->

                    </div>
                </div>
            </div>
            <!--主体-->

            <!--页脚-->
            <?php
            include "../../pages/footer/index.php";
            ?>
            <!--页脚-->

        </div>
    </div>
</div>

</body>


</html>