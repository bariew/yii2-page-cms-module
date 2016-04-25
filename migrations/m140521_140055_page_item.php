<?php
use bariew\pageModule\models\Item;

class m140521_140055_page_item extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable(Item::tableName(), array(
            'id'        => 'pk',
            'pid'       => 'INT(11) DEFAULT 1',
            'rank'      => 'INT(11) DEFAULT 0',
            'title'     => 'string',
            'brief'     => 'text',
            'content'   => 'text',
            'name'      => 'string',
            'label'     => 'string',
            'url'       => 'string',
            'layout'    => 'string',
            'visible'   => 'TINYINT(1) DEFAULT 1',
            'page_title'        => 'string',
            'page_description'  => 'text',
            'page_keywords'     => 'text'
        ));
        $this->insert(Item::tableName(), array(
            'pid'       => 0,
            'title'     => 'Home page',
            'url'       => '/',
            'visible'   => 1,
            'page_title'=> 'Home page',
            'label'     => Yii::$app->name,
            'content'   => '<div class="jumbotron"><p class="lead">Welcome to Page module Home page!</p></div>'
        ));
        return true;
    }

    public function safeDown()
    {
        return $this->dropTable(Item::tableName());
    }
}
