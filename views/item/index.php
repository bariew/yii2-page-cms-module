<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var bariew\pageModule\models\ItemSearch $searchModel
 */

$this->title = Yii::t('modules/page', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-3 well">
        <?= \Yii::$app->controller->menu; ?>
    </div>
    <div class="col-md-9">

    </div>
</div>