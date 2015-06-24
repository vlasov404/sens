<?php

namespace app\modules\main\controllers;
 
use yii\web\Controller;
use app\modules\main\models\HookahForm;
use app\modules\order\models\Order;
use app\modules\order\models\OrderStatus;
use app\modules\user\models\UserGroup;
use app\modules\user\models\User;
use app\helpers\Helper;
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
                
                $table_hall_small = 10;
                $table_hall_big = 10;
                
                $hall_small = array();
                $hall_small = array_pad($hall_small, 11, 0);
                $hall_big = array();
                $hall_big = array_pad($hall_big, 11, 0);
                
                $order = new Order();
                $order_list = $order->find()->where(['status' => array('new', 'working')])->orderBy('status')->all();
                
                $result = array();
                $order_tmp = array();

                $label = $hookahForm->attributeLabels();

                foreach($order_list as $items){
                    $order_tmp[$items->id] = array();
                    $order_tmp[$items->id]['status'] = $items->status;
                    $order_tmp[$items->id]['id'] = $items->id;
                    
                    if(!empty($items->hookah_man)){
                        $hookah_man = User::find()->where(['id' => $items->hookah_man])->one();
                        $order_tmp[$items->id]['hookah_man'] = $hookah_man->name;
                    }
                    
                    $cur_items = json_decode($items->order, true);
                    foreach($cur_items as $key => $item){
                        
                        if($key === "params"){
                            $tmp = json_decode($item);
                            foreach($tmp as &$lb){
                                $lb = $label[$lb];
                            }
                            
                            $order_tmp[$items->id][$key] = implode(", ", $tmp);
                        } else {
                            $order_tmp[$items->id][$key] = $item;
                        }
                    }

                }
                
                
                unset($hall_small[0]);
                unset($hall_big[0]);
                
                foreach($order_tmp as $el){
                    
                    if($el['hall'] === 'big'){
                        if(!is_array($hall_big[$el['number_table']]))
                            $hall_big[$el['number_table']] = array();
                        $hall_big[$el['number_table']][] = $el;
                    } else {
                        if(!is_array($hall_small[$el['number_table']]))
                            $hall_small[$el['number_table']] = array();
                        $hall_small[$el['number_table']][] = $el;
                    }
                    
                }
                
                $result['items']['halls'] = array();
                $result['items']['halls']['big'] = array(
                    'name' => 'Большой зал',
                    'items' => $hall_big
                );
                $result['items']['halls']['small'] = array(
                    'name' => 'Малый зал',
                    'items' => $hall_small
                );
                
                return $this->render('manager', [
                    'model' => $result,
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