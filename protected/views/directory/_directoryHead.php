<div class="directory-head-new">
    <div class="fl_left">
    <div class="left mem-dir">
        <a href="<?php echo $this->createAbsoluteUrl('/directory');?>"><img src="<?php echo $this->createAbsoluteUrl('/images/white-arrow.png');?>" /></a>
        MEMBER DIRECTORY
    </div>
    <!-- Directory list --->
    <?php 
    if($model)
        $default= array('label'=>ucwords($model->name), 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown'));
    else
        $default= array('label'=>'Select Member', 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown'));
    $members=Company::model()->findAllByAttributes(array('status'=>1),array('order'=>'name asc'));
    if(!empty($members))
    {
        foreach($members as $member )
        {
            $array[]=array('label'=>ucwords($member->name),'url'=>array('/directory/'.$member->slug)); 
        }
    }
    else $array[] = '';
    ?>
    <div class="btn-toolbar cuisineList left">
      <?php $this->widget('bootstrap.widgets.BootButtonGroup', array(
            'type'=>'primary', 
            'buttons'=>array(
                $default,            
            array('items'=>$array),
            ),
            'htmlOptions'=>array('class'=>'widerButton'),
            ));?>
    </div>
    <div class="clear"></div>
    <!-- Directory list -->
    </div>
    <div class="fl_right search-new">
     <form  action="<?php echo $this->createUrl('/directory');?>" method="post"><input type="text" class="search-query span2" placeholder="Search Directory" name="key" value="<?php echo $_POST['key'];?>"/><input type="submit" name="submit" value="Go"/></form>   
    </div>
    <div class="clear"></div>
</div>
