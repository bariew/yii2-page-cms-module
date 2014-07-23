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

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'layout') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'page_title') ?>

    <?php // echo $form->field($model, 'page_description') ?>

    <?php // echo $form->field($model, 'page_keywords') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
