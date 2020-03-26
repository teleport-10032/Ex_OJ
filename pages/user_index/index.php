<?php

date_default_timezone_set("PRC");

header("Content-Type: text/html;charset=utf-8");

include '../../functions/user_judger.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>User Home|Excalibur OJ
    </title>

    <link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/Public_users.css">
    <script src="../../bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            margin-top: 50px;
            padding-bottom: 20px;
            height: auto;
        }

        #nav-right li a:hover {
            color: green;
            border: 2px solid green;
        }

        /*.nav .open > a, .nav .open > a:focus, .nav .open > a:hover {*/
            /*background-color: #eee;*/
            /*border-color: blue;*/
            /*!*border: 2px solid green;*!*/
        /*}*/
    </style>
</head>
<body>


<!--导航栏-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Excalibur Online Judge</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" id="nav-center">
                <li class="reactive"><a href="/">۩ Home </a></li>
                <li><a href="/board/board">◄): Board</a></li>
                <li><a href="/problem/problems">✎ Problems</a></li>
                <li><a href="/contest/contests"> ♛ Contests</a></li>
                <li><a href="/statu/status"> ❖ Status</a></li>
                <li><a href="/rank"> ➹ Rank</a></li>
            </ul>
            <!--不同用户的导航栏-->
            <?php
            include "../bar/index.php";
            ?>
            <!--不同用户的导航栏-->
        </div>
    </div>
</nav>
<!--导航栏-->

<?php
if (isset($_GET['mail'])) {
    $user_mail = $_GET['mail'];
}
//echo $user_mail;
include "../../functions/conn.php";
$conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
if (!$conn) {
    die("连接失败: " . $conn->connect_error);
}
$conn->query("set names 'utf8'");
$sql = "select user_name,user_avatar_path,user_AC_NUM,user_ALL_NUM,user_cheat,user_judgement,user_permission,user_introduction,user_major,user_github,user_exp from user where user_mail = '$user_mail' limit 1";
$result = $conn->query($sql);
//echo $conn->error;
while (list($user_name,$user_avatar_path,$user_AC_NUM, $user_ALL_NUM,$user_cheat,$user_judgement,$user_permission,$user_introduction,$user_major,$user_github,$user_exp) = $result->fetch_row()) {
    $name=$user_name;
    $avatar_path = $user_avatar_path;
    $AC_NUM = $user_AC_NUM;
    $ALL_NUM = $user_ALL_NUM;
    $cheat = $user_cheat;
    $judgement = $user_judgement;
    $permission = $user_permission;
    $introduction = $user_introduction;
    $major = $user_major;
    $github = $user_github;
    $exp = $user_exp;
}
$conn->close();
$result->close();
?>


