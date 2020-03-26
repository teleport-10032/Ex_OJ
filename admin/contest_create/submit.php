<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
session_start();
$flag = 1;
if (isset($_SESSION['admin_mail'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
}
if ($flag == 1) {
    //echo "<script>alert('$flag')</script>";
    echo "<script>alert('请先登录!')</script>";
    echo "<script>url=\"/\";window.location.href=url;</script>";
    exit();
}

$title = $_POST["title"];
$description = $_POST["description"];
$passwd = $_POST["passwd"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$visiable = 0;
$problems = $_POST["problems"];

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




$str = "select user_id from user where user_mail='$user_mail'";
$result = $conn->query($str);
while (list($user_id) = $result->fetch_row())
{
    $id = $user_id;
}
$result->close();

$sql = "INSERT INTO contest(contest_author,contest_title, contest_description,contest_visible,contest_start_time,contest_end_time,contest_passwd,contest_problem)
                VALUES
                ('$id','$title' , '$description','$visiable','$start_time','$end_time','$passwd','$problems')";
if (mysqli_query($conn, $sql))
{

//    //查contest id
//    $str = "select contest_id from porblem where problem_id='$problems_array[$i]'";
//    $result = $conn->query($str);
//    //将选中的题目连同contest id 复制到到contest_problem中
//    for($i = 0 ; $i < count($problems_array) ; $i ++)
//    {
//        //查出来
//        $str = "select * from porblem where problem_id='$problems_array[$i]'";
//        $result = $conn->query($str);
//        while (list($id,$title,$description,$input_des,$output_dex,$inputex,$outputex,$timelimit,$memorylimit,$testcase_path,
//            $visible,$hint,$source,$author,$create_time) = $result->fetch_row())
//        {
//            //插入
//            $sql1 = "INSERT INTO ()
//                VALUES
//                ('$id','$title' , '$description','$visiable','$start_time','$end_time','$passwd','$problems')";
//        }
//        $result->close();
//    }
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/admin/contest_admin';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}

$result->close();
$conn->close();


?>