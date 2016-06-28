<div class="newsletter_listing border-bottom">
<?php $sent_status=$data->send_status;?>
<article>
	<aside class="text_desc_l <?php if($sent_status!=2){?> news-left<?php } ?>">
    <strong><?php echo CHtml::encode($data->subject); ?></strong>
    <div>
	<span class="blue"><?php echo date('l, d F Y',strtotime($data->pub_date)); ?></span> - 
    <?php
    if($sent_status==0) //newsletter has not been sent
    {
        $active_subscribers=Subscribers::getActiveSubscribersCount($data->id);
    ?>
        <span class="red"><?php echo $active_subscribers." Active Subscribers"; ?></span>
        <input type="hidden" value="<?php echo $active_subscribers;?>" id="subscriber_counter_<?php echo $data->id;?>"/>
    <?php
    }
    elseif($sent_status==1) // newsletter sending in progress
    {
    ?>
        <span class="red"><?php echo "Currently Sending..."; ?></span>
    <?php
    }
    elseif($sent_status==2) // newsletter already sent
    {
        $recipients=$data->recipients_no;
    ?>
        <span class="red"><?php echo "Sent to ".$recipients." Recipients"; ?></span>
    <?php
    }
    ?>
    </div>
    </aside>
     
   <aside class="articleButtons text_desc_r">
   <?php if($sent_status==0){?>
           <?php $this->widget('bootstrap.widgets.BootButton', array(
            'url' => array('/admin/newsletters/sendNewsletter/', 'nid'=>$data->id),
            'label'=>'Send Now',
            'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
            'htmlOptions'=>array('class'=>'send_button', 'id'=>'sendbutton_'.$data->id)
        ));?>
   <?php }elseif($sent_status==1){?><a href="javascript:void(0);" class="btn btn-primary">SENDING...</a>
   <?php }elseif($sent_status==2){?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
            'url' => array('/admin/newsletters/sendNewsletter/', 'nid'=>$data->id),
            'label'=>'Resend',
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
            'htmlOptions'=>array('class'=>'send_button net', 'id'=>'sendbutton_'.$data->id)
        ));?>
   <?php } ?>
    </aside>
      <div class="clear"></div>
</article>
</div>

<script>
$(document).ready(function(){
    $('.send_button').each(function(){
        var val = $(this).attr('id').split("_");
        var id=val[1];
        if(id)
        {
            if($('#subscriber_counter_'+id).val()!='' && $('#subscriber_counter_'+id).val()==0)
            {
                $(this).attr('href','#');
                $(this).attr('disabled',true);
            }
        }
    });
});
</script>