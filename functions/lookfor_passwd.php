<?php
header("Content-Type: text/html;charset=utf-8");
if(isset($_GET["user_mail"]))
    $user_mail = $_GET["user_mail"];
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="icon" href="/images/title.ico" type="image/x-icon"/>
    <title>Setting|Excalibur OJ
    </title>
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/Public_users.css">
    <script src="/bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        article {
            margin-top: 50px;
            padding-bottom: 20px;
            height: auto;
        }

        #nav-right1 li a:hover {
            color: green;
            border: 2px solid green;
        }

        #nav-right1 .open > a, #nav-right1 .open > a:focus, #nav-right1 .open > a:hover {
            background-color: #eee;
            border-color: green;
            /*border: 2px solid green;*/
        }

        /*#nav-right1普通用户的右侧导航栏样式 绿色*/
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
                <li class="reactive"><a href="#">重置密码</a></li>
            </ul>
        </div>
    </div>
</nav>
<!--导航栏-->

<!--主体-->
<article id="wrapper">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="row clearfix" style="margin-top: 20px;">
                    <div class="col-md-10 column">
                        <div class="alert alert-dismissable alert-success">
                            <h4>
                                <?php
                                echo "您的账号:".$user_mail;
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabbable" id="tabs-712861" style="margin-top: 20px;">
            <ul class="nav nav-tabs">

            </ul>
            <div class="tab-content">

                <div class="active" id="panel-278949">
                    <div class="col-md-6 column">
                        <h4>重置密码</h4>
                        <!--表单2-->
                        <form role="form" action="reset_passwd.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="password" maxlength="20" minlength="6" name="newpasswd" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm New Password</label>
                                <input type="password" maxlength="20" name="repasswd" minlength="6" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Verification code</label>
                                <input type="text" maxlength="20" name="veri" class="form-control"/>
                            </div>
                            <!--                            隐藏，传值用-->
                            <?php
                            echo " <input type=\"hidden\" value='$user_mail' maxlength=\"20\" name=\"user_mail\" class=\"form-control\"/>";
                            ?>
                            <!--                            隐藏，传值用-->
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
</article>
<!--主体-->


<!--页脚-->
<?php
include "../pages/footer/index.php";
?>
<!--页脚-->

</body>
</html>
