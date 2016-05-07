Yii2 page module.
===================

Description
-----------

Module for site "static" pages management.
Has admin area for creating pages with WYSIWYG HTML editor and SEO fields.
Has subpages feature (they will be available via subpaths like page1/page2/page3).
Has JS tree for subpages tree management.
Has page menu widget with a multiple dropdown feature.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bariew/yii2-page-cms-module "*"
```

or add

```
"bariew/yii2-page-cms-module": "*"
```

to the require section of your `composer.json` file.


Usage
-----

* Include 'page' module in the modules config section:
```
    'modules' => [
    ...
        'page'   => [
            'class' => 'bariew\pageModule\Module'
        ],
    ],
```

* Add a new routing rule to your url manager in the components config section:
```
    'components' => [
    ...
        'urlManager' => [
            'rules' => [
                [
                    'class' => 'bariew\pageModule\components\UrlRule',
                    'pattern' => '<url:\\S*>',
                    'route' => 'page/default/view'
                ],
                '<controller>/<action>' => '<controller>/<action>',
                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
```

* Apply migrations from the module migrations folder with a console command:
```
./yii migrate --migrationPath=@vendor/bariew/yii2-page-cms-module/migrations
```

* Go to page/item/index URL and create some pages. Home page is generated as the root by default.
