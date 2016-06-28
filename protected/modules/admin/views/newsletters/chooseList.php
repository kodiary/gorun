<aside class="left_body newsletters">
<?php $this->renderPartial('_newslettermenu');?>
<div class="line"></div>
<h1>Mailing List - <span class="blue">Select One or More lists to send to - (Required)</span></h1><!-- &nbsp; &nbsp; &nbsp; <a href="javascript:void(0)" class="btn all-none">All/None</a>-->
<div class="line"></div>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'newsletters-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true),
)); ?>

<?php
$list = SubscribersList::model()->findAll();
if($list)
{
    foreach($list as $l)
    {
        $count = SubscribersDetail::model()->countByAttributes(array('list_id'=>$l->id));
        $detect = NewsletterList::model()->findAllByAttributes(array('newsletter_id'=>$_GET['nid'],'list_id'=>$l->id));
        ?>
            <div class="greybg mar-bot-6">
                <div class="floatLeft"><input type="checkbox" class="sub_list" id="<?php echo $l->id;?>" value="<?php echo $l->id;?>" <?php if($detect)echo "checked";?> name="Newsletter_list[list_id][]"/> &nbsp; &nbsp;<strong><?php echo $l->title;?></strong> - <span class="green"><?php echo $count;?> member(s)</span></div>
                <div class="clear"></div>
            </div>
        <?php
    }
    $totalemails = Subscribers::getActiveSubscribersCount($_GET['nid']);
?>
<h3 style="margin: 15px 0;">Total Selection - <span class="blue"><span class="count"><?php echo $totalemails; ?></span> Emails (Duplicates Omitted)</span></h3>

<div class="greybg">
<div class="margin-left:70px;">
<?php $this->widget('bootstrap.widgets.BootButton', array(
	'buttonType'=>'submit',
	'size'=>'large', // '', 'large', 'small' or 'mini'
	'type'=>'primary',
	'label'=>'Submit',
    'htmlOptions'=>array('name'=>'submit','style'=>'margin-left:120px;')
)); ?>
<?php $this->endWidget(); ?>
</div>
</div>

<!--<div class="well">
<a href="<?php //echo $this->createAbsoluteUrl('/admin/newsletters/preview/nid/'.$_GET['nid']);?>" class="btn btn-primary btn-large" style="width:100px;margin-left: 100px;">Submit</a>
</div>-->
<?php
}
?>
<div class="clear"></div>
</aside>
<aside class="right_body addArticles">
    <?php $this->renderPartial('_sidebar'); ?>
</aside>
<div class="clear"></div>
<script type="text/javascript">
 $(function(){
    $('.all-none').click(function(){
        var i = 0;
        var j = 0
        $('.sub_list').each(function(){
            j++;
            if($(this).is(':checked'))
            i++;
            });
            if(i>0 && i<j)
            {
                $('.sub_list').each(function(){
                    
                    if($(this).is(':checked'))
                    {
                        
                    }
                    else
                    $(this).click();
                });
            }
            if(i == 0 || i == j)
            {
                $('.sub_list').each(function(){
                    $(this).click();
                });
            }
            
    });
    $('.sub_list').live('click',function(){
       var list = $(this).attr('id');
       var nid = <?php echo $_GET['nid'];?>;
       var ids = '';
        $('.sub_list').each(function(){            
        if($(this).is(':checked'))
        {
            ids = ids+$(this).attr('id')+',';
        }
        });
        $.ajax({
           url:'<?php echo $this->createAbsoluteUrl('/admin/newsletters/countEmail')?>',
           data:'nid=<?php echo $_GET['nid']?>&ids='+ids,
           type:'post',
           success:function(res){
            $('.count').text(res);
           }
        });  
    });
 });
 </script>