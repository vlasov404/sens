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

    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
                
                <?
                    echo "<pre>";
                    print_r($model);
                    echo "</pre>";
                ?>
                
                
            </div>
        </div>
        
    </div>
</div>
