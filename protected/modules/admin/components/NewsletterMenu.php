<?php
Yii::import('zii.widgets.CPortlet');
 
class NewsletterMenu extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
        $this->render('newsletterMenu');
    }
}
?>