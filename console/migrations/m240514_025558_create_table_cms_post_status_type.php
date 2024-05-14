<?php

use yii\db\Migration;

class m240514_025558_create_table_cms_post_status_type extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_post_status_type}}',
            [
                'id' => $this->primaryKey(),
                'post_status_type' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_post_status_type}}');
    }
}
