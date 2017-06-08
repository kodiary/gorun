<div class="outer_popups" >
<div class="inner">
<div class="top_titles" >
	<div class="titles_left">
		<h2><?php echo $title?></h2>
	</div>
    <a href="<?php echo $this->createAbsoluteUrl('/site/savedoc/title/'.$title.'/filename/'.urlencode($filename));?>" style="position:absolute; top:24px; right:75px; font-size:12px;" class="btn">Download File</a>
    <div class="title_right">
    	<a href="javascript:void(0)" onclick="$('#menu_popup').dialog('close');">Close</a>
    </div>
</div>
<iframe src="http://docs.google.com/viewer?url=<?php echo $url?>&embedded=true" style="border: none;width:700px;height:730px;"></iframe>
</div>
</div>



