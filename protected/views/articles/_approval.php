<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/player/mediaelement-and-player.min.js');?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mediaelementplayer.min.css" />

<div class="">
<div>

<div class="com-info">
    <?php $company = Company::model()->findByPk($model->company_id); ?>
    <p>Company: <?php echo $company->name; ?></p>
    <p>Article Number #<?php echo $model->id; ?></p>
    <p>Title: <?php echo $model->title; ?></p>
</div>
<div class="line"></div>
<h1><?php echo strip_tags($model->title,'<p><br><ol><ul><li><a>');?></h1>

<p><span class="blue"><?php echo CommonClass::formatDate($model->publish_date, 'd F, Y');?></span></p>
 <div class="line" style="margin-bottom: 6px;"></div>
 <div class="addthis_toolbox left" style="height: 25px;">
    <!-- AddThis Button BEGIN -->
    <script type="text/javascript">document.write(unescape('%3C%64%69%76%20%63%6C%61%73%73%3D%22%61%64%64%74%68%69%73%5F%74%6F%6F%6C%62%6F%78%20%61%64%64%74%68%69%73%5F%64%65%66%61%75%6C%74%5F%73%74%79%6C%65%20%6D%61%72%67%69%6E%74%6F%70%62%6F%74%31%30%22%3E%0A%20%20%20%20%3C%61%20%63%6C%61%73%73%3D%22%61%64%64%74%68%69%73%5F%62%75%74%74%6F%6E%5F%66%61%63%65%62%6F%6F%6B%5F%6C%69%6B%65%22%20%66%62%3A%6C%69%6B%65%3A%6C%61%79%6F%75%74%3D%22%62%75%74%74%6F%6E%5F%63%6F%75%6E%74%22%3E%3C%2F%61%3E%0A%20%20%20%20%3C%61%20%63%6C%61%73%73%3D%22%61%64%64%74%68%69%73%5F%62%75%74%74%6F%6E%5F%74%77%65%65%74%22%3E%3C%2F%61%3E%0A%20%20%20%20%3C%61%20%63%6C%61%73%73%3D%22%61%64%64%74%68%69%73%5F%62%75%74%74%6F%6E%5F%67%6F%6F%67%6C%65%5F%70%6C%75%73%6F%6E%65%22%20%67%3A%70%6C%75%73%6F%6E%65%3A%73%69%7A%65%3D%22%6D%65%64%69%75%6D%22%3E%3C%2F%61%3E%0A%20%20%20%20%3C%61%20%63%6C%61%73%73%3D%22%61%64%64%74%68%69%73%5F%63%6F%75%6E%74%65%72%20%61%64%64%74%68%69%73%5F%70%69%6C%6C%5F%73%74%79%6C%65%22%3E%3C%2F%61%3E%0A%20%20%20%20%3C%2F%64%69%76%3E'));</script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff40ba15baa7303"></script>
    <!-- AddThis Button END -->
    </div>
    <div class="eye right"><?php echo number_format($model->readcount);?></div>
    <div class="clear"></div>
 <div class="line" style="margin-top: 0;"></div>
 <?php if(Articles::get_images_by_article_id($model->id))
  {
    //Create an instance of ColorBox
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
     
    //Call addInstance (chainable) from the widget generated.
    $colorbox->addInstance('a[rel="articlesGalleryView"]');
  ?>
    <section class="articleImages">
	 <?php $count=0; foreach(Articles::get_images_by_article_id($model->id) as $key=> $thumb){
	   $count++;
	   if($count==6)$class='last';else $class="";	
	   $main_image = Yii::app()->baseUrl.'/images/frontend/full/'.$thumb->filename;?>
     <figure class="floatLeft <?php echo $class; ?>">
     <a href="<?php echo $main_image;?>" rel="articlesGalleryView" title="<?php echo $thumb->title;?>" class="thumbnail"><?php echo Articles::Image(CHtml::encode($thumb->filename), 'thumb', CHtml::encode($thumb->title));?></a>
       </figure>
        <?php if($count==6){echo '<div class="clear"></div>'; $count=0;} ?>
       <?php }?>

       <div class="clear"></div>     
      </section>
      <div class="line"></div>
<!--articleImages--> 
  <?php }?>

<section class="articleContent margintopbot10 detail">
 <?php echo $model->detail;?>
</section><!--articleContent-->

<?php if($model->article_file){
        foreach($model->article_file as $file)
        {
            if($file->file_type==3 && $file->filename!=""){?>
               <section class="articleVideo"><?php if($file->title!=""){?><h2><?php echo ucWords($file->title)?></h2>
                <?php }
                    if(stripos($file->filename,'iframe')===false) // if the video code is the youtube url
                    {
                        $video_code=CommonClass::getYoutubeCodeFromUrl($file->filename);
                ?>
                    <iframe title="" class="youtube-player" type="text/html" 
                    width="600" height="338" src="http://www.youtube.com/embed/<?php echo trim($video_code);?>"
                    frameborder="0" allowFullScreen></iframe>
                <?php
                    }
                    else // if the video code is the embed code
                    {
                        $video = $file->filename;
                        // our prefered size : width="600" height="338"
                        // regular exression to change the height and width
                        $pattern = "/height=\"[0-9]*\"/";
                        $video = preg_replace($pattern, "height='338'", $video);
                        $pattern = "/width=\"[0-9]*\"/";
                        $video = preg_replace($pattern, "width='600'", $video);
                        echo $video;
                    }
                 ?>
                </section>
            <?php }
        }
    }?>
