<?php

namespace app\modules\main\controllers;
 
use yii\web\Controller;
use app\modules\main\models\HookahForm;
use app\modules\order\models\Order;
use app\modules\user\models\UserGroup;
use Yii;
 
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
 
    public function actionIndex()
    {
        
        $hookahForm = new HookahForm();
        
        if ($user = Yii::$app->user->identity) {
           
            if(UserGroup::find()->where(['id' => $user->group])->one()->code === "manager"){
                
                $order = new Order();
                $order_list = $order->find()->where(['status' => "0"])->all();
                $order_return = array();
                $label = $hookahForm->attributeLabels();
                
                foreach($order_list as $items){
                    
                    $order_return[$items->id] = array();
                    $cur_items = json_decode($items->order, true);
                    foreach($cur_items as $key => $item){
                        $order_return[$items->id][$label[$key]] = ($key === "params") ? json_decode($item) : $item;
                    }

                }
                
                return $this->render('manager', [
                    'model' => $order_return,
                ]);
            }
            
        } else {

            if ($hookahForm->load(Yii::$app->request->post()) && $hookahForm->submit()) {
                Yii::$app->session->setFlash('hookahFormSubmitted');
                return $this->refresh();
            } else {
                return $this->render('index', [
                    'model' => $hookahForm,
                ]);
            }
        
        }
    }
}