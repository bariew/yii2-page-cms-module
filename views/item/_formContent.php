<?php
use \yii\helpers\Url;
;?>
<?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

<?php echo $form->field($model, 'label')->textInput(['maxlength' => 255]) ?>

<?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<div class="form-group required">
    <?php echo yii\imperavi\Widget::widget([
        'model' => $model,
        'attribute' => 'content',
        'options'   => [
            'minHeight'                => 300,
            'fileUpload'               => Url::toRoute(['file-upload', 'attr' => 'content']),
            'imageUpload'              => Url::toRoute(['image-upload', 'attr' => 'content']),
            'imageGetJson'             => Url::toRoute(['image-list', 'attr' => 'content']),
            'imageUploadErrorCallback' => new \yii\web\JsExpression('function(json) { alert(json.error); }'),
            'fileUploadErrorCallback'  => new \yii\web\JsExpression('function(json) { alert(json.error); }'),
         ]
    ]);?>
    <?php if ($model->hasErrors('content')): ?>
    <div class="has-error">
        <?php echo Html::error($model, 'content', $form->field($model, 'content')->errorOptions); ;?>
    </div>
    <?php endif; ?>
</div>

<?php echo $form->field($model, 'visible')->checkbox() ?>

