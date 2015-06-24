<?php

namespace app\modules\order\controllers;

use app\modules\order\models\Order;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    
    public function actionIndex()
    {
        
    }
    
    public function actionStatus_update()
    {
        $request = Yii::$app->request;
        $curr_status = $request->get('status');
        
        $result = array();
        
        if($curr_status == "new"){
            $new_status = "working";
        } else if($curr_status == "working"){
            $new_status = "closed";
        }
        
        $user = Yii::$app->user->identity;
        
        $order = Order::findOne($request->get('id'));
        $order->status = $new_status;
        $order->hookah_man = $user->id;
        $order->updated_at = time();
        
        if($order->update()){
            $hookah_man = $user = Yii::$app->user->identity;
            $result["code"] = 1;
            $result["status"] = $new_status;
            $result["hookah_man"] = $hookah_man->name;
        } else {
            $result["code"] = 0;
        }
        
        return $this->renderPartial('status_update', [
            'model' => $result,
        ]);
        
    }

}
