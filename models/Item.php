<?php
/**
 * Item class file.
 * @copyright (c) 2016, Pavel Bariev
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\pageModule\models;

use bariew\nodeTree\ARTreeBehavior;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $pid
 * @property integer $rank
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $name
 * @property string $url
 * @property string $layout
 * @property integer $visible
 * @property string $page_title
 * @property string $page_description
 * @property string $page_keywords
 *
 * @mixin ARTreeBehavior

 * @author Pavel Bariev <bariew@yandex.ru>
 *
 */
class Item extends ActiveRecord
{
    const VISIBLE_YES = 1;
    const VISIBLE_NO = 0;
    public static $currentPage = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{page_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'visible'], 'default', 'value' => 1],
            [['title'], 'required', 'except'=>'nodeTree'],
            [['name'], 'required', 'except'=>'nodeTree', 
                'when' => function() { return $this->pid; },
                'whenClient' => 'function($attribute, $value) { return false; }'
            ],
            [['pid', 'rank', 'visible'], 'integer'],
            [['brief', 'content', 'page_description', 'page_keywords'], 'string'],
            [['title', 'name', 'url', 'layout', 'page_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('modules/page', 'ID'),
            'pid' => Yii::t('modules/page', 'Pid'),
            'rank' => Yii::t('modules/page', 'Rank'),
            'title' => Yii::t('modules/page', 'Title'),
            'brief' => Yii::t('modules/page', 'Brief'),
            'content' => Yii::t('modules/page', 'Content'),
            'name' => Yii::t('modules/page', 'Path'),
            'url' => Yii::t('modules/page', 'Url'),
            'layout' => Yii::t('modules/page', 'Layout'),
            'visible' => Yii::t('modules/page', 'Visible'),
            'page_title' => Yii::t('modules/page', 'SEO Title'),
            'page_description' => Yii::t('modules/page', 'SEO Description'),
            'page_keywords' => Yii::t('modules/page', 'SEO Keywords'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scopes()
    {
        return [
            'visible'           => ['condition'=>"visible = 1", "order"=>"rank"],
            'visibleChildren'   => ['condition'=>"visible = 1 AND pid = $this->id", "order"=>"rank"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'nodeTree' => [
                'class'         => ARTreeBehavior::className(),
                'actionPath'    => '/page/item/update'
            ]
        ];
    }

    /**
     * Gets a page by the url.
     * @param string $url
     * @return bool|null|static
     */
    public static function getCurrentPage($url = '')
    {
        if (static::$currentPage !== false) {
            return static::$currentPage;
        }
        /** @var static $model */
        $model = static::find()->where([
            'url' => preg_replace('/[\/]{2,}/', '/', '/' . $url . '/'),
            'visible' => static::VISIBLE_YES
        ])->orderBy('id DESC')->one();
        if (!$model) {
            return static::$currentPage = null;
        }
        if ($model->layout) {
            Yii::$app->controller->layout = $model->layout;
        }
        Yii::$app->view->title = $model->page_title;
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->page_description]);
        Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $model->page_keywords]);
        return static::$currentPage = $model;
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if (!$this->pid) {
            throw new Exception("Can not delete the root page");
        }
        return parent::beforeDelete();
    }
}
