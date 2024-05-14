<?php

use yii\db\Migration;

class m240514_025552_create_table_cms_draft_jc_feedback extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_draft_jc_feedback}}',
            [
                'id' => $this->primaryKey(),
                'joint_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'email' => $this->string()->notNull(),
                'feedback' => $this->text()->notNull(),
                'date_posted' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('joint_id', '{{%cms_draft_jc_feedback}}', ['joint_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_draft_jc_feedback}}');
    }
}
