<?php

use yii\db\Migration;

class m240514_025615_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'cms_field_ibfk_3',
            '{{%cms_field}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_field_ibfk_4',
            '{{%cms_field}}',
            ['user_update_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_category_ibfk_2',
            '{{%cms_category}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_form_ibfk_5',
            '{{%cms_form}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'cms_menu_ibfk_3',
            '{{%cms_menu}}',
            ['logo_file'],
            '{{%cms_file_attachment}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_menu_ibfk_4',
            '{{%cms_menu}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_menu_ibfk_5',
            '{{%cms_menu}}',
            ['user_update_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_pages_ibfk_7',
            '{{%cms_pages}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_pages_ibfk_1',
            '{{%cms_pages}}',
            ['menu_id'],
            '{{%cms_menu}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_2',
            '{{%cms_post}}',
            ['field_id'],
            '{{%cms_field}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_6',
            '{{%cms_post}}',
            ['page_id'],
            '{{%cms_pages}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_7',
            '{{%cms_post}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_8',
            '{{%cms_post}}',
            ['user_update_id'],
            '{{%user}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'cms_post_ibfk_1',
            '{{%cms_post}}',
            ['forms_id'],
            '{{%cms_form}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('cms_post_ibfk_1', '{{%cms_post}}');
        $this->dropForeignKey('cms_post_ibfk_8', '{{%cms_post}}');
        $this->dropForeignKey('cms_post_ibfk_7', '{{%cms_post}}');
        $this->dropForeignKey('cms_post_ibfk_6', '{{%cms_post}}');
        $this->dropForeignKey('cms_post_ibfk_2', '{{%cms_post}}');
        $this->dropForeignKey('cms_pages_ibfk_1', '{{%cms_pages}}');
        $this->dropForeignKey('cms_pages_ibfk_7', '{{%cms_pages}}');
        $this->dropForeignKey('cms_menu_ibfk_5', '{{%cms_menu}}');
        $this->dropForeignKey('cms_menu_ibfk_4', '{{%cms_menu}}');
        $this->dropForeignKey('cms_menu_ibfk_3', '{{%cms_menu}}');
        $this->dropForeignKey('cms_form_ibfk_5', '{{%cms_form}}');
        $this->dropForeignKey('cms_category_ibfk_2', '{{%cms_category}}');
        $this->dropForeignKey('cms_field_ibfk_4', '{{%cms_field}}');
        $this->dropForeignKey('cms_field_ibfk_3', '{{%cms_field}}');
    }
}
