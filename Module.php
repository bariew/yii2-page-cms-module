<?php

namespace bariew\pageModule;

class Module extends \yii\base\Module
{

    public $params = [
        'menu'  => [
            'label'    => 'Pages',
            'url' => ['/page/item/index'],
        ]
    ];
}
