<?php

use yii\db\Migration;

/**
 * Class m230423_085441_project_photo
 */
class m230423_085441_project_photo extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%project_photo}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'project' => $this->integer()->notNull(),
            'photo' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("project_fk", "{{%project_photo}}", "project", "{{%project}}",
            "id", 'CASCADE');
        $this->addForeignKey("photo_fk", "{{%project_photo}}", "photo", "{{%photo}}",
            "id", 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%project_photo}}');
    }
}