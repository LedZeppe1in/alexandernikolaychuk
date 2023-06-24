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
            'name_ru' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'cover_ru' => $this->text(),
            'cover_en' => $this->text(),
            'links' => $this->text(),
            'description_ru' => $this->text(),
            'description_en' => $this->text(),
            'authors_ru' => $this->text(),
            'authors_en' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_music_album_name_ru', '{{%music_album}}', 'name_ru');
        $this->createIndex('idx_music_album_name_en', '{{%music_album}}', 'name_en');
    }

    public function safeDown()
    {
        $this->dropTable('{{%music_album}}');
    }
}