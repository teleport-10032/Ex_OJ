<?php
date_default_timezone_set("PRC");
header("Content-Type: text/html;charset=utf-8");
include "../../functions/user_judger.php";
include "../../admin/admin_judge.php";
function input_csv($handle)
{
    $out = array ();
    $n = 0;
    while ($data = fgetcsv($handle, 10000))
    {
        $num = count($data);
        for ($i = 0; $i < $num; $i++)
        {
            $out[$n][$i] = $data[$i];
        }
        $n++;
    }
    return $out;
}

include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
$conn->query("set names 'utf8'");
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$filename = $_FILES['f1']['tmp_name'];
$handle = fopen($filename, 'r');
$result = input_csv($handle);
$len_result = count($result);
if($len_result==0)
{
    echo "<script>alert('无任何数据需要导入');history.back();</script>";
    //echo "<script>alert('无任何数据需要导入');</script>";
    exit;
}
$flag = 1;
for($i = 1; $i < $len_result; $i++) //循环获取各字段值
{
    $user_mail = iconv('gb2312', 'utf-8', $result[$i][0]);
    $user_name = iconv('gb2312', 'utf-8', $result[$i][1]);
    $user_realname = iconv('gb2312', 'utf-8', $result[$i][2]);
    $user_passwd = iconv('gb2312', 'utf-8', $result[$i][3]);
    $user_passwd = md5(md5($user_passwd));
    if($user_mail == "" || $user_name == "" || $user_passwd == "")
    {
        echo "<script>alert('部分记录没有导入成功，请检查格式是否正确')</script>";
    }
    else
    {
        $sql = "insert into user (user_mail,user_name,user_realname,user_passwd,user_permission,user_create_time) values ('$user_mail','$user_name','$user_realname','$user_passwd','LV0',now())";
        if (!mysqli_query($conn, $sql)) {
            $flag = 0;
        }
    }
};

if ($flag == 1)
{
    //echo $conn->error;
    echo "<script>alert('导入成功')</script>";
    echo "<script>url=\"/admin/user_plugin\";window.location.href=url;</script>";
}
else {
    //echo $conn->error;
    echo "<script>alert('导入失败，可能格式错误或其中某些邮箱已被注册');history.back();</script>";
    //echo "<script>alert('导入失败，可能格式错误或其中某些邮箱已被注册');</script>";
}
$conn->close();