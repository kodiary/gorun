<?php if($status=='updated' || isset($email)){ $this->widget('bootstrap.widgets.BootAlert'); }?>

    <?php if(isset($email) && $email!=''){ ?>

        <div class="margintopbot10 f14 blue">Manage the subscription for <strong>"<?php echo $email?>"</strong></div>
        <div class="line"></div>
        <div class="limegreen">Your Email Subscription</div>
        <?php /** @var BootActiveForm $form */
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'subscribe-form',
            'action'=>Yii::app()->createUrl('/subscribers/subscription'),
            'type' =>'horizontal',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        
        <?php echo $form->hiddenField($model,'email',array('value'=>$email)); ?>
        <?php echo $form->radioButtonListInlineRow($model,'subscribe_newsletters',array('1'=>'<strong>Subscribe</strong>', '0'=>'<strong>Unsubscribe</strong>'));?>
        <div class="line"></div>
        <div class="controls">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','size'=>'large','label'=>' Submit ','type'=>'primary','htmlOptions'=>array('name'=>'submit'))); ?>
        </div>
        <div class="clear"></div>
        <div class="line"></div>
        <?php $this->endWidget(); ?>
        
    <?php } else { ?>
    
        <div class="margin10">Lookup your e-mail to control your EXSA subscription</div>
        <?php /** @var BootActiveForm $form */
            $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'subscribe-form',
                'action'=>Yii::app()->createUrl('/subscribers/manage'),
                //'type' =>'vertical',
                //'enableAjaxValidation'=>true,
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            ));
        ?>
        <?php echo $form->textField($model, 'email', array('class'=>'span5 mar-bot-10','placeholder'=>'E-mail Address')); ?>
        <?php echo $form->error($model,'email'); ?>
        <div class="clear"></div>
        <div class="controls margintop10">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit','size'=>'large','label'=>' Submit ','type'=>'primary','htmlOptions'=>array('name'=>'btnSubscribe'))); ?>
        </div>
        <div class="clear"></div>
        <?php $this->endWidget(); ?>
        
    <?php }//end of else ?>