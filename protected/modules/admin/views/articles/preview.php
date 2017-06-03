<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/player/mediaelement-and-player.min.js');?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mediaelementplayer.min.css" />

<aside class="col-md-8 floatLeft preview addArticles">
<div class="line"></div>
<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2><?php echo $model->title;?></h2>
    <p><span class="blue"><?php echo CommonClass::formatDate($model->publish_date, 'd F, Y');?></span></p>
  </div>
  <div class="clear"></div>
        
  <!--subTitle-->
  <div class="line"></div>
 
    <div class="eye right"><?php echo $model->readcount;?></div>
    <div class="clear"></div>            
    <div class="line"></div>          

<article>
  <?php if(Articles::get_images_by_article_id($model->id))
  {
    //Create an instance of ColorBox
    $colorbox = $this->widget('application.extensions.colorpowered.JColorBox');
     
    //Call addInstance (chainable) from the widget generated.
    $colorbox->addInstance('a[rel="articlesGalleryView"]');
    
  ?>
 <section class="articleImages">
    
	 <?php foreach(Articles::get_images_by_article_id($model->id) as $thumb){
	   $main_image = Yii::app()->baseUrl.'/images/frontend/full/'.$thumb->filename;?>
     <figure class="thumbnail articleImage floatLeft">
     <a href="<?php echo $main_image;?>" rel="articlesGalleryView" title="<?php echo $thumb->title;?>"><?php echo Articles::Image(CHtml::encode($thumb->filename), 'thumb', CHtml::encode($thumb->title));?></a>
       </figure>
       <?php }?>

       <div class="clear"></div> 
       <div class="line" style="margin-top: -5px;" ></div>   
    </section>
<!--articleImages--> 
  <?php }?>
<section class="articleContent margintopbot10 detail">
 <?php echo $model->detail;?>
</section><!--articleContent-->

<?php if($model->article_file){
        foreach($model->article_file as $file)
        {       
            if($file->file_type==3){?>
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

<?php if($model->article_file){
    $counter = 0;
        foreach($model->article_file as $file)
        {   
            $counter++;
            if($file->file_type==2 && file_exists(Yii::app()->basePath.'/../audio/'.$file->filename))
            {?>
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
                     </section><!--articelAudio-->
            <?php 
            }
        }
    }?>
<!--articelAudio-->

<?php if(!empty($model->article_file)){
    foreach($model->article_file as $file)
        {
            if($file->filename!="" && $file->file_type==4 && file_exists(Yii::app()->basePath.'/../documents/'.$file->filename))
            {
               $doc_name=($file->title!="")?$file->title:reset(explode('.',$file->filename));
               $doc_size= CommonClass::format_file_size(filesize(Yii::app()->basePath.'/../documents/'.$file->filename));
               $label=  "<strong>Document name -</strong> ".$doc_name.' ('.$doc_size.')';?>
              <?php
              //$doc_download_link = 'downloads/'.$doc_name;
              $doc_download_link = $this->createUrl('/articles/downloads/'.$file->filename);
              $doc_download = "<span class='downloadDoc'><a target='_blank' href='".$doc_download_link."' style='position:absolute; top:24px; right:75px; font-size:12px;' class='btn'>Download</a></span>";
                echo "<section class='articleDocs'>";
                echo CHtml::ajaxLink($label,
                            CController::createUrl('/site/viewDoc', array(
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
        }?>
<?php }?>
<!--articleDocument-->

<?php if(!empty($model->article_source)){
    foreach($model->article_source as $val){
            if($val->source_link!='' && $val->source_name!=''){?>
        <section class="articleSource">
            <strong>Article Source :</strong> <a target="_blank" href="<?php echo $val->source_link?>"><?php echo $val->source_name?></a>
        </section>
        <?php }
    }
}?>
<!--articleSource-->

</article>
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


<script>
$('video, audio').mediaelementplayer({
    audioWidth: 570,
});


$(document).ready(function()
    {
        $('iframe').each(function()
        {
               var url = $(this).attr("src");
                var char = "?";
              if(url.indexOf("?") != -1)
                      var char = "&";

                $(this).attr("src",url+char+"wmode=transparent");
        });
        
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