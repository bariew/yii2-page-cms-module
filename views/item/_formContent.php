<?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<?php echo $form->field($model, 'label')->textInput(['maxlength' => 255]) ?>

<?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<div class="form-group required">
    <?php echo yii\imperavi\Widget::widget([
        'model' => $model,
        'attribute' => 'content',
        'options'   => [
            'minHeight' => 300,
            'fileUpload' => \Yii::$app->urlManager->createUrl(['/main/admin/fileUpload', 'attr'=>'content']),
            'imageUpload' => \Yii::$app->urlManager->createUrl(['/main/admin/imageUpload', 'attr'=>'content']),
            'imageGetJson' => \Yii::$app->urlManager->createUrl(['/main/admin/imageList', 'attr'=>'content']),
         ]
    ]);?>
    <?php if ($model->hasErrors('content')): ?>
    <div class="has-error">
        <?php echo Html::error($model, 'content', $form->field($model, 'content')->errorOptions); ;?>
    </div>
    <?php endif; ?>
</div>

<?php echo $form->field($model, 'visible')->checkbox() ?>

