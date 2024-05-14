<?php

use yii\db\Migration;

class m240514_025559_create_table_cms_programprojects_feedback extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_programprojects_feedback}}',
            [
                'id' => $this->primaryKey(),
                'progproj_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'email' => $this->string()->notNull(),
                'address' => $this->string()->notNull(),
                'feedback' => $this->text()->notNull(),
                'date_posted' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'posted_by' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('progproj_id', '{{%cms_programprojects_feedback}}', ['progproj_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_programprojects_feedback}}');
    }
}
