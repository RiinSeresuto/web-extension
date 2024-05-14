<?php

use yii\db\Migration;

class m240514_025612_create_table_cms_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%cms_menu}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer(),
                'label' => $this->string()->notNull(),
                'menu_order' => $this->integer()->notNull(),
                'position_id' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),
                'link' => $this->string(),
                'logo_file' => $this->integer(),
                'user_id' => $this->integer(),
                'user_update_id' => $this->integer(),
                'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
                'date_updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
                'url_type' => $this->integer()->notNull(),
                'content_type' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('position_id', '{{%cms_menu}}', ['position_id']);
        $this->createIndex('parent_id', '{{%cms_menu}}', ['parent_id']);
        $this->createIndex('user_update_id', '{{%cms_menu}}', ['user_update_id']);
        $this->createIndex('user_id', '{{%cms_menu}}', ['user_id']);
        $this->createIndex('logo/file', '{{%cms_menu}}', ['logo_file']);
        $this->createIndex('status_id', '{{%cms_menu}}', ['status_id']);

        $this->addForeignKey(
            'cms_menu_ibfk_2',
            '{{%cms_menu}}',
            ['status_id'],
            '{{%cms_status}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_menu_ibfk_1',
            '{{%cms_menu}}',
            ['position_id'],
            '{{%cms_position}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cms_menu}}');
    }
}
