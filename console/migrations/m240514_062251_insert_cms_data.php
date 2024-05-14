<?php

use yii\db\Migration;

/**
 * Class m240514_062251_insert_cms_data
 */
class m240514_062251_insert_cms_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        echo ("directory =====>" . __DIR__);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240514_062251_insert_cms_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240514_062251_insert_cms_data cannot be reverted.\n";

        return false;
    }
    */
}
