<?php
/* @var $this yii\web\View */
?>
<h1>文章列表</h1>
<?php
echo \yii\helpers\Html::a('添加管理员',['add'],['class'=>"btn btn-info"]);
?>

    <!--数据显示表格-->
    <table class="table table-hover" id="tab">
        <tr style="font-size: 18px;font-weight: bold;" id="th">
            <td>ID</td>
            <td>用户名</td>
            <td>密码</td>
<!--            <td>加盐</td>-->
<!--            <td>邮箱</td>-->
<!--            <td>token</td>-->
<!--            <td>token_time</td>-->
            <td>注册时间</td>
<!--            <td>最后登陆时间</td>-->
<!--            <td>登陆IP</td>-->
            <td>操作</td>
        </tr>

        <?php foreach ($admins as $admin):?>
            <tr>
                <td><?=$admin->id ?></td>
                <td><?=$admin->username ?></td>
                <td><?=$admin->password ?></td>
<!--                <td>--//=$admin->salt ?><!--</td>-->
<!--                <td>--//=$admin->email ?><!--</td>-->
<!--                <td>--<//=$admin->token ?><!--</td>-->
<!--                <td>--//=$admin->token_create_time ?><!--</td>-->
                <td><?=date('Y-m-d H:s:i',$admin->addtime)?></td>
<!--                <td>//=$admin->date('Y-m-d H:s:i',$admin->last_lg_time) ?><!--</td>-->
<!--                <td>--//=$admin->last_lg_ip ?><!--</td>-->
                <td>
                    <?php
                    echo \yii\bootstrap\Html::a('修改',['admin/edit?id='.$admin->id],['class'=>'btn btn-info']);
                    echo "&nbsp;";
                    echo \yii\bootstrap\Html::a('删除',['admin/del?id='.$admin->id],['class'=>'btn btn-danger']);
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

