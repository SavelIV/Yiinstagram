<?php

use yii\db\Migration;

/**
 * Class m200212_114057_alter_user_table
 */
class m200212_114057_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200212_114057_alter_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200212_114057_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
