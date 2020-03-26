<?php
header("Content-Type: text/html;charset=utf-8");

if(isset($_POST["user_name"]))
    $user_name = $_POST["user_name"];
if(isset($_POST["user_mail"]))
    $user_mail = $_POST["user_mail"];
if(isset($_POST["user_passwd"]))
    $user_passwd = $_POST["user_passwd"];
if(isset($_POST["re_passwd"]))
    $re_passwd = $_POST["re_passwd"];


if ("$re_passwd" != "$user_passwd") {
    echo "<script>alert('请检查两次输入的密码是否一致');history.back();</script>";
} else {
    include '../conn.php';
    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
    if (!$conn) {
        exit("连接失败: " . $conn->connect_error);
    }
    $conn->query("set names 'utf8'");
    $md5 = md5(md5($user_passwd));
    $sql = "INSERT INTO user (user_mail, user_name , user_passwd,user_create_time)
			VALUES ('$user_mail' , '$user_name' , '$md5',now())";
    if (mysqli_query($conn, $sql))
    {
        $dir = iconv("UTF-8", "GBK","../../images/avatar/".$user_mail);
        if(!is_dir($dir))
            mkdir ($dir,0777,true);
        echo "<script>alert('注册成功!');</script>";
        echo "<script>url=\"/\";window.location.href=url;</script>";
    }
    else {
        //echo $conn->error;
        echo "<script>alert('该邮箱已注册,可直接登录');</script>";
        echo "<script>url=\"/\";window.location.href=url;</script>";
    }
    $conn->close();
}
?>