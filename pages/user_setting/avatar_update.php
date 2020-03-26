<?php
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set("PRC");
include "../../functions/user_judger.php";
//文件上传
if ((($_FILES["avatar"]["type"] == "image/png")
        || ($_FILES["avatar"]["type"] == "image/jpeg")
        || ($_FILES["avatar"]["type"] == "image/pjpeg"))
    && ($_FILES["avatar"]["size"] <= 1048576))
{
    if ($_FILES["avatar"]["error"] > 0)
    {
        echo "<script>alert('出大问题!请稍后再试或联系管理员');history.back();</script>";
    }
    else
    {
        $id = $_POST['id'];
        if(($_FILES["avatar"]["type"] == "image/jpeg") || ($_FILES["avatar"]["type"] == "image/pjpeg"))
            $extension = "jpeg";
        $file = $user_mail."/avatar.".$extension;
        if(file_exists($file))
        {
            unlink($file);
        }
        $r = move_uploaded_file($_FILES["avatar"]["tmp_name"],
            "../../images/avatar/"."$user_mail"."/avatar.".$extension);
        $path = "../../images/avatar/"."$user_mail"."/avatar.".$extension;
//        echo "<script>alert('$r');</script>";
//        echo "<script>alert('$id');</script>";
//        echo "<script>alert('$path');</script>";
        if($r == 1)
        {
            include "../../functions/conn.php";
            $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
            // 检测连接
            if (!$conn) {
                die("连接失败: " . $conn->connect_error);
            }
            $conn->query("set names 'utf8'");
            $sql = "update user set user_avatar_path='$path' where user_id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('修改成功');</script>";
                echo "<script>url=\"../user_setting\";window.location.href=url;</script>";

            } else {
                echo "<script>alert('出大问题！请重试或联系管理员!');history.back();</script>";
            }
            $conn->close();
        }
        //echo "../../images/avatar/"."$user_mail"."/1.".$extension;
    }
}
else
{
    echo "<script>alert('qwq请上传正确的文件');history.back();</script>";
}
?>