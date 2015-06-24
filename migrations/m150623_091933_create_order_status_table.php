<?php

use yii\db\Schema;
use yii\db\Migration;

class m150623_091933_create_order_status_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%order_status}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING,
        ], $tableOptions);
    }
 
}
