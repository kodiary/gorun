<div class="newsletter_listing border_line">
<article>
	<aside class="text_desc_l">
    <span><?php echo CHtml::encode($data->subject); ?></span>
	<span class="f15 blue"><?php echo date('l, d F Y',strtotime($data->pub_date)); ?></span>
</aside>  
   <aside class="text_desc_r">
      <?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Edit',
        'type'=>'info', // 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'url' =>array('details', 'nid'=>$data->id),
    ));?>   
    </aside>
    
      <div class="clear"></div>
	<div class="seperator"></div>
</article>
</div>