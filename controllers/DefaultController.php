<?php

namespace bariew\pageModule\controllers;
use bariew\pageModule\models\Item;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionView($url = '/')
    {
        $model = Item::find()->where([
            'url' => preg_replace('/[\/]{2,}/', '/', '/' . $url . '/'),
            'visible' => Item::VISIBLE_YES
        ])->orderBy('id DESC')->one();

        if (!$model) {
            throw new \yii\web\HttpException(404, "Page not found");
        }
        
        if ($model->layout) {
            $this->layout = $model->layout;
        }
        
        return $this->render('view', compact('model'));
    }

}
