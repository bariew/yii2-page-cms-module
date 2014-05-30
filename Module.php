<?php

namespace bariew\pageModule;

class Module extends \yii\base\Module
{
    public function getParams()
    {
        return require __DIR__ . '/params/main.php';
    }
}
