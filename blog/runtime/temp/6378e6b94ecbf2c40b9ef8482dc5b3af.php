<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\mysite\blog\public/../application/admin\view\login\index.html";i:1537949300;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>管理员登录</title>
    <style>
        body {
            background: #055a5b;
        }

        .title-logo {
            height: 180px;
        }

        .title-logo h2 {
            font-size: 66px;
            font-weight: bold;
            text-align: center;
            line-height: 180px;
            background: -webkit-linear-gradient(left, #147B96, #fff 25%, #147B96 50%, #fff 75%, #147B96);
            color: transparent;
            -webkit-background-clip: text;
            background-size: 200% 100%;
            animation: masked-animation 2.5s infinite linear;
        }

        @-webkit-keyframes masked-animation {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: -100% 0;
            }
        }

        .login {
            width: 330px;
            height: auto;
            background-color: #fff;
            margin: 0 auto;
            border-radius: 5px;
            padding: 30px 50px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, .2);
        }

        @media (max-width: 767px) {
            .login {
                width: 83%;
            }
        }

        .login h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-input {
            width: 100%;
            overflow: hidden;
            /*height: 70px;*/
            position: relative;
        }

        .login-input label {
            color: #555;
        }

        .login-input input[type="text"],
        .login-input input[type="password"] {
            width: 100%;
            border: 0;
            display: block;
            padding: 5px;
            font-size: 15px;
            border-bottom: 1px solid #aaa;
        }

        .login-input input[type="text"]:focus,
        .login-input input[type="password"]:focus {
            outline: 0;
            border-bottom: 2px solid #055a5b;
        }

        .login-input input[type="submit"] {
            border: 1px solid #888;
            background: transparent;
            padding: 10px;
            width: 50%;
            margin: 0 auto;
            display: block;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 50px;
            transition: all 0.5s ease-in-out;
        }

        .login-input input[type="submit"]:hover {
            background-color: #055a5b;
            border: 1px solid #fff;
            color: #fff;
        }

        .mp30 {
            margin-top: 30px;
        }

        #vcode {
            width: 50%;
            margin-left: 0;
        }
        label.error{
            color:red;
            font-size:15px;
        }
        
    </style>
</head>
<body>
<div class="title-logo">
    <h2>MANGYU</h2>
</div>
<div class="login">
    <h2>管理员登录</h2>
    <form action="?" method="post">
        <p class="login-input">
            <label for="name">用户名</label>
            <input type="text" name="userName" id="name">
        </p>
  
        <p class="login-input">
            <label for="pwd">密码</label>
            <input type="password" name="password" id="pwd">
        </p>
        <p class="login-input">
            <label for="vcode">验证码</label>
            <span>
                <input type="text" name="vcode" id="vcode" style="width: 120px">
                <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>?' + Math.random();" style="position: absolute; right: 0px;top: 0px;  height: 45px; width: 100px; cursor: pointer/*让鼠标变成手指形状*/ "/>
          </span>
        </p>
        <p class="mp30 text-center">
            <input class="btn btn-success" type="submit" value="登录">
        </p>
    </form>
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#myModal').hide()">确定</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/jquery.validate.min.js"></script>
<script src="/static/admin/js/login.js"></script>

</html>