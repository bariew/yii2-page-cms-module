<?php
/**
 * MainMenu class file.
 * @copyright (c) 2015, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\pageModule\widgets;
use \bariew\pageModule\models\Item;
use yii\helpers\Url;

/**
 * Widget for site main menu.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class MainMenu extends \yii\bootstrap\Nav
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
        $cssClass = @$this->options['class'];
        parent::init();
        if ($cssClass != $this->options['class']) {
            \yii\helpers\Html::removeCssClass($this->options, 'nav');
        }
        $this->setItems();
    }
    
    /**
     * Sets menu items from db page items.
     */
    private function setItems()
    {
        $models = Item::find()->where(['visible' => true])
            ->orderBy(['rank' => SORT_ASC])
            ->all();
        /**
         * @var Item $model
         */
        foreach ($models as $model) {
            $this->items[] = [
                'label' => $model->label,
                'url'   => [$model->url],
                'options' => $this->itemOptions
            ];
        }
    }
    
    /**
     * @inheritdoc
     */
    protected function isItemActive($item)
    {
        return Url::to($item['url']) == Url::to(['/' . \Yii::$app->request->pathInfo]);
    }
}
