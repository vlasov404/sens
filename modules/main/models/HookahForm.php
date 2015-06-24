<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;
use app\modules\order\models\Order;


class HookahForm extends Model
{
    public $hall;
    public $number_table;
    public $sturdiness;
    public $params;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['hall', 'number_table', 'sturdiness', 'params'], 'required'],
            [['message'], 'string', 'max' => 255]
        ];
    }
    
    public function hall(){
        return [
            "big" => Yii::t('app', 'HOOKAH_HALL_BIG'),
            "small" => Yii::t('app', 'HOOKAH_HALL_SMALL'),
        ];
    }
 
    public function number_table(){
        return [
            "1" => '1',
            "2" => '2',
            "3" => '3',
            "4" => '4',
            "5" => '5',
            "6" => '6',
            "7" => '7',
            "8" => '8',
            "9" => '9',
            "10" => '10',
        ];
    }
    
    public function sturdiness(){
        return [
            "1" => '1',
            "2" => '2',
            "3" => '3',
            "4" => '4',
            "5" => '5',
            "6" => '6',
            "7" => '7',
            "8" => '8',
            "9" => '9',
            "10" => '10',
        ];
    }
    
    public function params(){
        return [
            "fresh" => Yii::t('app', 'HOOKAH_PARAMS_FRESH'),
            "sweet" => Yii::t('app', 'HOOKAH_PARAMS_SWEET'),
            "sour" => Yii::t('app', 'HOOKAH_PARAMS_SOUR'),
            "tart" => Yii::t('app', 'HOOKAH_PARAMS_TART'),
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'hall' => Yii::t('app', 'HOOKAH_HALL'),
            'number_table' => Yii::t('app', 'HOOKAH_NUMBER_TABLE'),
            'sturdiness' => Yii::t('app', 'HOOKAH_STURDINESS'),
            'params' => Yii::t('app', 'HOOKAH_PARAMS'),
            'message' => Yii::t('app', 'HOOKAH_MESSAGE'),
            "fresh" => Yii::t('app', 'HOOKAH_PARAMS_FRESH'),
            "sweet" => Yii::t('app', 'HOOKAH_PARAMS_SWEET'),
            "sour" => Yii::t('app', 'HOOKAH_PARAMS_SOUR'),
            "tart" => Yii::t('app', 'HOOKAH_PARAMS_TART'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function submit()
    {
        if ($this->validate()) {
            $order = new Order;
            
            $order_data = array(
                'hall' => $this->hall,
                'number_table' => $this->number_table,
                'sturdiness' => $this->sturdiness,
                'params' => json_encode($this->params),
                'message' => $this->message,
            );
            
            $order->order = json_encode($order_data);
            $order->created_at=time();
            $order->status='new';
            $order->save();
            
            return true;
        } else {
            return false;
        }
    }
}
