<?php

use yii\db\Migration;

class m240514_025607_create_table_cms_visibility_type extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_visibility_type}}',
            [
                'id' => $this->integer()->notNull(),
                'visibility_type' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('id', '{{%cms_visibility_type}}', ['id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_visibility_type}}');
    }
}
