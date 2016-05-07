<?php
/**
 * @var yii\web\View $this
 */

$this->title = Yii::t('modules/page', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-3 well">
        <?= \Yii::$app->controller->menu; ?>
    </div>
    <div class="col-md-9"></div>
</div>