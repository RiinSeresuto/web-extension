<?php

use yii\db\Migration;

class m240514_025554_create_table_cms_field extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_field}}',
            [
                'id' => $this->primaryKey(),
                'label' => $this->string()->notNull(),
                'data_type_id' => $this->integer()->notNull(),
                'widget_type_id' => $this->integer()->notNull(),
                'user_id' => $this->integer(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('widget_type_id', '{{%cms_field}}', ['widget_type_id']);
        $this->createIndex('data_type_id', '{{%cms_field}}', ['data_type_id']);
        $this->createIndex('user_update_id', '{{%cms_field}}', ['user_update_id']);
        $this->createIndex('user_id', '{{%cms_field}}', ['user_id']);

        $this->addForeignKey(
            'cms_field_ibfk_1',
            '{{%cms_field}}',
            ['data_type_id'],
            '{{%cms_data_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_field}}');
    }
}
