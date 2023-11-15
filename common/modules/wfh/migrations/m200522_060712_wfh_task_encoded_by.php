<?php

use yii\db\Migration;
use yii\db\Expression;
use yii\db\Query;

/**
 * Class m200522_060712_wfh_task_encoded_by
 */
class m200522_060712_wfh_task_encoded_by extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('wfh_task', 'encoded_by', 'int(255) NOT NULL');
		
		foreach((new Query)->from('wfh_task')->each() as $task) {
			$this->update('wfh_task', ['encoded_by' => new Expression('user_id')], ['id' => $task['id']]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200522_060712_wfh_task_encoded_by cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200522_060712_wfh_task_encoded_by cannot be reverted.\n";

        return false;
    }
    */
}
