<?php
Yii::import('zii.widgets.CPortlet');
 
class ArticleMenu extends CPortlet
{
    public function init()
    {
        //$this->title=CHtml::encode(Yii::app()->user->name);
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('articleMenu');
    }
}
?>