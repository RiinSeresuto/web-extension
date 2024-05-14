<?php

use yii\db\Migration;

class m240514_025601_create_table_cms_public_assistance_group extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_public_assistance_group}}',
            [
                'id' => $this->primaryKey(),
                'p_a_group' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_public_assistance_group}}');
    }
}
