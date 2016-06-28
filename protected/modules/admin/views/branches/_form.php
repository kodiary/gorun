<?php 
$form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'company-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array('class'=>'update-company-form'),
)); ?>
<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>
<div class="line"></div>
<?php echo $form->textFieldRow($model,'number',array('class'=>'span5','maxlength'=>255)); ?>
    
<?php echo $form->textFieldRow($model,'fax',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'manager',array('class'=>'span5','maxlength'=>255)); ?>
<div class="additional_extra">Manager name of branch</div>

<h2 class="border_tagLine">Company Location</h2>
 
<?php echo $form->textAreaRow($model,'display_address',array('class'=>'span5','rows'=>5)); ?>

<div class="additional_extra blue">Address that will display on your advert</div>

<div class="line"></div>

<h2>Google Map - <span>Locate the company on the map</span></h2>

<?php echo $form->dropDownListRow($model, 'country', CHtml::listData(Countries::model()->findAll(array('order'=>'name ASC')), 'id', 'name'),array('empty'=>'Select Country','onchange'=>'getProvince($(this).val());')); ?>

<?php echo $form->textAreaRow($model,'street_add',array('class'=>'span5','rows'=>5)); ?>

<?php echo $form->textFieldRow($model,'suburb',array('class'=>'span5','id'=>'city','onBlur'=>'codeAddress()')); ?>
    
<?php echo $form->dropDownListRow($model, 'province', CHtml::listData(Province::model()->findAll('country_id='.$model->country,array('order'=>'name ASC')), 'id', 'name'),array('empty'=>'Select Province','onchange'=>'codeAddress();')); ?>
<div class="line"></div>
  <div class="control-group">
	<label class="control-label">Coordinates</label>
    <div class="controls">
    <div class="sn_group">
    	<div class="s1"><?php echo $form->textField($model, 'latitude',array('placeholder'=>'Latitude','style'=>'width:127px;','onBlur'=>'updateMapPinPosition();') );?></div>
        <div class="s2"><?php echo $form->textField($model, 'longitude',array('placeholder'=>'Longitude','style'=>'width:125px;margin-left:50px;','onBlur'=>'updateMapPinPosition();') ); ?></div>
        <div class="clear"></div>
     </div>
    </div>
    <div class="clear"></div>
</div>
<?php
    if(!$model->isNewRecord)
    {
        $code=Countries::model()->findByPk($model->country)->code;
    }
    if($code=="") $code='ZA';
?>
<input type="hidden" name="code" id="code" value="<?php echo $code;?>"/>
<!-- gmap -->
<div id="map_canvas" style="width: 600px; height: 300px;"></div>
<h2 style="margin-top:5px;"><span>Drag the pin to reposition it if necessary</span></h2>
<div class="line"></div>
<!-- gmap ends -->
<div class="control-group">
     <label class="control-label">&nbsp;</label>
     <div class="controls">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
        'size' =>'large',
		'label'=>'Submit',
	)); ?>
    <div class="clear"></div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
// <![CDATA[
function getProvince(country)
{
	$.ajax({
	   	type: 'post',
		url: '<?php echo $this->createUrl('getProvince')?>',
		data: {country_id: country},
		cache: false,
		dataType: 'json',
		success: function(data){
			$('#Branches_province').html(data.states);
            $('#code').val(data.code);
		}
	});
}
/*]]>*/     
</script>