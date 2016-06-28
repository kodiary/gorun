<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
  <?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Comments - <span class="blue">Display or hide the Disqus comments for this article</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  
  <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
  ));?>

    <div class="addContentArea">
	<ul>
        <li class="greybg radioOption">
            <?php echo $form->radioButtonListRow($model, 'comment_option', array('1'=>'ON - Allow', '0'=>'OFF - No Commenting'));?>
            <div class="clear"></div>
        </li>
        
        <li class="greybg">
            
                <?php $this->widget('bootstrap.widgets.BootButton', array(
        			'buttonType'=>'submit',
        			'size'=>'large', // '', 'large', 'small' or 'mini'
        			'type'=>'primary',
        			'label'=>'Submit',
        	    )); ?>
            
        </li>
    </ul>
    </div>

  <?php $this->endWidget(); ?>  
  </aside>  
<!--addArticles-->

<aside class="rightContainer floatRight">
  <?php 
  if(isset($_GET['id'])) {
    $this->renderPartial('_social'); 
  }
  ?>
</aside>
<!--rigtCOntainer-->
<div class="clear"></div>