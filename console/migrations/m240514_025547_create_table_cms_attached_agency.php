<?php

use yii\db\Migration;

class m240514_025547_create_table_cms_attached_agency extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_attached_agency}}',
            [
                'id' => $this->primaryKey(),
                'label' => $this->string()->notNull(),
                'order' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'logo' => $this->integer()->notNull(),
                'url' => $this->string()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('user_update_id', '{{%cms_attached_agency}}', ['user_update_id']);
        $this->createIndex('user_id', '{{%cms_attached_agency}}', ['user_id']);
        $this->createIndex('status_id', '{{%cms_attached_agency}}', ['status_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_attached_agency}}');
    }
}
