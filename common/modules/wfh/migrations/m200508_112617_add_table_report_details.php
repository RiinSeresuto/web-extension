<?php

use yii\db\Migration;

/**
 * Class m200508_112617_add_table_report_details
 */
class m200508_112617_add_table_report_details extends Migration
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
        if (!in_array('wfh_report_details', $tables))  { 
        if ($dbType == "mysql") {
            $this->createTable('{{%wfh_report_details}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'user_id' => 'INT(11) NOT NULL',
                'employee_position' => 'VARCHAR(255) NOT NULL',
                'approval_name' => 'VARCHAR(255) NOT NULL',
                'approval_position' => 'VARCHAR(45) NOT NULL',
            ], $tableOptions_mysql);
        }
        }
         
         
        $this->createIndex('idx_user_id_7806_00','wfh_report_details','user_id',0);
         
        // $this->execute('SET foreign_key_checks = 0');
        // $this->addForeignKey('fk_user_7799_00','{{%wfh_report_details}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION' );
        // $this->execute('SET foreign_key_checks = 1;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200508_112617_add_table_report_details cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200508_112617_add_table_report_details cannot be reverted.\n";

        return false;
    }
    */
}
