<?php

use yii\db\Migration;

/**
 * Class m230423_085426_project_album
 */
class m230423_085426_project_album extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%project_album}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'project' => $this->integer()->notNull(),
            'music_album' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("project_fk", "{{%project_album}}", "project", "{{%project}}",
            "id", 'CASCADE');
        $this->addForeignKey("music_album_fk", "{{%project_album}}", "music_album",
            "{{%music_album}}", "id", 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%project_album}}');
    }
}