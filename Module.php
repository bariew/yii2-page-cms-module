<?php

namespace bariew\pageModule;

use app\config\ConfigManager;

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
        $config = ConfigManager::getData();
        $config['components']['urlManager']['rules']['/']
            = $config['components']['urlManager']['rules']['<url:\S+>']
            = "{$moduleName}/default/view";
        ConfigManager::put($config);
    }

    public function uninstall()
    {
        $config = ConfigManager::getData();
        unset($config['components']['urlManager']['rules']['<url:\S+>']);
        $config['components']['urlManager']['rules']['/'] = 'site/index';
        ConfigManager::put($config);
    }
}
