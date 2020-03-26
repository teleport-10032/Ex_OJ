<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
date_default_timezone_set("PRC");
$flag = 1;
if (isset($_SESSION['teacher_mail'])) {
    $user_mail = $_SESSION['teacher_mail'];
    $user_name = $_SESSION['teacsher_name'];
    $flag = 0;
}
if ($flag == 1) {
    //echo "<script>alert('$flag')</script>";
    echo "<script>alert('请先登录!');history.back();</script>";
    //echo "<script>url=\"/\";window.location.href=url;</script>";
    exit;
}

$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$passwd = $_POST["passwd"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$problems = $_POST["problems"];
$page = $_POST["page"];

include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");


if($title == "")
{
    echo "<script>alert('请填写标题');history.back();</script>";
    exit;
}
if($description == "")
{
    echo "<script>alert('请填写描述');history.back();</script>";
    exit;
}
if($start_time == "")
{
    echo "<script>alert('请填写开始时间');history.back();</script>";
    exit;
}
if($end_time == "")
{
    echo "<script>alert('请填写结束时间');history.back();</script>";
    exit;
}
if($problems == "")
{
    echo "<script>alert('请填写竞赛题目');history.back();</script>";
    exit;
}
else
{
    $problems_array = explode(".",$problems);
    $flag = 0;
    for($i = 0 ; $i < count($problems_array) ; $i ++)
    {
        if(!is_numeric($problems_array[$i]))
            $flag = 1;
    }
    if($flag == 1)
    {
        echo "<script>alert('竞赛题目格式不正确');history.back();</script>";
        exit;
    }
    else {
        $temp = "";
        $fl = 1;
        for($i = 0 ; $i < count($problems_array) ; $i ++)
        {
            $f = 1;
            $str = "select problem_title from problem where problem_id='$problems_array[$i]'";
            $result = $conn->query($str);
            while (list($problem_title) = $result->fetch_row())
            {
                $f = 0;
            }
            if($f == 1)
            {
                $fl = 0;
                $temp = $problems_array[$i];
                break;
            }
        }
        if($fl == 0)
        {
            echo "<script>alert('您选择的题目号";
            echo $problems_array[$i];
            echo "在题库中不存在');history.back();</script>";
            exit;
        }

    }
}


$sql = "update contest set contest_title='$title',contest_description='$description',contest_start_time='$start_time',
contest_end_time='$end_time',contest_passwd='$passwd',contest_problem='$problems' where contest_id='$id'";

if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='../contest_admin?page=$page';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}

$conn->close();
$result->close();

?>