<div class="rsvpForm well">
<div class="rsvphdr">
<table width="100%">
<?php if($event_type==0){?>

<tr>
<td width="29%">&nbsp; </td><td> <h3>RSVP for this event now</h3></td>
</tr>
<tr>
<td>&nbsp;</td><td> <p class="green">Please complete and submit the form below.</p></td>
</tr> 

<?php }elseif($event_type==1){?>

<tr>
<td width="29%" class="alignRight"><img src="<?php echo Yii::app()->baseUrl.'/images/closeBig.png'; ?>"  alt="Closed Event"/> </td><td> <h3>A Closed Event - By Invite Only</h3>
<p class="green">Request an invite by completing the form below.</p>
</td>
</tr>

<?php }?>
</table>
</div>
<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'RSVPForm',
        'type'=>'horizontal',
        'action'=>$this->createUrl('/events/rsvp'),
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions' => array('validateOnSubmit'=>true,'validateOnType'=>true),
        'htmlOptions'=>array('class'=>''),
    )); ?>
<div class="">
    <?php echo $form->textFieldRow($model, 'firstname', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'surname', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'position', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'company', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'email', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'phone', array('class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'dietry_requirements', array('class'=>'span3'));?>
    <?php echo $form->hiddenField($model, 'event_id', array('value'=>$event_id));?>
    <?php echo $form->hiddenField($model, 'type', array('value'=>$event_type));?>
</div>
<div class="footerRSVP">
  <?php $this->widget('bootstrap.widgets.BootButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
		'size'=>'large',
        //'url'=>$this->createUrl('/events/rsvp'),
        'label'=>'Submit RSVP',
        'htmlOptions'=>array('name'=>'btnRSVP'),
    ));?>
  <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Cancel',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    ));?>
</div></div>
<?php $this->endWidget(); //end form?>