<?php

use yii\db\Migration;

/**
 * Class m200506_011302_wfh
 */
class m200506_011302_wfh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$tables = Yii::$app->db->schema->getTableNames();
		$dbType = $this->db->driverName;
		$tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
		$tableOptions_mssql = "";
		$tableOptions_pgsql = "";
		$tableOptions_sqlite = "";
		/* MYSQL */
		if (!in_array('wfh_record', $tables))  { 
		if ($dbType == "mysql") {
			$this->createTable('{{%wfh_record}}', [
				'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
				0 => 'PRIMARY KEY (`id`)',
				'user_id' => 'INT(11) NOT NULL',
				'time_in' => 'DATETIME NOT NULL',
				'time_out' => 'DATETIME NULL',
			], $tableOptions_mysql);
		}
		}
		 
		/* MYSQL */
		if (!in_array('wfh_task', $tables))  { 
		if ($dbType == "mysql") {
			$this->createTable('{{%wfh_task}}', [
				'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
				0 => 'PRIMARY KEY (`id`)',
				'user_id' => 'INT(11) NOT NULL',
				'start_date' => 'DATETIME NOT NULL',
				'end_date' => 'DATETIME NULL',
				'status' => 'ENUM(\'Ongoing\',\'On Hold\',\'Completed\',\'Cancelled\') NOT NULL',
				'description' => 'MEDIUMTEXT NOT NULL',
				'reason' => 'MEDIUMTEXT NOT NULL',
			], $tableOptions_mysql);
		}
		}

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200506_011302_wfh cannot be reverted.\n";
		$this->execute('SET foreign_key_checks = 0');
		$this->execute('DROP TABLE IF EXISTS `wfh_record`');
		$this->execute('SET foreign_key_checks = 1;');
		$this->execute('SET foreign_key_checks = 0');
		$this->execute('DROP TABLE IF EXISTS `wfh_task`');
		$this->execute('SET foreign_key_checks = 1;');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200506_011302_wfh cannot be reverted.\n";

        return false;
    }
    */
}
