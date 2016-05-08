<?php
/**
 * UrlRule class file.
 * @copyright (c) 2016, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\pageModule\components;


use bariew\pageModule\models\Item;

/**
 * Routing rule for app config.
 * @see README
 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class UrlRule extends \yii\web\UrlRule
{
    /**
     * @var bool whether to use matching page seo tags on other modules pages
     */
    public $enforceSeo = false;

    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        if (!$result = parent::parseRequest($manager, $request)) {
            return false;
        }
        if ($this->enforceSeo) {
            Item::getCurrentPage($request->pathInfo); // sets seo meta tags
        }
        $manager->rules = array_filter($manager->rules, function($rule) {
            return !$rule instanceof $this;
        });
        if (!$result2 = $manager->parseRequest($request)) {
            return $result;
        }

        return \Yii::$app->createController($result2[0]) ? $result2 : $result;
    }
}