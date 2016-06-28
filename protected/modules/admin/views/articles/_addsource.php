<div class="line"></div>
<div id="<?php echo $index;?>" class="source">
    <li class="addsource"><label>Source Name</label>
        <?php echo CHtml::activetextField($source, "[$index]source_name");?>
        <div class="clear"></div>
    </li>
    <li class="addsource">
        <label>Source Link</label>
        <?php echo CHtml::activetextField($source, "[$index]source_link");?>
        <a href="javascript:void(0);" onclick="$('#<?php echo $index;?>').remove();">X</a>
        <div class="clear"></div>
    </li>
</div>

