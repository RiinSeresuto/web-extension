<?php

use yii\db\Migration;

/**
 * Class m200506_023950_wfh_item
 */
class m200506_023950_wfh_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{auth_item}}',['name'=>'WFH_Administrator','type'=>'1', 'description' => '']); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200506_023950_wfh_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200506_023950_wfh_item cannot be reverted.\n";

        return false;
    }
    */
}
