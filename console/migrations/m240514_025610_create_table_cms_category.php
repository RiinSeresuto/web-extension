<?php

use yii\db\Migration;

class m240514_025610_create_table_cms_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_category}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'user_id' => $this->integer(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('user_id', '{{%cms_category}}', ['user_id']);
        $this->createIndex('status_id', '{{%cms_category}}', ['status_id']);
        $this->createIndex('user_update_id', '{{%cms_category}}', ['user_update_id']);

        $this->addForeignKey(
            'cms_category_ibfk_1',
            '{{%cms_category}}',
            ['status_id'],
            '{{%cms_status}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_category}}');
    }
}
