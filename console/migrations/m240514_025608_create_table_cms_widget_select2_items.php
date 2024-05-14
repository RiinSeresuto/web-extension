<?php

use yii\db\Migration;

class m240514_025608_create_table_cms_widget_select2_items extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_widget_select2_items}}',
            [
                'id' => $this->primaryKey(),
                'field_id' => $this->integer()->notNull(),
                'value' => $this->string()->notNull(),
                'label' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('form_id', '{{%cms_widget_select2_items}}', ['field_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_widget_select2_items}}');
    }
}
