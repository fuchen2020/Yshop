<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>东京商城---登陆</title>

   <style>
       body {
           background:url(../images/login_bg_0.jpg) #f8f6e9;
       }

       .signin {
           width:477px;
           height:479px;
           background:url(../images/login_bg.png) no-repeat;
           margin:0 auto;

           position:absolute;
           top:50%;
           left:50%;
           margin-top:-239px;
           margin-left:-238px;
       }
       .signin-head {
           margin:0 auto;
           padding-top:30px;
           width:120px;
       }
       .form-signin {
           max-width: 330px;
           padding: 43px 15px 15px 15px;
           margin: 0 auto;
       }
       .form-signin .checkbox {
           margin-bottom: 10px;
       }
       .form-signin .checkbox {
           font-weight: normal;
       }
       .form-signin .form-control {
           position: relative;
           font-size: 16px;
           height: auto;
           padding: 10px;
           -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
           box-sizing: border-box;
       }
       .form-signin .form-control:focus {
           z-index: 2;
       }
       .form-signin input[type="text"] {
           margin-bottom: 14px;
           border-radius: 0;
           background: url(../images/login_user.png) 0 0 #bdbdbd no-repeat;
           padding-left:60px;
           color:#FFFFFF;
       }
       .form-signin input[type="password"] {
           margin-bottom: 10px;
           border-radius: 0;
           background: url(../images/login_pas.png) 0 0 #bdbdbd no-repeat;
           padding-left:60px;
           color:#FFFFFF;
       }
       .form-signin button {
           border-radius: 0;
       }
   </style>

</head>

<body>

<div class="signin">
    <div class="signin-head"><img src="/images/test/head_120.png" alt="" class="img-circle"></div>
    <form class="form-signin" role="form" action="login" method="post">
        <input type="text" class="form-control" placeholder="用户名" name="username" required autofocus />
        <input type="password" class="form-control" name="password" placeholder="密码" required />
        <button class="btn btn-lg btn-warning btn-block" type="submit">登录</button>
        <label class="checkbox">
            <input type="checkbox" value="1" name="rememberMe"> 自动登陆
        </label>
    </form>
</div>
</div>
</body>
</html>