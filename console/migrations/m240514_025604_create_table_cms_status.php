<?php

use yii\db\Migration;

class m240514_025604_create_table_cms_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_status}}',
            [
                'id' => $this->integer()->notNull(),
                'status_type' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('id', '{{%cms_status}}', ['id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_status}}');
    }
}
