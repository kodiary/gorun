<h2>Your Profile</h2>
<div class="dashboard_menu">
    <ul>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='index' && Yii::app()->controller->id =='dashboard' )?'active':'';?>">Profile Details</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/password" class="<?php echo (Yii::app()->controller->action->id=='password')?'active':'';?>">Password</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='settings')?'active':'';?>">Settings</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/club" class="<?php echo (Yii::app()->controller->id=='club')?'active':'';?>">Your Clubs</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='result')?'active':'';?>">Your Resuts</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='result')?'active':'';?>">Your Athlets</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='review')?'active':'';?>">Your Race Reviews</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/events" class="<?php echo (Yii::app()->controller->id=='events')?'active':'';?>">Your Events</a></li>
    </ul>
</div>
<a href="#" class="race_wallet">RACE WALLET - <span class="blue">R0.00</span></a>
<a href="#" class="submit-event">Submit your event &nbsp; <span class="fa fa-plus"></span></a>