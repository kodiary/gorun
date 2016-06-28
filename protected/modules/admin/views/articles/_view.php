<div class="article_listing article-list border_line">
<article id="<?php echo $data->id?>">

    <div class="text_desc_l">
      <span><?php echo $data->title?></span>
      <span class="f15 blue">
      <?php if($data->publish_date!='0000-00-00') echo CommonClass::formatDate($data->publish_date, 'd F Y');?>
      </span>
    </div>
    <!--articleDetail-->
    
    <div class="text_desc_r">
    <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Edit',
            'type'=>'info', // 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'large', 'small' or 'mini'
            'url' =>array('update', 'id'=>$data->id),
            //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
        ));
    ?>
    </div>
    <!--articleBUttons-->


  <!--articleContent-->
  <div class="clear"></div>
</article>
</div>