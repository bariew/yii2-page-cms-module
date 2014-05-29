<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var bariew\pageModule\models\Item $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
