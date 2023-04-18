<?php

use yii\db\Migration;

/**
 * Class m230417_110635_user
 */
class m230417_110635_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'full_name_ru' => $this->string()->notNull(),
            'full_name_en' => $this->string()->notNull(),
            'address_ru' => $this->string()->notNull(),
            'address_en' => $this->string()->notNull(),
            'biography_ru' => $this->text(),
            'biography_en' => $this->text(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'youtube_link' => $this->string(),
            'instagram_link' => $this->string(),
            'facebook_link' => $this->string(),
            'twitter_link' => $this->string(),
            'vk_link' => $this->string(),
            'apple_music_link' => $this->string(),
            'yandex_music_link' => $this->string(),
            'spotify_link' => $this->string(),
        ], $tableOptions);

        $this->createIndex('idx_user_username', '{{%user}}', 'username');
        $this->createIndex('idx_user_full_name_ru', '{{%user}}', 'full_name_ru');
        $this->createIndex('idx_user_full_name_en', '{{%user}}', 'full_name_en');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}