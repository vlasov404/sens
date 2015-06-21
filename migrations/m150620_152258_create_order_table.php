<?php

use yii\db\Schema;
use yii\db\Migration;

class m150620_152258_create_order_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'hookah_man' => Schema::TYPE_SMALLINT,
            'manager' => Schema::TYPE_SMALLINT,
            'order_data' => Schema::TYPE_STRING . ' NOT NULL',
            'order' => Schema::TYPE_STRING . ' NOT NULL',
            'price' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
    }

    public function down()
    {
        echo "m150620_152258_create_order_table cannot be reverted.\n";

        return false;
    }
    
}
