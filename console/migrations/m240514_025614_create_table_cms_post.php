<?php

use yii\db\Migration;

class m240514_025614_create_table_cms_post extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_post}}',
            [
                'id' => $this->primaryKey(),
                'category_id' => $this->integer(),
                'year' => $this->integer(),
                'forms_id' => $this->integer(),
                'field_id' => $this->integer(),
                'tags' => $this->string(),
                'status_id' => $this->integer()->notNull(),
                'visibility_id' => $this->integer(),
                'publish_id' => $this->integer(),
                'page_id' => $this->integer(),
                'start_date_time' => $this->dateTime(),
                'end_date_time' => $this->dateTime(),
                'min_answer' => $this->integer(),
                'max_answer' => $this->integer(),
                'user_id' => $this->integer(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
                'body' => $this->text(),
            ],
            $tableOptions
        );

        $this->createIndex('field_id', '{{%cms_post}}', ['field_id']);
        $this->createIndex('user_update_id', '{{%cms_post}}', ['user_update_id']);
        $this->createIndex('forms_id', '{{%cms_post}}', ['forms_id']);
        $this->createIndex('user_id', '{{%cms_post}}', ['user_id']);
        $this->createIndex('page_id', '{{%cms_post}}', ['page_id']);
        $this->createIndex('publish_id', '{{%cms_post}}', ['publish_id']);
        $this->createIndex('visibility_id', '{{%cms_post}}', ['visibility_id']);
        $this->createIndex('status_id', '{{%cms_post}}', ['status_id']);
        $this->createIndex('category_id', '{{%cms_post}}', ['category_id']);

        $this->addForeignKey(
            'cms_post_ibfk_3',
            '{{%cms_post}}',
            ['status_id'],
            '{{%cms_post_status_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_4',
            '{{%cms_post}}',
            ['visibility_id'],
            '{{%cms_visibility_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_5',
            '{{%cms_post}}',
            ['publish_id'],
            '{{%cms_publish_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_post}}');
    }
}
