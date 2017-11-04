<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_content`.
 */
class m171104_035550_create_article_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_content', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->integer()->notNull()->comment('文章ID'),
            'content'=>$this->text()->comment('文章内容')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_content');
    }
}
