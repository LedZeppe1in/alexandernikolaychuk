<?php

use yii\db\Migration;

/**
 * Class m230423_085326_repertoire
 */
class m230423_085326_repertoire extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%repertoire}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'composition_list ' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_repertoire_name', '{{%repertoire}}', 'name');
    }

    public function safeDown()
    {
        $this->dropTable('{{%repertoire}}');
    }
}