<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Reset Passwd|Excalibur OJ
    </title>
</head>
<body>
</body>
<?php

header("Content-Type: text/html;charset=utf-8");
if(isset($_POST["user_mail"]))
{
    $user_mail = $_POST["user_mail"];
}

function sendMail($to,$title,$content) {

    if(isset($_POST["user_mail"]))
    {
        $user_mail = $_POST["user_mail"];
    }
    if($user_mail == "")
    {
        echo "<script>alert('请输入正确的邮箱');history.back()</script>";
        exit;
    }


    require '../PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.qq.com';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = '1021822981@qq.com';
    // 这个就是之前得到的授权码，一共16位
    $mail->Password = 'arfhdowgmbrkbeif';

    $mail->SMTPSecure = 'ssl';
    // //设置ssl连接smtp服务器的远程服务器端口号，可选465或587
    $mail->Port = 465;

    //编码需要修改自行修改
    $mail->CharSet = 'UTF-8';
    //emil 发送方的邮箱账户和发送的标题
    $mail->setFrom('1021822981@qq.com', '标题');

    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->Subject = $title;

    $mail->Body = $content;

    if(!$mail->send()) {
        echo "<script>alert('请输入正确的邮箱');history.back()</script>";
        exit;
    } else {
        echo "<script>alert('发送成功！请查收')</script>";
        echo "<script>url=\"/functions/lookfor_passwd.php?user_mail=$user_mail\";window.location.href=url;</script>";
    }
}

$v = rand(100000, 999999);

session_start();
$_SESSION['veri'] = $v;
// 调用发送方法，并在页面上输出发送邮件的状态 （接收方邮箱地址，标题，内容）
sendMail("$user_mail",'请查收来自ex_oj的六位验证码！',"$v"."(若不是您主动发送请忽略）");

