<?php

namespace bariew\pageModule\models;

use Yii;

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
 */
class Item extends \yii\db\ActiveRecord
{
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
        return 'page_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'visible'], 'default', 'value' => 1],
            [['title', 'label'], 'required', 'except'=>'nodeTree'],
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
            'id' => Yii::t('app', 'ID'),
            'pid' => Yii::t('app', 'Pid'),
            'rank' => Yii::t('app', 'Rank'),
            'title' => Yii::t('app', 'Title'),
            'brief' => Yii::t('app', 'Brief'),
            'content' => Yii::t('app', 'Content'),
            'name' => Yii::t('app', 'Name'),
            'label' => Yii::t('app', 'Label'),
            'url' => Yii::t('app', 'Url'),
            'layout' => Yii::t('app', 'Layout'),
            'visible' => Yii::t('app', 'Visible'),
            'page_title' => Yii::t('app', 'Page Title'),
            'page_description' => Yii::t('app', 'Page Description'),
            'page_keywords' => Yii::t('app', 'Page Keywords'),
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
                'class'         => 'bariew\nodeTree\ARTreeBehavior',
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
