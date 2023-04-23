<?php

use yii\db\Migration;

/**
 * Class m230423_085358_photo
 */
class m230423_085358_photo extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%photo}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'file' => $this->text()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%photo}}');
    }
}