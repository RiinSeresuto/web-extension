<?php

use yii\db\Migration;

class m240514_025550_create_table_cms_data_type extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_data_type}}',
            [
                'id' => $this->integer()->notNull(),
                'data_type' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('id', '{{%cms_data_type}}', ['id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_data_type}}');
    }
}
