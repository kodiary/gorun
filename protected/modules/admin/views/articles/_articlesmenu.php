<?php
if(isset($_GET['id']) && $_GET['id']!=''){
    $model = Articles::model()->findByPk($_GET['id']);
    //$model->id = $_GET['id'];?>
    
    <h1>Add/Edit Articles - <?php echo CHtml::link('Create or Edit an Article Here', array('create'));?></a></h1>
    <div class="line"></div>
    <div class="postUpdateDate blue" > <strong>Article #<?php echo $model->id?></strong> - <span>Last updated <?php echo CommonClass::formatDate($model->date_updated,'l, d F Y');?></span> </div>
    <!--postUpdateDate-->
    <div class="subnav">
        <ul class="nav nav-pills input-append">
            <?php
            $action =  $this->action->id;    
            ?>
            <li<?php if($action == 'update' || $action == 'create')echo " class='selected'";?>><?php echo CHtml::link('Article Details', array('update', 'id'=>$model->id),array('class'=>'btn'))?></li>
            <li<?php if($action == 'addphotos')echo " class='selected'";?>><?php echo CHtml::link('Photos/Images', array('addphotos', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'addaudio')echo " class='selected'";?>><?php echo CHtml::link('Audio', array('addaudio', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'addvideo')echo " class='selected'";?>><?php echo CHtml::link('Video', array('addvideo', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'adddoc')echo " class='selected'";?>><?php echo CHtml::link('Documents', array('adddoc', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'comments')echo " class='selected'";?>><?php echo CHtml::link('Comments', array('comments', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'seo')echo " class='selected'";?>><?php echo CHtml::link('SEO', array('seo', 'id'=>$model->id),array('class'=>'btn'));?></li>
            <li<?php if($action == 'preview')echo " class='selected'";?>><?php echo CHtml::link('Preview', array('preview', 'id'=>$model->id),array('class'=>'btn'));?></li>
        </ul>
    </div>
<?php }?>