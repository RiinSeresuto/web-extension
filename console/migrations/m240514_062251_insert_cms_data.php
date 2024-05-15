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
        $sqlFile = Yii::getAlias('@app/../database/cms_data.sql');

        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $this->execute($sql);
        } else {
            echo "SQL file not found: $sqlFile";
        }
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
