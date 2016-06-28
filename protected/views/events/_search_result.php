<?php 
$slug=Events::model()->findByPk($data->id);
$image = EventFile::model()->findByAttributes(array('event_id'=>$slug->id));
if($slug){
?>

<article>
	<figure class="articleImage floatLeft">
    	 <a class="thumbnail" rel="tooltip" href="<?php echo $this->createUrl('/events/'.$slug->slug);?>" title="<?php echo $slug->title;?>">
        <?php echo Events::Image(CHtml::encode($image->filename), 'thumb', CHtml::encode($image->title));?>
        </a>
    </figure><!--articleImage-->
    
    <aside class="articleContent floatRight">
    <h2><a href="<?php echo $this->createUrl('/events/'.$slug->slug);?>"><?php echo CHtml::encode($slug->title); ?></a></h2>
        <p class="desc"><?php echo CommonClass::formatDate($slug->date_added)." - ";?></span><?php echo CommonClass::limit_text(strip_tags($slug->detail));?></p>
    </aside><!--articleContent-->
    <div class="clear"></div>
</article>

<?php 
}
?>