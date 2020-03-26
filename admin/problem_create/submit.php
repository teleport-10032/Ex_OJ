<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../admin_judge.php";
include "../../functions/user_judger.php";

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
    echo "<script>alert('请填写输入样例1');history.back();</script>";
    exit;
}
if($output_example == "")
{
    echo "<script>alert('请填写输出样例1');history.back();</script>";
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

$str = "select user_id from user where user_mail='$user_mail'";
$result = $conn->query($str);
$conn->query("set names 'utf8'");
while (list($user_id) = $result->fetch_row())
{
    $id = $user_id;
}

$sql = "INSERT INTO problem (problem_create_time,problem_author,problem_title, problem_description, problem_input_des,problem_output_des,problem_inputex,problem_outputex,problem_inputex2,problem_outputex2,problem_inputex3,problem_outputex3,problem_hint,problem_source)
                VALUES 
                (now(),'$id','$title' , '$description' , '$input_description','$output_description','$input_example','$output_example','$input_example2','$output_example2','$input_example3','$output_example3','$hint','$source')";
if (mysqli_query($conn, $sql))
{
    echo "<script>alert('保存成功')</script>";
    echo "<script>url='/admin/problem_admin';window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('保存失败');history.back();</script>";
}



$conn->close();


?>