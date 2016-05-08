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
    public $enforceSeo = false;
    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        if (!$result = parent::parseRequest($manager, $request)) {
            return false;
        }
        if (!Item::getCurrentPage($request->pathInfo)) {
            return false;
        }
        // this will return real module/controller/action instead of existing page but with seo metatags
        if ($this->enforceSeo) {
            $manager->rules = array_filter($manager->rules, function($rule) {
                return !$rule instanceof $this;
            });
            if (!$result2 = $manager->parseRequest($request)) {
                return $result;
            }
            if (\Yii::$app->createController($result2[0])) {
                return $result2;
            }
        }

        return $result;
    }
}