<?php

use yii\db\Migration;

class m240514_025613_create_table_cms_pages extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_pages}}',
            [
                'id' => $this->primaryKey(),
                'menu_id' => $this->integer()->notNull(),
                'title' => $this->string()->notNull(),
                'caption' => $this->string()->notNull(),
                'body' => $this->text()->notNull(),
                'url_type_id' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'type_id' => $this->integer()->notNull(),
                'link' => $this->string()->notNull(),
                'slider_photo' => $this->integer()->notNull(),
                'file_attachment' => $this->integer(),
                'user_id' => $this->integer()->notNull(),
                'user_update_id' => $this->integer()->notNull(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );

        $this->createIndex('url_type_id', '{{%cms_pages}}', ['url_type_id']);
        $this->createIndex('user_update_id', '{{%cms_pages}}', ['user_update_id']);
        $this->createIndex('menu_id', '{{%cms_pages}}', ['menu_id']);
        //$this->createIndex('user_id', '{{%cms_pages}}', ['user_id']);
        $this->createIndex('file_attachment', '{{%cms_pages}}', ['file_attachment']);
        $this->createIndex('slider_photo', '{{%cms_pages}}', ['slider_photo']);
        $this->createIndex('type_id', '{{%cms_pages}}', ['type_id']);
        $this->createIndex('status_id', '{{%cms_pages}}', ['status_id']);

        $this->addForeignKey(
            'cms_pages_ibfk_2',
            '{{%cms_pages}}',
            ['url_type_id'],
            '{{%cms_url_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_pages_ibfk_3',
            '{{%cms_pages}}',
            ['status_id'],
            '{{%cms_status}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_pages_ibfk_4',
            '{{%cms_pages}}',
            ['type_id'],
            '{{%cms_type}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_pages}}');
    }
}
