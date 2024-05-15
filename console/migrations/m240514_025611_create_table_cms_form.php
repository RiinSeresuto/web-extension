<?php

use yii\db\Migration;

class m240514_025611_create_table_cms_form extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_form}}',
            [
                'id' => $this->primaryKey(),
                'category_id' => $this->integer()->notNull(),
                'description' => $this->string()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'year' => $this->integer()->notNull()->defaultValue('0'),
                'user_id' => $this->integer()->notNull(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('status_id', '{{%cms_form}}', ['status_id']);
        $this->createIndex('category_id', '{{%cms_form}}', ['category_id']);
        $this->createIndex('user_update_id', '{{%cms_form}}', ['user_update_id']);
        //$this->createIndex('user_id', '{{%cms_form}}', ['user_id']);

        $this->addForeignKey(
            'cms_form_ibfk_3',
            '{{%cms_form}}',
            ['status_id'],
            '{{%cms_status}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_form}}');
    }
}
