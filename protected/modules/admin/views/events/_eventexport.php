<div class="col-md-8">
    <div class="line"></div>
    <h1>Export - <span class="blue">Export events to an Excel document</span></h1>
    <div class="line"></div>
    <div style="padding:15px;background:#ECECEC;border-radius:10px;border:1px solid #DDDDDD;">
       
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'article-form',
	'action'=>Yii::app()->baseUrl.'/admin/events/ExporttoExcel',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
));?>

        
        <b>From</b>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'start_date',
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd MM yy',
                    //'minDate'=>0,
                    //'buttonImage'=>Yii::app()->baseUrl.'/images/calender.png',
                    'buttonImageOnly'=>true,
                    //'showOn'=>"both",
                    'constrainInput'=>true,
        			
                    //'buttonText'=>'17',
                    //'altFormat' => 'dd-mm-yy', // show to user format
                ),
                'htmlOptions'=>array(
                    'class'=>'datePickerTxtBox1 required',
                    'value'=>CommonClass::formatDate(Articles::model()->publish_date),
                    'style'=>'background-image:url("/images/admin/calender.png"); background-position:5px center; background-repeat:no-repeat;width:150px;padding-left:20px;margin-left:20px;margin-right:20px;'
                ),
            )); ?>
        <b>To</b>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'end_date',
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd MM yy',
                    //'minDate'=>0,
                    //'buttonImage'=>Yii::app()->baseUrl.'/images/calender.png',
                    'buttonImageOnly'=>true,
                    //'showOn'=>"both",
                    'constrainInput'=>true,
        			
                    //'buttonText'=>'17',
                    //'altFormat' => 'dd-mm-yy', // show to user format
                ),
                'htmlOptions'=>array(
                    'class'=>'datePickerTxtBox1',
                    'value'=>CommonClass::formatDate(Articles::model()->publish_date),
                    'style'=>'background-image:url("/images/admin/calender.png"); background-position:5px center; background-repeat:no-repeat;width:150px;padding-left:20px;margin-left:20px;margin-right:20px;'
                ),
            )); ?>
        <input type="submit" name="submit" class="btn btn-info" value="Export" />
        <?php $this->endWidget(); ?>


    </div>
</div>
<div class="col-md-4">
</div>
<div class="clear"></div>
