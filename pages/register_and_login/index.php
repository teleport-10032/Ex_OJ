<?php

echo "
<!--登录注册-->
<div class=\"modal fade\" id=\"modal-container-344154\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                <h4 class=\"modal-title\" id=\"myModalLabel\">
                    Login
                </h4>
            </div>
             <form action=\"/functions/login/index.php\" method=\"post\">
                                <div class=\"modal-body\">
                                    <img src=\"/images/logo.gif\" width=\"100px\"  height=\"100px\" style=\"float: right ;margin-right: 100px\">
                                    <div class=\"account-input\">
                                        <input type=\"mail\" name=\"user_mail\" id=\"user_mail\" placeholder=\" 邮箱\" required/>
                                    </div>
                                    <div class=\"account-input\">
                                        <input type=\"password\" name=\"user_passwd\" id=\"user_passwd\" placeholder=\" 密码\"required/>
                                    </div>

                            </div>

                            <div class=\"modal-footer\">
                                <a id=\"modal-344152\" href=\"#modal-container-344152\"  data-toggle=\"modal\" href=\"\" style=\"padding-right: 260px\">忘记密码</a>
                                
                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">关闭</button> <button type=\"submit\" class=\"btn btn-primary\" id=\"login\" onclick=\"logincheck()\">登录</button>
                            </div>
                            </form>
        </div>

    </div>

</div>

<div class=\"modal fade\" id=\"modal-container-344151\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                <h4 class=\"modal-title\" id=\"myModalLabel1\">
                    Register
                </h4>
            </div>
            <form action=\"/functions/register/index.php\" method=\"post\">
                <div class=\"modal-body\">
                    <img src=\"/images/logo.gif\" width=\"200px\"  height=\"200px\" style=\"float: right ;\">
                        <div class=\"account-input\">
                            <input type=\"email\" name=\"user_mail\"  placeholder=\" 邮箱(可通过此项找回密码)\" required/>
                        </div>
                        <div class=\"account-input\">
                            <input type=\"text\" name=\"user_name\" id=\"user_name\" placeholder=\" 用户名\" required/>
                        </div>
                        <div class=\"account-input\">
                            <input type=\"password\" name=\"user_passwd\" id=\"user_passwd\" minlength='6' placeholder=\" 密码\" required/>
                        </div>
                        <div class=\"account-input\">
                            <input type=\"password\" name=\"re_passwd\" id=\"re_passwd\" minlength='6' placeholder=\" 确认\" required/>
                        </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">关闭</button> <button type=\"submit\" class=\"btn btn-primary\" >注册</button>
                </div>
                </form>
        </div>

    </div>

</div>




<div class=\"modal fade\" id=\"modal-container-344152\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                <h4 class=\"modal-title\" id=\"myModalLabel\">
                   忘记密码
                </h4>
            </div>
            
            
            <form action=\"/functions/mail_sender.php\" method=\"post\">
                <div class=\"modal-body\">
    <div class=\"row clearfix\">
            <form class=\"form-horizontal\" role=\"form\" action='../../functions/mail_sender.php' target='_blank'>
                <div class=\"form-group\">
                     <label for=\"inputEmail3\" class=\"col-sm-3 control-label\" style=\"padding-top: 15px;\" >邮箱：</label>
                    <div class=\"col-sm-8\">
                        <input type=\"email\" class=\"form-control\" name='user_mail' id=\"inputEmail3\" />
                    </div>
                </div>

                <div class=\"form-group\">
                    <div class=\"col-sm-offset-2 col-sm-8\">

                        <button type=\"submit\" class=\"btn btn-default\" style=\"margin-top: 12px;\">获取验证码 </button>
                    </div>
            </form>
    
            
        </div>
    </div>
</div>
               </div>
                <div class=\"modal-footer\">
                </div>
            </form>
        </div>

    </div>

</div>
";


//
//
//<div class="form-group">
//                     <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 15px;">新密码：</label>
//                    <div class="col-sm-8">
//                        <input type="password" class="form-control" id="inputPassword3" />
//                    </div>
//                </div>
//                <div class="form-group">
//                     <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 15px;">确认新密码：</label>
//                    <div class="col-sm-8">
//                        <input type="password" class="form-control" id="inputPassword3" />
//                    </div>
//                </div>

//echo "
//<div class=\"modal fade\" id=\"modal-container-344154\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
//    <div class=\"modal-dialog\">
//        <div class=\"modal-content\">
//            <div class=\"modal-header\">
//                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
//                <h4 class=\"modal-title\" id=\"myModalLabel\">
//                    Login
//                </h4>
//            </div>
//
//            <form action=\"/functions/login/index.php\" method=\"post\">
//                <div class=\"modal-body\">
//<!--                    <img src=\"images/logo.gif\" width=\"100px\" height=\"100px\" style=\"float: right ;margin-right: 100px\">-->
//                    <div class=\"account-input\">
//                        <p align=\"center\">
//                            <input type=\"mail\" name=\"user_mail\" id=\"user_mail\" placeholder=\" 邮箱\" required/>
//                        </p>
//                    </div>
//                    <div class=\"account-input\">
//                        <p align=\"center\">
//                        <input type=\"password\" name=\"user_passwd\" id=\"user_passwd\" placeholder=\" 密码\" required/>
//                        </p>
//                    </div>
//                </div>
//
//                <div class=\"modal-footer\">
//                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">关闭</button>
//                    <button type=\"submit\" class=\"btn btn-primary\" id=\"login\" onclick=\"logincheck()\">登录</button>
//                </div>
//
//            </form>
//        </div>
//    </div>
//</div>
//<div class=\"modal fade\" id=\"modal-container-344151\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
//    <div class=\"modal-dialog\">
//        <div class=\"modal-content\">
//            <div class=\"modal-header\">
//                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
//                <h4 class=\"modal-title\" id=\"myModalLabel1\">
//                    Register
//                </h4>
//            </div>
//            <form action=\"/functions/register/index.php\" method=\"post\">
//                <div class=\"modal-body\">
//                    <img src=\"/images/logo.gif\" width=\"200px\" height=\"200px\" style=\"float: right ;\">
//                    <div class=\"account-input\">
//                        <input type=\"email\" name=\"user_mail\" id=\"user_mail\" placeholder=\" 邮箱\" required/>
//                    </div>
//                    <div class=\"account-input\">
//                        <input type=\"text\" name=\"user_name\" id=\"user_name\" placeholder=\" 用户名\" required/>
//                    </div>
//                    <div class=\"account-input\">
//                        <input type=\"password\" minlength=\"6\" name=\"user_passwd\" id=\"user_passwd\" placeholder=\" 密码\" required/>
//                    </div>
//                    <div class=\"account-input\">
//                        <input type=\"password\" minlength=\"6\" name=\"re_passwd\" id=\"re_passwd\" placeholder=\" 确认\" required/>
//                    </div>
//                </div>
//                <div class=\"modal-footer\">
//                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">关闭</button>
//                    <button type=\"submit\" class=\"btn btn-primary\">注册</button>
//                </div>
//            </form>
//        </div>
//    </div>
//</div>
//";
//?>