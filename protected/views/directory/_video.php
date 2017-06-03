<div id="videoInfo" style="display: none;">
<?php
if($videos)
{
    foreach($videos as $model)
    {
       $code = $model->code; 
       if($code!="")
       {
        ?>
        <h2><?php echo ucwords($model->title);?></h2>
        <?php
            if(stripos($code,'iframe')===false) // if the video code is the youtube url
            {
                $video_code=CommonClass::getYoutubeCodeFromUrl($code);
        ?>
            <iframe title="" class="youtube-player" type="text/html" 
            width="600" height="337" src="http://www.youtube.com/embed/<?php echo trim($video_code);?>"
            frameborder="0" allowFullScreen></iframe>
        <?php
            }
            else // if the video code is the embed code
            {
                echo $code;
            }
        }
    }
}
?>
</div>