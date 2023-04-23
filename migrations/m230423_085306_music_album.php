<?php

use yii\db\Migration;

/**
 * Class m230423_085306_music_album
 */
class m230423_085306_music_album extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%music_album}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'cover' => $this->text(),
            'links' => $this->text(),
            'description' => $this->text(),
            'author' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_music_album_name', '{{%music_album}}', 'name');
    }

    public function safeDown()
    {
        $this->dropTable('{{%music_album}}');
    }
}