<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var bariew\pageModule\models\Item $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/page', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-3 well">
        <?= \Yii::$app->controller->menu; ?>
    </div>
    <div class="col-md-9">
        <div class="item-view">
            <?php if($model->title) : ?>
                <h1><?php echo Html::encode($model->title) ?></h1>
            <?php endif; ?>
            <p>
                <?php echo Html::a(Yii::t('modules/page', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php echo Html::a(Yii::t('modules/page', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('modules/page', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'pid',
                        'rank',
                        'title',
                        'brief:ntext',
                        'content:ntext',
                        'name',
                        'label',
                        'url:url',
                        'layout',
                        'visible',
                        'page_title',
                        'page_description:ntext',
                        'page_keywords:ntext',
                    ],
                ]) ?>
        </div>
    </div>
</div>

