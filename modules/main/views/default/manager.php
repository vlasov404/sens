<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Текущие заказы</h1>
    </div>

    <div class="body-content halls">
        <?foreach($model["items"]['halls'] as $hall){?>
            <div class="row">
                <h2><?=$hall['name']?></h2>
                <?foreach($hall["items"] as $key => $item){?>
                    <div class="col-lg-3 item_tab">
                        <div class="tab">
                            <h4><?=$key?> Стол</h4>
                            <div class="scroll_block">
                                <?if($item == '0'){?>
                                    <div><strong>Стол обслужен / Заказов нет.</strong></div>
                                <?} else {?>
                                    <?foreach($item as $order){?>
                                        <div class="order status_<?=$order["status"]?>" id="elem_<?=$order["id"]?>">
                                            <?if(!empty($order['params'])){?>
                                                <div class="name">Параметры кальяна:</div>
                                                <div><?=$order['params']?></div>
                                            <?}?>
                                            <?if(!empty($order['message'])){?>
                                                <div class="name<?if(!empty($order['params'])){?> margin<?}?>">Сообщение:</div>
                                                <div><?=$order['message']?></div>
                                            <?}?>
                                            <?if(isset($order['hookah_man'])){?>
                                                <div class="name margin">Заказ принял:</div>
                                                <div><?=$order['hookah_man']?></div>
                                            <?}?>
                                            <a href="javascript:void(0)" 
                                               class="status_update btn btn-block btn-primary btn-<?if($order["status"] == "new"){?>danger<?} elseif ($order["status"] == "working") {?>success<?}?>" 
                                               data-status="<?=$order["status"]?>"
                                               data-id="<?=$order["id"]?>">
                                                <?
                                                    if($order["status"] == "new")
                                                        echo "принять";
                                                    elseif ($order["status"] == "working")
                                                        echo '<span class="glyphicon glyphicon-ok"></span> закрыть';
                                                ?>
                                            </a>
                                        </div>
                                    <?}?>
                                <?}?>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
        <?}?>
    </div>
</div>
