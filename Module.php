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

    public function install($moduleName)
    {
        $config = \app\config\ConfigManager::getWriteData();
        $config['components']['urlManager']['rules']['/']
            = $config['components']['urlManager']['rules']['<url:\S+>']
            = "{$moduleName}/default/view";
        \app\config\ConfigManager::set(['components', 'urlManager', 'rules'], $config['components']['urlManager']['rules']);
    }

    public function uninstall()
    {
        $config = \app\config\ConfigManager::getWriteData();
        unset($config['components']['urlManager']['rules']['<url:\\S+>']);
        $config['components']['urlManager']['rules']['/'] = 'site/index';
        \app\config\ConfigManager::set(['components', 'urlManager', 'rules'], $config['components']['urlManager']['rules']);
    }
}
