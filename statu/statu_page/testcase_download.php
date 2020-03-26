<?php
if(isset($_GET["problem_id"]))
    $problem_id = $_GET["problem_id"];
date_default_timezone_set("PRC");
include "../../functions/user_judger.php";
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}

$str = "select user_casedownload_times from user where user_mail='$user_mail'";
$conn->query("set names 'utf8'");
$result = $conn->query($str);
$flag = 1;
while (list($times) = $result->fetch_row())
{
    if($times == 0)
    {
        echo "<script>alert('您本周的测试样例下载次数为0，快去刷题升级吧！');history.back()</script>";
    }
    else {

        //times - 1
        $conn1 = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
        if (!$conn1) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = "update user set user_casedownload_times=user_casedownload_times-1 where user_mail='$user_mail'";
        if (!mysqli_query($conn1, $sql))
        {

            echo "<script>alert('保存失败');history.back();</script>";
            exit;
        }
        $file_name = "test_case.zip";
        $file_dir = "../../judger/test_case/" . $problem_id."/";
        //检查文件是否存在
        if (!file_exists($file_dir . $file_name)) {
            header('HTTP/1.1 404 NOT FOUND');
        } else {
            //以只读和二进制模式打开文件
            $file = fopen($file_dir . $file_name, "rb");
            //告诉浏览器这是一个文件流格式的文件
            Header("Content-type: application/octet-stream");
            //请求范围的度量单位
            Header("Accept-Ranges: bytes");
            //Content-Length是指定包含于请求或响应中数据的字节长度
            Header("Accept-Length: " . filesize($file_dir . $file_name));
            //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
            Header("Content-Disposition: attachment; filename=" . $file_name);
            //读取文件内容并直接输出到浏览器
            echo fread($file, filesize($file_dir . $file_name));
            fclose($file);
            exit ();
        }
    }
}

