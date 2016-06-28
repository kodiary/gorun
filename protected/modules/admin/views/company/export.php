<div class="left_body">
    <div class="line"></div>
    <h1>Export - <span class="blue">Export to Excel document</span></h1>
    <div class="line"></div>
    <div class="border_line">
        <div class="text_desc_l">
            <span>All EXSA Members</span>
        </div>
        <div class="text_desc_r">
            <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Export',
                'type'=>'info', // 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' =>array('exporttoExcel'),
                //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
                ));
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="right_body">
</div>
<div class="clear"></div>
