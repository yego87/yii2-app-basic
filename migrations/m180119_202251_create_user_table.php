<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180119_202251_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
