<style>
	textarea {
		border:1px solid #ccc;
	}

	.autotextarea {
		vertical-align: top;
		-webkit-transition: height 0.2s;
		-moz-transition: height 0.2s;
		transition: height 0.2s;
	}
    
</style>
<script src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.autosize.js'></script>                
<script>
	$(function(){
		$('.autotextarea').autosize({append: "\n"});
	});
</script>