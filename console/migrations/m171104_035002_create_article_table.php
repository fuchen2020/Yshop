<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171104_035002_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(30)->notNull()->comment('名称'),
            'type'=>$this->smallInteger()->notNull()->comment('文章分类'),
            'intro'=>$this->string()->comment('简介'),
            'status'=>$this->integer()->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->defaultValue('10')->comment('排序'),
            'addtime'=>$this->integer()->notNull()->comment('发布时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
