<div class="right_bar_blocks">
<!-- start right side bar-->
<div class="right_btns">

<?php 
    if(isset($_GET['id'])){
        $companyId = $_GET['id'];
        $createUrl =  array('create', 'id'=>$companyId);
    }
    else{
        $companyId = Yii::app()->user->id;
        $createUrl =  array('create');
    }
?>
        
<?php $this->widget('bootstrap.widgets.BootButton', array(
                    'url' => $createUrl,
                    'label'=>'+Add Specials',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>

<div class="well">
<h3>Active Specials</h3>
<ul>
<?php if($dataProvider = Specials::getAllSpecials($companyId))
foreach($dataProvider as $val){?>
<?php if($val->status==1){
    if($val->filename){?>
<li>
        <?php echo CHtml::ajaxLink($val->title, $this->createUrl('/site/menu', array('url'=>urlencode(Yii::app()->request->hostInfo.'/documents/'.$val->filename), 'title'=>$val->title)),array('success'=>'function(data){$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>'linkings'));?>
        </li>
        <?php 
    }
    else{?>
        <li>
        <?php echo $val->title;?>
        </li>
    <?php }}}?>                    
</ul>

<h3>Inactive Specials</h3>
<ul>
<?php if($dataProvider)
{foreach($dataProvider as $val){
    if($val->status==0){
        if($val->filename){?>
    <li>
    <?php echo CHtml::ajaxLink($val->title, $this->createUrl('/site/menu', array('url'=>urlencode(Yii::app()->request->hostInfo.'/documents/'.$val->filename), 'title'=>$val->title)),array('success'=>'function(data){$("#menu_popup").html(data).dialog("open");}'),array('id'=>'showMenu'.uniqid(), 'class'=>'linkings'));?>
	</li>       
<?php } else{?><li><?php echo $val->title;?></li><?php }}}}?>
</ul>
</div>
<!-- end right side bar-->
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'menu_popup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        //'title'=>'Menu',
        'autoOpen'=>false,
        //'draggable'=>false,
        'resizable'=>false,
        'height'=>'auto',
        'width'=>'auto',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
$('#menu_popup').empty();
}",

        //'cssFile'=>
    ),
));?>

<div id="update_data"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
