<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m191106_222943_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'middle_name' => $this->string(),
            'last_name' => $this->string(),
            'birth_date' => $this->date(),
            'city' => $this->string(),
            'hiring_date' => $this->date(),
            'position' => $this->string(),
            'department' => $this->string(),
            'id_code' => $this->string(),
            'email' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
