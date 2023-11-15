<?php

use yii\db\Migration;

/**
 * Class m200508_101231_add_table_attachments
 */
class m200508_101231_add_table_attachments extends Migration
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
        if (!in_array('wfh_attachments', $tables))  { 
        if ($dbType == "mysql") {
            $this->createTable('{{%wfh_attachments}}', [
                'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                0 => 'PRIMARY KEY (`id`)',
                'task_id' => 'INT(11) NOT NULL',
                'file_type' => 'VARCHAR(15) NOT NULL',
                'url' => 'TEXT NULL',
                'file_name' => 'VARCHAR(255) NULL',
                'file_path' => 'VARCHAR(255) NULL',
            ], $tableOptions_mysql);
        }
        }
         
         
        $this->createIndex('idx_task_id_8408_00','wfh_attachments','task_id',0);
         
        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_wfh_task_8402_00','{{%wfh_attachments}}', 'task_id', '{{%wfh_task}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->execute('SET foreign_key_checks = 1;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200508_101231_add_table_attachments cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200508_101231_add_table_attachments cannot be reverted.\n";

        return false;
    }
    */
}
