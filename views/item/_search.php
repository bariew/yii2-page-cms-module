<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var bariew\pageModule\models\ItemSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'pid') ?>

    <?php echo $form->field($model, 'rank') ?>

    <?php echo $form->field($model, 'title') ?>

    <?php echo $form->field($model, 'brief') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('modules/page', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('modules/page', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
