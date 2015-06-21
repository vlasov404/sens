<?php

use yii\db\Schema;
use yii\db\Migration;

class m150621_150648_create_user_group_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user_group}}', [
            'id' => Schema::TYPE_PK,
            'active' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
