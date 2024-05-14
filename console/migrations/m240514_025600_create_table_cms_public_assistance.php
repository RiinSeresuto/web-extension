<?php

use yii\db\Migration;

class m240514_025600_create_table_cms_public_assistance extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_public_assistance}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'email' => $this->string()->notNull(),
                'contact_num' => $this->integer()->notNull(),
                'subject' => $this->string()->notNull(),
                'message' => $this->text()->notNull(),
                'group' => $this->integer()->notNull(),
                'file_attachment' => $this->integer()->notNull(),
                'date_posted' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('group', '{{%cms_public_assistance}}', ['group']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_public_assistance}}');
    }
}
