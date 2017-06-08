<?php
Yii::import('zii.widgets.CPortlet');

class EventMenu extends CPortlet
{
    public function init()
    {
        parent::init();
    }
    
    protected function renderContent()
    { 
        $this->render('eventMenu');
    }
    
    
}

