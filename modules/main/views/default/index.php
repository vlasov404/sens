<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Заказ кальяна</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
                
                <?php if (Yii::$app->session->hasFlash('hookahFormSubmitted')): ?>
                
                    <div class="alert alert-success">
                        <?= Yii::t('app', 'HOOKAH_SUBMIT_RESULT'); ?>
                    </div>
                
                <?php else: ?>
                
                    <?php $form = ActiveForm::begin(['id' => 'hookah-form']); ?>

                    <?=$form->field($model, 'hall', ['inline' => true,])->radioList($model->hall(), 
                        [
                            'id' => 'projects_status',
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'item' => function ($index, $label, $name, $checked, $value){
                                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                                Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                            },
                        ]
                    )?>

                    <?=$form->field($model, 'number_table', ['inline' => true,])->radioList($model->number_table(), 
                        [
                            'id' => 'projects_status',
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'item' => function ($index, $label, $name, $checked, $value){
                                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                                Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                            },
                        ]
                    )?>

                    <?=$form->field($model, 'sturdiness', ['inline' => true,])->radioList($model->sturdiness(), 
                        [
                            'id' => 'projects_status',
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'item' => function ($index, $label, $name, $checked, $value){
                                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                                Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                            },
                        ]
                    )?>

                    <?=$form->field($model, 'params', ['inline' => true,])->checkboxList($model->params(), 
                        [
                            'id' => 'projects_status',
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'item' => function ($index, $label, $name, $checked, $value){
                                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                                Html::checkbox($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                            },
                        ]
                    )?>

                    <?=$form->field($model, 'message')->textArea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'BUTTON_SEND'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                
                <?php endif; ?>
                
            </div>
        </div>
        
    </div>
</div>
