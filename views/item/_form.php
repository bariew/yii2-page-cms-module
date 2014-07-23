<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var bariew\pageModule\models\Item $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => 'Content',
                'content' => $this->render('_formContent', compact('form', 'model')),
                'active' => true
            ],
            [
                'label' => 'Settings',
                'content' => $this->render('_formSettings', compact('form', 'model'))
            ],
        ],
    ]); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
