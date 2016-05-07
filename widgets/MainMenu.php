<?php
/**
 * MainMenu class file.
 * @copyright (c) 2015, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\pageModule\widgets;
use bariew\dropdown\Nav;
use \bariew\pageModule\models\Item;
use yii\helpers\Url;

/**
 * Widget for the site main menu.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class MainMenu extends Nav
{
    /**
     * Each li item options.
     * @var array html options.
     */
    public $itemOptions = [];
    
    /**
     * @inheritdoc
     */
    public function init() 
    {
        parent::init();
        $cssClass = @$this->options['class'];
        if ($cssClass != $this->options['class']) {
            \yii\helpers\Html::removeCssClass($this->options, 'nav');
        }
        $this->items = Item::find()
            ->select(['*', 'parent_id' => '(IF(pid=1,"",pid))', 'name' => 'title'])
            ->where(['visible' => true])
            ->andWhere(['<>', 'pid', ''])
            ->indexBy('id')
            ->orderBy(['rank' => SORT_ASC])
            ->asArray()
            ->all();
    }

    /**
     * @inheritdoc
     */
    protected function isItemActive($item)
    {
        return Url::to($item['url']) == Url::to(['/' . \Yii::$app->request->pathInfo]);
    }
}
