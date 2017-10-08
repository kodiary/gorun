<div class="col-md-12">
<div class="line"></div>
<h1><?php echo $count." Members";?></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="admin_search_form">
<?php  $model=new Member;?>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well'),
    'method'=>'get',
    'action' =>array('search'),

)); ?>
<?php echo CHtml::textField('key','',array('class'=>'input-medium search-query','maxlength'=>50,'placeholder'=>'Search all member fields'));?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'search', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>
</div>
<?php if(isset($members) && count($members)>0) {
    echo "<span class='blue'>".count($members)." Results</span><br/>";
        foreach($members as $m)
        {
            //$login_date = MemberLogin::model()->findByAttributes(['member_id'=>$m->id]);
            //var_dump($login_date);
            $li = "<b>".$m['fname']." ".$m['lname']."</b> - ".$m['email']." - <a href='".$this->createUrl('members/update/id/'.$m['id'])."' class='blue'>Last Login ".date('d F Y * H:i',strtotime($m->memberLogin[0]['login_date']))."</a>";
            echo str_replace("*",'at',$li);
            echo "<hr/>";
        }
    }
?>
</div>

<div class="clear"></div>
