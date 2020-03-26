<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
include "../../functions/user_judger.php";

if(isset($_POST["page"]))
    $page = $_POST["page"];
if(isset($_POST['problem_id']))
    $problem_id = $_POST['problem_id'];
if(isset($_POST["title"]))
    $title = $_POST["title"];
if(isset($_POST["description"]))
    $description = $_POST["description"];
if(isset($_POST["input_description"]))
    $input_description = $_POST["input_description"];
if(isset($_POST["output_description"]))
    $output_description = $_POST["output_description"];

if(isset($_POST["input_example"]))
    $input_example = $_POST["input_example"];
if(isset($_POST["output_example"]))
    $output_example = $_POST["output_example"];

if(isset($_POST["input_example2"]))
    $input_example2 = $_POST["input_example2"];
else
    $input_example2 = "";
if(isset($_POST["output_example2"]))
    $output_example2 = $_POST["output_example2"];
else
    $output_example2 = "";

if(isset($_POST["input_example3"]))
    $input_example3 = $_POST["input_example3"];
else
    $input_example3 = "";
if(isset($_POST["output_example3"]))
    $output_example3 = $_POST["output_example3"];
else
    $output_example3 = "";

if(isset($_POST["hint"]))
    $hint = $_POST["hint"];
else
    $hint = "";

if(isset($_POST["source"]))
    $source = $_POST["source"];
else
    $source = "";


if($title == "")
{
    echo "<script>alert('请填写标题');history.back();</script>";
    exit;
}
if($description == "")
{
    echo "<script>alert('请填写题目描述');history.back();</script>";
    exit;
}
if($output_description == "")
{
    echo "<script>alert('请填写输入描述');history.back();</script>";
    exit;
}
if($output_description == "")
{
    echo "<script>alert('请填写输出描述');history.back();</script>";
    exit;
}if($input_example == "")
{
    echo "<script>alert('请填写输入样例');history.back();</script>";
    exit;
}
if($output_example == "")
{
    echo "<script>alert('请填写输出样例');history.back();</script>";
    exit;
}


if($hint == "")
{
    $hint = "无";
}


include '../../functions/conn.php';
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    exit("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");

$str = "select user_id from user where user_mail='$user_mail'";
$result = $conn->query($str);
while (list($user_id) = $result->fetch_row())
{
    $id = $user_id;
}



$sql = "
update problem set problem_create_time=now(),problem_author='$id',problem_title='$title',problem_description='$description',
problem_input_des='$input_description',problem_output_des='$output_description',problem_inputex='$input_example',problem_outputex='$output_example',
problem_hint='$hint',problem_source='$source',problem_inputex2='$input_example2',problem_outputex2='$output_example2',problem_inputex3='$input_example3',problem_outputex3='$output_example3'
where problem_id='$problem_id'
";

if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/admin/problem_admin?page=$page';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>