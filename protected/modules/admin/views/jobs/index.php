<div class="left_body">
<div class="line"></div>
<h1>Jobs - <span class="blue"><?php if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>List of Jobs<?php } ?></span></h1>
<div class="line"></div>
<?php
/*
$default= array('label'=>'Select Company', 'url'=>array('index'));

if($companyId)
    $default= array('label'=>substr(Company::companyInfo($companyId,'name')->name,0,30), 'url'=>array('/admin/jobs/index/companyId/'.$companyId));
    
$company = Company::model()->findAll('',array('order'=>'name ASC'));
if(!empty($company))
{
    foreach($company as $key=>$val)
    {
        if($inactive=='1')
            $array[]=array('label'=>$val->name,'url'=>array('/admin/jobs/inactive/companyId/'.$val->id));
        else
            $array[]=array('label'=>$val->name,'url'=>array('/admin/jobs/index/companyId/'.$val->id));     
    }
}
else 
    $array[] = '';
?>
  <div class="autherList">
    <div class="home floatLeft"> <a href="<?php echo $this->createUrl('/admin/company');?>" class="btn"><i class="icon-home"></i></a> </div>
    <!--h_button-->
    <div class="btn-toolbar floatLeft">
      <?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
            'type'=>'primary', 
            'buttons'=>array(
                $default,
                array('items'=>$array),
            ),
            ));?>
    </div>
    <!--btn-toolbar-->
    <div class="clear"></div>
  </div>
*/ ?>

<?php
    $newest = '/admin/jobs/'.$this->action->id;
    $oldest = '/admin/jobs/'.$this->action->id.'/order/oldest';
    $mostread = '/admin/jobs/'.$this->action->id.'/order/mostread'; 
?>
<ul class="admin_top_navs">
<li><?php echo CHtml::link('Newest', array($newest), array('class'=>($_GET['order']=='' || !isset($_GET['order'])=='index') ?'active' : ''));?></li>
<li><?php echo CHtml::link('Oldest', array($oldest), array('class'=>($_GET['order']=='oldest') ?'active' : ''));?></li>
<li><?php echo CHtml::link('Most Read', array($mostread), array('class'=>($_GET['order']=='mostread') ?'active' : ''));?></li>
</ul>

<?php
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['items_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.jobs_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more jobs.',
    'pages' => $pages,
));?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('/admin/jobs/'.$this->action->id.'/showall');
    if(isset($_GET['order'])) $url_value = $this->createUrl('/admin/jobs/'.$this->action->id.'/order/'.$_GET['order'].'/showall');
    if(isset($_GET['companyId']) && $_GET['companyId']>0) $url_value = $this->createUrl('/admin/jobs/'.$this->action->id.'/companyId/'.$_GET['companyId'].'/showall');    
    
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
</div>

<div class="right_body">
<?php $this->renderPartial('_sidebar')?>
</div>
<div class="clear"></div>


<script>
$(document).ready(function(){
    $('#company').change(function()
    {
        $('.div600').html('Loading...');
        var id = $(this).val();
        $.ajax({
            url:'<?php echo $this->createUrl('listjobs'); ?>',
            type:'post',
            data:'id='+id,
            success:function(msg){
                $('.div600').html(msg);
            }     
        });
    });
})
</script>