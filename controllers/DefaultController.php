<?php

namespace bariew\pageModule\controllers;
use bariew\pageModule\models\Item;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionView($url = '/')
    {
        if (!$model = Item::find()->where(compact('url'))->orderBy('id DESC')->one()) {
            throw new \yii\web\HttpException(404, "Page not found");
        }
        
        if ($model->layout) {
            $this->layout = $model->layout;
        }
        
        return $this->render('view', compact('model'));
    }

}
