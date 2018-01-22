<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180119_211856_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'created_by' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'content' => $this->text(),
            'imageFile' => $this->string(),
            'price' => $this->decimal()->notNull(),
        ]);

        $this->createIndex('idx-product-created_by', '{{%product}}', 'created_by');

        $this->addForeignKey('fk-product-user', '{{%product}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
