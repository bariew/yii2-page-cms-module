<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var bariew\pageModule\models\Item $model
 */

$this->title = Yii::t('modules/page', 'Update Page: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/page', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('modules/page', 'Update');
?>

<div class="row">
    <div class="col-md-3 well">
        <?= \Yii::$app->controller->menu; ?>
    </div>
    <div class="col-md-9">
        <div class="item-update">
            <h1><?php echo Html::encode($this->title) ?></h1>
            <?php echo $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>