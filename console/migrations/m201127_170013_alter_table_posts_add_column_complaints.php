<?php

use yii\db\Migration;

/**
 * Class m201127_170013_alter_table_posts_add_column_complaints
 */
class m201127_170013_alter_table_posts_add_column_complaints extends Migration
{

    public function up()
    {
        $this->addColumn('{{%post}}', 'complaints', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%post}}', 'complaints');
    }

}
