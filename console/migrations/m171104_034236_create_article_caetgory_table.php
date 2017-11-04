<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_caetgory`.
 */
class m171104_034236_create_article_caetgory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_caetgory', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(30)->notNull()->comment('名称'),
            'intro'=>$this->string()->comment('简介'),
            'status'=>$this->integer()->notNull()->comment('状态'),
            'sort'=>$this->smallInteger()->notNull()->defaultValue('10')->comment('排序'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_caetgory');
    }
}
