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
            'name_ru' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'composition_list_ru' => $this->text()->notNull(),
            'composition_list_en' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_repertoire_name_ru', '{{%repertoire}}', 'name_ru');
        $this->createIndex('idx_repertoire_name_en', '{{%repertoire}}', 'name_en');
    }

    public function safeDown()
    {
        $this->dropTable('{{%repertoire}}');
    }
}