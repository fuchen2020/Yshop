<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171108_075957_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(30)->notNull()->comment('用户名'),
            'password'=>$this->string(32)->notNull()->comment('密码'),
            'Salt'=>$this->string()->notNull()->comment('加盐'),
            'email'=>$this->string(50)->comment('邮箱'),
            'token'=>$this->string(32)->notNull()->comment('自动登陆令牌'),
            'token_create_time'=>$this->integer()->notNull()->comment('令牌创建时间'),
            'addtime'=>$this->integer()->notNull()->comment('注册时间'),
            'last_lg_time'=>$this->integer()->notNull()->comment('最后登陆时间'),
            'last_lg_ip'=>$this->string(15)->notNull()->comment('登陆IP')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
