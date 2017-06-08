<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Video - <span class="blue">Include YouTube video with your article - (Optional)</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articleVideo-form',
));?>
<div class="addContentArea addVideo">
    <ul class="images">
		<?php for($i=0; $i<count($model); $i++):?>
			<?php $this->renderPartial('_addvideo', array(
				'model' => $model[$i],
				'index' => $i,
			))?>
		<?php endfor ?>
	</ul>
    
    </div><!--addContentArea-->
<?php echo CHtml::button('+Add Video', array('class' => 'btn video-add'))?>
<div class="greybg margintopbot10">
<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large'));?>
</div><!--greybg-->
<?php $this->endWidget();?>
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
<script type="text/javascript">
$(document).ready(function(){
   $(".video-add").click(function(){
    var count=$(".images li").size(); 

		 $(".video-add").val('loading...');
			$.ajax({
				success: function(html){
					$(".images").append(html);
				},
                complete: function(){
                     $(".video-add").val('+Add Video');
                },
				type: 'get',
				url: '<?php echo $this->createUrl('addVideoField')?>',
				data: {index: count},
				cache: false,
				dataType: 'html'
			});
        });
   
});
</script>
