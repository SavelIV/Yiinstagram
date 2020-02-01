<?php

use yii\db\Migration;

/**
 * Class m200126_124107_add_index_news_content
 */
class m200126_124107_add_index_news_content extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->execute("ALTER TABLE news ADD FULLTEXT INDEX idx_content (content)");
    }

    public function down()
    {
        $this->dropIndex('idx_content', 'news');

        return false;
    }
}
