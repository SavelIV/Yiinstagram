<?php

use yii\db\Migration;

/**
 * Class m201212_231211_alter_news_table
 */
class m201212_231211_alter_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'picture', $this->string(255));
        $this->addColumn('{{%news}}', 'url', $this->string(255)->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropColumn('{{%news}}', 'picture');
        $this->dropColumn('{{%news}}', 'url');
    }

}