<!--主体-->
<article id="wrapper" style="width: 60%;">
    <div align="center">
        <?php
        echo "<img alt=\"140x140\" src=\"".$avatar_path."\" class=\"img-circle\"
             style=\"width: 150px; height: 150px; border: 1px solid gray; margin-top:10px;\">";
        ?>
    </div>
    <div style="height: 20px;"></div>
    <div align="center" style="font-size: 25px;">
        <?php
        if($cheat == 1)
            echo "<p style='color: #8B4513;'>".$name."</p>";
        else
        {
            if($judgement == 1)
                echo "<p style=\"color: #48D1CC;\">".$name."</p>";
            else
            {
                if($permission == 'LV0')
                    echo "<p style=\"color: #ADADAD;\">".$name."</p>";
                else if($permission == 'LV1')
                    echo "<p style=\"color: #000000;\">".$name."</p>";
                else if($permission == 'LV2')
                    echo "<p style=\"color: #73BF00;\">".$name."</p>";
                else if($permission == 'LV3')
                    echo "<p style=\"color: #0000E3;\">".$name."</p>";
                else if($permission == 'LV4')
                    echo "<p style=\"color: #FF9224;\">".$name."</p>";
                else if($permission == 'LV5')
                    echo "<p style=\"color: #DC143C;\">".$name."</p>";
                else if($permission == 'LV6')
                    echo "<p style=\"color: #800080;\">".$name."</p>";
                else
                    echo "<b><i>".$name."</i></b>";
            }

        }
        ?>
        <?php
        echo "<span class=\"label label-success\" style=\"font-size: 5px;\">$permission</span>";
        ?>
    </div>
    <?php
    echo "<div align=\"center\" style=\"height: 20px;\">$introduction</div>";

    //下面计算所持经验溢出多少 还剩多少升级 以及经验条进度
    $y = 0 ; $s = 0; $b = 0;
    if($exp >= 12000)
    {
        $y = $exp % 12000;
        $s = 99999999;
        $b = 100;
    }
    else if($exp >= 6480)
    {
        $y = $exp % 6480;
        $s = 5520 - $y;
        if($y != 0)
            $b =  $y / 5520;
        else
            $b = 0;
        $b *= 100;
    }
    else if($exp >= 3200)
    {
        $y = $exp % 3200;
        $s = 3280 - $y;
        if($y != 0)
            $b = $y / 3280;
        else
            $b = 0 ;
        $b *= 100;
    }
    else if($exp >= 1500)
    {
        $y = $exp % 1700;
        $s = 1700 - $y;
        if($y != 0)
            $b = $y / 1700;
        else
            $b = 0;
        $b *= 100;
    }
    else if($exp >= 200)
    {
        //LV2
        $y = $exp % 200;
        $s = 1300 - $y;
        if($y != 0)
            $b = $y / 1300;
        else
            $b = 0;
        $b *= 100;
    }
    else
    {
        //LV 1
        $y = $exp;
        $s = 200 - $exp;
        if($y != 0)
            $b = $y / 200;
        else
            $b = 0;
        $b *= 100;
    }

    ?>
    <div class="row">
        <div class="col-md-2 column" >
        </div>
        <div class="col-md-2 column">
        </div>
        <div class="col-md-1 column" style="font-size: 12px;">
        </div>

        <div class="col-md-2 column" style="margin-top: 10px;">
            <div class="progress progress-striped" style="margin-bottom: 5px;">

                <?php
                if($permission != "LV6" && $permission != "teacher"  && $permission != "admin" && $permission != "LV0")
                    echo "
                    <div class=\"progress-bar progress-bar-success\" role=\"progressbar\"
                         aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"
                         style=\"width: $b%;\">
                    ";
                else
                {
                    echo "
                    <div class=\"progress-bar progress-bar-success\" role=\"progressbar\"
                         aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\"
                         style=\"width: 100%;\">
                    ";
                }
                ?>

                </div>
            </div>
        </div>

        <div class="col-md-2 column">
        </div>
        <div class="col-md-2 column">
        </div>
        <div class="col-md-1 column" style="font-size: 12px;">

        </div>
    </div>
    <div align="center" class="row text-center" style="font-size: 10px;">
        <?php
        if($permission != "LV6" && $permission != "teacher"  && $permission != "admin" && $permission != "LV0")
        {
            $q = $exp + $s;
            echo "$exp"."/"."$q";
        }
        else
        {
            echo "Max_Level";
        }
        ?>

    </div>
    <div style="height: 20px;"></div>
    <hr style=" margin: 0 auto;width: 80%; height:1px;border:none;border-top:1px solid #c9c9c9;"/>
    <div style="height: 20px;"></div>

    <div class="row">

        <div class="col-md-6 text-center" style="border-right: 1px solid #c9c9c9">
            <h4>Solved</h4>
            <?php
            echo "$AC_NUM";
            ?>
        </div>

        <div class="col-md-6 text-center">
            <h4>Submissions</h4>
            <?php
            echo "$ALL_NUM";
            ?>
        </div>

    </div>


    <div style="height: 20px;"></div>
    <hr style=" margin: 0 auto;width: 80%; height:1px;border:none;border-top:1px solid #c9c9c9;"/>
    <div style="height: 20px;"></div>

    <div class="row">

        <div class="col-md-6 text-center" style="border-right: 1px solid #c9c9c9">
            <h4>Major</h4>
            <?php
            if(ltrim($major)!="")
                echo "$major";
            else
                echo "未填写";
            ?>
        </div>

        <div class="col-md-6 text-center">
            <h4>Github</h4>
            <?php
            if(ltrim($github)!= "")
                echo "<a href='http://$github' target='_blank'>$github</a>";
            else
                echo "未填写";
            ?>
        </div>

    </div>

    <div style="height: 20px;"></div>
    <hr style=" margin: 0 auto;width: 80%; height:1px;border:none;border-top:1px solid #c9c9c9;"/>
    <div style="height: 20px;"></div>


    <div style="height: 20px;"></div>
</article>
<!--主体-->

<!--页脚-->
<?php
include "../../pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>