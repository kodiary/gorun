<!-- for documents -->
<div class="outer_popups" >
<div class="inner">
<div class="top_titles" >
	<div class="titles_left">
		<h2><?php echo $title?></h2>
	</div>
    <div class="title_right">
    	<a href="javascript:void(0)" onclick="$('#docPopup').dialog('close');">Close</a>
    </div>
</div>
<iframe src="http://docs.google.com/viewer?url=<?php echo $url?>&embedded=true" style="border: none;width:700px;height:730px;"></iframe>
</div>
</div>