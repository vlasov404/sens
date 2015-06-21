<?php

namespace app\modules\order\models;

use Yii;
use \yii\db\Expression;

/**
 * This is the model class for table "sens_order".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $hookah_man
 * @property integer $manager
 * @property string $order_data
 * @property string $order
 * @property integer $price
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sens_order';
    }
    
    public static function primaryKey()
    {
            return array('id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'order'], 'required'],
            [['created_at', 'updated_at', 'status', 'hookah_man', 'manager', 'price'], 'integer'],
            [['order_data', 'order'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'hookah_man' => 'Hookah Man',
            'manager' => 'Manager',
            'order_data' => 'Order Data',
            'order' => 'Order',
            'price' => 'Price',
        ];
    }
    
}
