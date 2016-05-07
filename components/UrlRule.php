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
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        if (!$result = parent::parseRequest($manager, $request)) {
            return $result;
        }
        return Item::getCurrentPage($request->pathInfo) ? $result : false;
    }
}