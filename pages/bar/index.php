<!--不同用户的导航栏-->
<?php
$flag = 1; //判断用户身份是否过期
if (isset($_SESSION['admin_name'])) {
    $user_mail = $_SESSION['admin_mail'];
    $user_name = $_SESSION['admin_name'];
    $flag = 0;
} else if (isset($_SESSION['teacher_mail'])) {
    $user_mail = $_SESSION['teacher_mail'];
    $user_name = $_SESSION['teacher_name'];
    $flag = 0;
} else if (isset($_SESSION['LV0_mail'])) {
    $user_mail = $_SESSION['LV0_mail'];
    $user_name = $_SESSION['LV0_name'];
    $flag = 0;
} else if (isset($_SESSION['LV1_mail'])) {
    $user_mail = $_SESSION['LV1_mail'];
    $user_name = $_SESSION['LV1_name'];
    $flag = 0;
} else if (isset($_SESSION['LV2_mail'])) {
    $user_mail = $_SESSION['LV2_mail'];
    $user_name = $_SESSION['LV2_name'];
    $flag = 0;
} else if (isset($_SESSION['LV3_mail'])) {
    $user_mail = $_SESSION['LV3_mail'];
    $user_name = $_SESSION['LV3_name'];
    $flag = 0;
} else if (isset($_SESSION['LV4_mail'])) {
    $user_mail = $_SESSION['LV4_mail'];
    $user_name = $_SESSION['LV4_name'];
    $flag = 0;
} else if (isset($_SESSION['LV5_mail'])) {
    $user_mail = $_SESSION['LV5_mail'];
    $user_name = $_SESSION['LV5_name'];
    $flag = 0;
} else if (isset($_SESSION['LV6_mail'])) {
    $user_mail = $_SESSION['LV6_mail'];
    $user_name = $_SESSION['LV6_name'];
    $flag = 0;
}
if ($flag == 0) {
    $servername = '127.0.0.1';
    $dbusername = 'root';
    $dbpasswd = '1021822981';
    $dbname = 'onlineJudge';
    $conn = new mysqli($servername, $dbusername, $dbpasswd, $dbname);
    if (!$conn) {
        die("连接失败: " . $conn->connect_error);
    }
    $conn->query("set names 'utf8'");
    $sql = "select user_judgement,user_cheat from user where user_mail = '$user_mail' limit 1";
    $result = $conn->query($sql);
    //echo $conn->error;
    while (list($user_judgement, $user_cheat) = $result->fetch_row()) {
        $judgement = $user_judgement;
        $cheat = $user_cheat;
    }
    $result->close();
    $conn->close();

}
if (isset($_SESSION['admin_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    echo "<strong><i>";
    echo $_SESSION['admin_name'];
    echo "</strong></i>";
    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='../../admin/problem_admin' target='_blank' style='border:0px;border-radius: 0px;'>系统管理</a></li>
                           
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['teacher_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    echo "<strong><i>";
    echo $_SESSION['teacher_name'];
    echo "</strong></i>";
    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/teacher_admin/problem_admin' target='_blank' style='border:0px;border-radius: 0px;'>教务管理</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV0_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV0_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV0_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #ADADAD;\">";//灰白
            echo $_SESSION['LV0_name'];
            echo "</font></strong>";
        }
    }
    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV1_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV1_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV1_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #000000;\">";//黑色
            echo $_SESSION['LV1_name'];
            echo "</font></strong>";
        }
    }

    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV2_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";

    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV2_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV2_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #73BF00;\">";//绿色
            echo $_SESSION['LV2_name'];
            echo "</font></strong>";
        }
    }

    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV3_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";

    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV3_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV3_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #0000E3;\">";//蓝色
            echo $_SESSION['LV3_name'];
            echo "</font></strong>";
        }
    }

    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV4_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";

    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV4_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV4_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #FF9224;\">";//橙色
            echo $_SESSION['LV4_name'];
            echo "</font></strong>";
        }
    }

    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV5_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV5_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV5_name'];
            echo "</font></strong>";
        } else {
            echo "<strong><font style=\"color: #DC143C;\">";//红色
            echo $_SESSION['LV5_name'];
            echo "</font></strong>";
        }
    }

    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else if (isset($_SESSION['LV6_name'])) {
    echo "<ul class='nav navbar-nav navbar-right''>
                            <li class='dropdown'><a href='/' class='dropdown-toggle' data-toggle='dropdown'role='button'aria-haspopup='true'aria-expanded='false'>";
    if ($cheat == 1) {
        echo "<strong><font style=\"color: #8B4513;\">";//棕色
        echo $_SESSION['LV6_name'];
        echo "</font></strong>";
    } else {
        if ($judgement == 1) {
            echo "<strong><font style=\"color: #48D1CC;\">";//青色
            echo $_SESSION['LV6_name'];
            echo "</font></strong>";
        } else {
            echo "";
            echo "<strong><font style=\"color: #800080;\">";//紫色
            echo $_SESSION['LV6_name'];
            echo "</font></strong>";
        }
    }
    echo "<span class='caret'></span></a>
                             <ul class='dropdown-menu' id='public_user_drop '  style='min-width: 135px;'>
                            <li ><a  href='/pages/user_index' style='border:0px;border-radius: 0px;'>资料卡</a></li>
                            <li ><a href='/pages/user_setting' style='border:0px;border-radius: 0px;'>设置</a></li>
                            <li ><a href='/F.A.Q/judge_info' style='border:0px;border-radius: 0px;' target='_blank'>F.A.Q</a></li>
                            <li ><a href='/functions/login_out' style='border:0px;border-radius: 0px;'>Logout</a></li>
                            </ul>
                            </li>
                            </ul>";
} else {
    echo "<ul class='nav navbar-nav navbar-right' id='nav-right'>
                            <li><a id='modal-344154' href='#modal-container-344154'role='button' class='btn' data-toggle='modal'>Login</a></li>
                            <li><a  href='#modal-container-344151' id='modal-344151' role='button' class='btn' data-toggle='modal'>Register</a></li>
                            </ul>";
}
?>
<!--不同用户的导航栏-->