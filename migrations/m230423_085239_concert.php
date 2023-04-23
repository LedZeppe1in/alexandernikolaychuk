<?php

use yii\db\Migration;

/**
 * Class m230423_085239_concert
 */
class m230423_085239_concert extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%concert}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string(),
            'poster' => $this->text(),
            'links' => $this->text()
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%concert}}');
    }
}