<!--articleVideo-->

<!--articleAudio-->
    <?php 
    if(!empty($model->article_file)){
      $counter = 0;
      foreach($model->article_file as $file)
      { 
            
            if($file->filename!="" && $file->file_type==2 && file_exists(Yii::app()->basePath.'/../audio/'.$file->filename))
            {
                $counter++;
                ?>
                <section class="articleAudio">
                   <?php echo '<h2>'.$file->title.'</h2>';?>
                    <audio id="player<?php echo $counter?>" src="<?php echo Yii::app()->baseUrl.'/audio/'.$file->filename?>" type="audio/mp3" controls="controls">
                     <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
                     <object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo  Yii::app()->baseUrl.'/js/player/flashmediaelement.swf';?>">
                        <param name="movie" value="<?php echo  Yii::app()->baseUrl.'/js/player/flashmediaelement.swf';?>" />
                        <param name="flashvars" value="controls=true&file=<?php echo Yii::app()->baseUrl.'/audio/'.$file->filename?>" />
                        <!-- Image as a last resort -->
                        <img src="myvideo.jpg" width="320" height="240" title="No audio playback capabilities" alt="No audio playback capabilities"/>
                    </object>
                   </audio>
                </section>
                <?php
            }
      }
    }?>
<!--articelAudio-->

    <?php 
    if(!empty($model->article_file)){
      foreach($model->article_file as $file)
      { ?>
     
      <?php
            if($file->filename!="" && $file->file_type==4 && file_exists(Yii::app()->basePath.'/../documents/'.$file->filename))
            {
               $doc_name=($file->title!="")?$file->title:reset(explode('.',$file->filename));
               $doc_size= CommonClass::format_file_size(filesize(Yii::app()->basePath.'/../documents/'.$file->filename));
               $label=  "<strong>Document name -</strong> ".$doc_name.' ('.$doc_size.')';?>
              <?php
              //$doc_download_link = 'downloads/'.$doc_name;
              $doc_download_link = $this->createUrl('downloads/'.$file->filename);
              $doc_download = "<span class='downloadDoc'><a target='_blank' href='".$doc_download_link."' style='position:absolute; top:24px; right:75px; font-size:12px;' class='btn'>Download</a></span>";
                echo "<section class='articleDocs'>";
                echo CHtml::ajaxLink($label,
                            CController::createUrl('site/viewdoc', array(
                                                            'url'=>urlencode(Yii::app()->request->hostInfo.'/documents/'.$file->filename), 
                                                            'title'=>$doc_name.$doc_download,
                                                            'model'=>'Articles',
                                                            'id'=>$model->id
                                                            )
                                                    ),
                            array('success'=>'function(data){$("#docPopup").html(data).dialog("open");}'),
                            array('id'=>'showDoc'.uniqid(), 'class'=>'articleDocument')
                );
                echo "</section>";
            }
            
      ?> <?php
     } ?><?php
  }
  ?>
<!--articleDocument-->

<?php if(!empty($model->article_source)){
    foreach($model->article_source as $val){?>
    <?php if($val->source_name!='' && $val->source_link!=''){?>
        <section class="articleSource">
            <strong>Article Source :</strong> <a target="_blank" href="<?php echo $val->source_link?>"><?php echo $val->source_name?></a>
        </section>        
    <?php }}}?>
<!--articleSource-->

</div>

<div class="line"></div>
<?php
if(!empty($model->company_id))
{
    ?>
    <div>
        <?php
            $company=Company::model()->findByPk($model->company_id);
            $this->renderPartial('application.views.directory._view',array('data'=>$company));
        ?>
    </div>
    <?php
}
?>


<div class="conform">
    <p>APPROVE OR REJECT THIS ARTICLE</p>
    <div class="buttons1">
        <span class="left">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'url'=>$this->createUrl('articles/approve/'.$model->slug),
                'size'=>'large', // '', 'large', 'small' or 'mini'
                'type'=>'primary',
                'label'=>'YES - APPROVE',
            )); ?>
        </span>
        <span class="right">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'url'=>$this->createUrl('articles/reject/'.$model->slug),
                'size'=>'large', // '', 'large', 'small' or 'mini'
                'type'=>'danger',
                'label'=>'NO - REJECT IT',
            )); ?>
        </span>
        <div class="clear"></div>
    </div>
</div>
</div><!--Container-->

<div class="clear"></div>

<script>
$('video, audio').mediaelementplayer({
    audioWidth: 570,
});
</script>

<!-- poop up modal for document  -->
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'docPopup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'autoOpen'=>false,
        'resizable'=>false,
        'height'=>'auto',
        'width'=>'auto',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
$('#docPopup').empty();
}")));?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>