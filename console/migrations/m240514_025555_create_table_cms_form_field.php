<?php

use yii\db\Migration;

class m240514_025555_create_table_cms_form_field extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_form_field}}',
            [
                'id' => $this->primaryKey(),
                'form_id' => $this->integer()->notNull(),
                'field_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('field_id', '{{%cms_form_field}}', ['field_id']);
        $this->createIndex('form_id', '{{%cms_form_field}}', ['form_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_form_field}}');
    }
}
