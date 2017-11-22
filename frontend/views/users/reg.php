<?php
/* @var $this yii\web\View */
?>
<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="">用户名：</label>
                        <input type="text" class="txt" name="Users[username]" id="username"/>
                        <p class='state1'>3-20位字符，可由中文、字母、数字和下划线组成</p>
                    </li>
                    <li>
                        <label for="">密码：</label>
                        <input type="password" class="txt" name="Users[password]" id="password" />
                        <p class='state1'>6-20位字符，可使用字母、数字和符号的组合，不建议使用纯数字、纯字母、纯符号</p>
                    </li>
                    <li>
                        <label for="">确认密码：</label>
                        <input type="password" class="txt" name="Users[password]" id="password2"/>
                        <p class='state1'> <span>请再次输入密码</p>
                    </li>
                    <li>
                        <label for="">邮箱：</label>
                        <input type="text" class="txt" name="Users[email]" id="email"/>
                        <p class='state1'>邮箱必须合法</p>
                    </li>
                    <li>
                        <label for="">手机号码：</label>
                        <input type="text" class="txt" value="" name="Users[tel]" id="tel" placeholder=""/>
                        <p class='state1'>手机号码必须合法</p>
                    </li>
                    <li>
                        <label for="">验证码：</label>
                        <input type="text" class="txt" value="" placeholder="请输入短信验证码" name="Users[captcha]" disabled="disabled" id="captcha" onblur="upperCase(this)"/> <input type="button" onclick="bindPhoneNum(this)" id="get_captcha" value="获取验证码" style="height: 25px;padding:3px 8px"/>
                    </li>
                    <li class="checkcode">
                        <label for="">验证码：</label>
                        <input type="text"  name="Users[checkcode]"  id="checkcode"/>
                        <?=\yii\bootstrap\Html::img("@web/images/checkcode1.jpg")?>
                        <span>看不清？<a href="">换一张</a></span>
                        <p class='state1'>输入图形验证码</p>
                    </li>

                    <li>
                        <label for="">&nbsp;</label>
                        <input type="checkbox" class="chb" checked="checked" name="Users[check]" value="1"/> 我已阅读并同意《用户注册协议》
                    </li>
                    <li>
                        <label for="">&nbsp;</label>
                        <input type="submit" value="" class="login_btn"  id="send"/>
                    </li>
                </ul>
            </form>


        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>

    </div>
</div>

<script type="text/javascript">

        function bindPhoneNum(){
            var tel=$('#tel').val();
            //启用输入框
            $('#captcha').prop('disabled',false);
            var time=30;
            var interval = setInterval(function(){
                time--;
                if(time<=0){
                    clearInterval(interval);
                    var html = '获取验证码';
                    $('#get_captcha').prop('disabled',false);
                } else{
                    var html = time + ' 秒后再次获取';
                    $('#get_captcha').prop('disabled',true);
                }

                $('#get_captcha').val(html);
            },1000);
//        console.dir(tel);
            $.get(["sms"], {'tel':tel})
        }
//短信验证码验证
       function upperCase(){
           var tel=$('#tel').val();
           var code=$('#captcha').val();
           if(tel){
               if(code){
                   $.get(["check"], {'code':code,'tel':tel},function (data) {
                        console.dir(data);
                        if(data==="验证成功"){
                            alert("短信验证成功");
                        }else {
                            alert(data);
                        }
                   })
               }else {
                   alert('手机验证码不能为空');
               }
           }else {
               alert('手机号码不能为空');
           }

       }


</script>