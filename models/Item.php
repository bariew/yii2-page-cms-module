<?php

namespace bariew\pageModule\models;

use bariew\nodeTree\ARTreeBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_item".
 *
 * @property integer $id
 * @property integer $pid
 * @property integer $rank
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property string $name
 * @property string $label
 * @property string $url
 * @property string $layout
 * @property integer $visible
 * @property string $page_title
 * @property string $page_description
 * @property string $page_keywords
 *
 * @mixin ARTreeBehavior
 */
class Item extends ActiveRecord
{
    const VISIBLE_YES = 1;
    const VISIBLE_NO = 0;


    public $descendants = array();
    public static $currentPage = false;
	
    public function getSeoAttributes()
    {
        return [
            'title'             => $this->title,
            'page_title'        => $this->page_title,
            'page_description'  => $this->page_description,
            'page_keywords'     => $this->page_keywords,
        ];
    }
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
            [['label'], 'required', 'except'=>'nodeTree'],
            [['name'], 'required', 'except'=>'nodeTree', 
                'when' => function() { return $this->pid; },
                'whenClient' => 'function($attribute, $value) { return false; }'
            ],
            [['pid', 'rank', 'visible'], 'integer'],
            [['brief', 'content', 'page_description', 'page_keywords'], 'string'],
            [['title', 'name', 'label', 'url', 'layout', 'page_title'], 'string', 'max' => 255]
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
            'name' => Yii::t('modules/page', 'Name'),
            'label' => Yii::t('modules/page', 'Label'),
            'url' => Yii::t('modules/page', 'Url'),
            'layout' => Yii::t('modules/page', 'Layout'),
            'visible' => Yii::t('modules/page', 'Visible'),
            'page_title' => Yii::t('modules/page', 'Page Title'),
            'page_description' => Yii::t('modules/page', 'Page Description'),
            'page_keywords' => Yii::t('modules/page', 'Page Keywords'),
        ];
    }
    
    public function scopes()
    {
        return [
            'visible'           => ['condition'=>"visible = 1", "order"=>"rank"],
            'visibleChildren'   => ['condition'=>"visible = 1 AND pid = $this->id", "order"=>"rank"],
        ];
    }
    
    public function behaviors()
    {
        return [
            'nodeTree' => [
                'class'         => ARTreeBehavior::className(),
                'actionPath'    => '/page/item/update'
            ]
        ];
    }
    
    public static function getCurrentPage()
    {
        return (self::$currentPage !== false)
            ? self::$currentPage
            : self::$currentPage = self::findOne(['url'=>$_SERVER['REQUEST_URI']]);
    }
}
