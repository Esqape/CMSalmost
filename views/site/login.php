<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
 
$this->title = 'Sign In';
 
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
 
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
 
<div class=jumbotron>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>L</b>ogin</a>
        </div>
        <div class="login-box-body login">
            <p class="login-box-msg">Login</p>
    
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
    
            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
    
            <?= $form
                ->field($model, 'email', $fieldOptions2)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
    
            
                <div class="col-lg-offset-4 col-lg-4">
                    <?= Html::submitButton('Sign in', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            
    
            <?php ActiveForm::end(); ?>
    
        </div>
    </div>
        
</div>