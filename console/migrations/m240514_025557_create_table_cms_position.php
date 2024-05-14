<?php

use yii\db\Migration;

class m240514_025557_create_table_cms_position extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_position}}',
            [
                'id' => $this->primaryKey(),
                'position' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_position}}');
    }
}
