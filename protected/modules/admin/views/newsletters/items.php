<aside class="col-md-8 addArticles addNewsletterItems">
  <?php $this->renderPartial('_newslettermenu');?>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  <div class="addContentArea"> 
    <?php if($model->template_id==1){ ?>  
    <!-- add artilces -->
    <div class="greybg mar-bot-10" style="padding: 6px 10px;">
      <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
        	'id'=>'articles-form',
        	'enableAjaxValidation'=>false,
        )); ?>
      <div class="floatLeft"><span class="lbl">Articles</span> <?php echo $form->dropDownList($itemModel,'item_id', CHtml::listData(Articles::getArticlesNotInNewsletter($_GET['nid']), 'id', 'title'),array('empty'=>'Select Article')); ?>
        <div class="clear"></div>
      </div>
      <input type="submit" name="addArticles" value="Add" class="btn btn-info floatRight"/>
      <div class="clear"></div>
      <?php $this->endWidget(); ?>
    </div>
    <ul class="mar-bot-10">
      <?php
    if(!empty($nitems['articles']))
    {
        foreach($nitems['articles'] as $data)
        {
           $article=Articles::articleInfo($data->item_id);
            /*if($article->author_id)
            {
                $author=Authors::authorInfo($article->author_id,'name')->name;
            }*/
        ?>
      <li class="addedNewsItem">
        <figure class=" floatLeft"><span class="thumbnail">
        <?php echo Articles::Image(Articles::get1ImageFromFile($data->item_id), 'thumb', Articles::get1ImageFromFile($data->item_id))?></span></figure>
        <aside class="autherDetail floatRight">
          <h1><?php echo $article->title; ?></h1>
          <p><span class="blue"><?php echo CommonClass::formatDate($article->publish_date, 'd F Y');?> - </span><?php echo CommonClass::limit_text($article->detail);?></p>
          <a href="<?php echo $this->createUrl('/admin/newsletters/deleteitem/id/'.$data->id);?>" onclick="return confirm('Are you sure you want to delete this item?');" class="close"><img src="<?php echo Yii::app()->baseUrl; ?>/images/admin/close1.png" /></a> </aside>
        <!--autherDetail-->
        <div class="clear"></div>
      </li>
      <div class="line"></div>
      <?php
        }
    }
    ?>
    </ul>
    <!-- add artilces  end--> 

    <!-- add events -->
    <div class="greybg mar-bot-10" style="padding: 6px 10px;">
      <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
        	'id'=>'events-form',
        	'enableAjaxValidation'=>false,
        )); ?>
      <div class="floatLeft"><span class="lbl">Events</span> <?php echo $form->dropDownList($itemModel,'item_id', CHtml::listData(Events::getEventsNotInNewsletter($_GET['nid']), 'id', 'title'),array('empty'=>'Select Event')); ?></div>
      <input type="submit" name="addEvents" value="Add" class="btn btn-info floatRight"/>
      <div class="clear"></div>
      <?php $this->endWidget(); ?>
    </div>
    <ul class="mar-bot-10">
      <?php
    if(!empty($nitems['events']))
    {
        foreach($nitems['events'] as $data)
        {
            $imagefile = Events::eventInfo($data->item_id,'logo');
            $event = Events::eventInfo($data->item_id);
            ?>
            <li class="addedNewsItem">
            <figure class="floatLeft"><span class="thumbnail"><?php echo Events::Image($imagefile->logo, 'thumb', $imagefile->title)?></span></figure>
            <aside class="autherDetail floatRight">
              <span class="red">
                <?php if($event->start_date!='0000-00-00' && $event->start_date<$event->end_date){
                    echo CommonClass::formatDate($event->start_date, 'd F')." - ".CommonClass::formatDate($event->end_date, 'd F, Y');
                }else{
                    echo CommonClass::formatDate($event->start_date, 'd F Y');
                }?>
              </span>
              <h1><?php echo $event->title; ?></h1>
              <p>
                <?php
                    if($event->venue_id=="0")
                    {
                        $venue=Venues::model()->findByAttributes(array('event_id'=>$event->id));
                        $venue_location=$venue->title.", ".$venue->address;
                    }
                    else
                    {
                        $venue=Company::model()->findByPk($event->venue_id);
                        $venue_location=$venue->name;
                    }
                    echo $venue_location;
                ?>
              </p>
              </span> <a href="<?php echo $this->createUrl('/admin/newsletters/deleteitem/id/'.$data->id);?>" onclick="return confirm('Are you sure you want to delete this item?');" class="close"><img src="<?php echo Yii::app()->baseUrl; ?>/images/admin/close1.png" /></a> </aside>
            <!--autherDetail-->
            <div class="clear"></div>
            </li>
      <div class="line"></div>
      <?php
        }
    }
    ?>
    </ul>
    <!-- add events  end-->  
   
    <div class="greybg"> <div style="margin-left:92px;"><?php echo CHtml::link('Submit',array('/admin/newsletters/build/nid/'.$_GET['nid']),array('class'=>'btn btn-primary btn-large'));?> </div>
  </div>
  <?php }else{ ?>
    <div class="red">Included items only apply to the "EXSA Express" template</div>
  <?php } ?>
  </div>

</aside>
<aside class="col-md-4 addArticles">
    <?php $this->renderPartial('_sidebar'); ?>
</aside>
<div class="clear"></div>