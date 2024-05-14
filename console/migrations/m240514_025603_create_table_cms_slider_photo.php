<?php

use yii\db\Migration;

class m240514_025603_create_table_cms_slider_photo extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_slider_photo}}',
            [
                'id' => $this->primaryKey(),
                'caption' => $this->string()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'upload_photo' => $this->integer()->notNull(),
                'url' => $this->string()->notNull(),
                'user_id' => $this->integer()->notNull(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('upload_photo', '{{%cms_slider_photo}}', ['upload_photo']);
        $this->createIndex('status_id', '{{%cms_slider_photo}}', ['status_id']);
        $this->createIndex('user_update_id', '{{%cms_slider_photo}}', ['user_update_id']);
        $this->createIndex('user_id', '{{%cms_slider_photo}}', ['user_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_slider_photo}}');
    }
}
