<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171116_034353_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'auth_key' => $this->string(32)->notNull()->comment('自动登陆'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'email' => $this->string()->notNull()->unique()->comment('邮箱'),
            'tel'=>$this->string(20)->comment('手机号'),
            'default_address'=>$this->integer()->notNull()->defaultValue('0')->comment('默认地址'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('状态'),
            'created_at' => $this->integer()->notNull()->comment('注册时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
            'last_login_ip'=>$this->integer()->comment('最后登陆IP'),
            'last_login_time'=>$this->integer()->comment('最后登陆时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
