<?php

use yii\db\Migration;

/**
 * Class m230423_085342_project
 */
class m230423_085342_project extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'poster' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_project_name', '{{%project}}', 'name');
    }

    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}