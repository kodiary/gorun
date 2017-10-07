<h2>Your Profile</h2>
<div class="dashboard_menu">
    <ul>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='index' && Yii::app()->controller->id =='dashboard' &&(isset($not_verified)&& $not_verified ==2)  )?'active':'';?>">Profile Details</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/password" class="<?php echo (Yii::app()->controller->action->id=='password')?'active':'';?>">Password</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='settings')?'active':'';?>">Settings</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/club" class="<?php echo (Yii::app()->controller->action->id=='club')?'active':'';?>">Your Clubs</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='result')?'active':'';?>">Your Results</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/athletes" class="<?php echo (Yii::app()->controller->action->id=='athletes')?'active':'';?>">Your Athletes</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard" class="<?php echo (Yii::app()->controller->action->id=='review')?'active':'';?>">Your Race Reviews</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/events" class="<?php echo (Yii::app()->controller->id=='events')?'active':'';?>">Your Events</a></li>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard/attending" class="<?php echo (Yii::app()->controller->id=='dashboard' && Yii::app()->controller->action->id=='attending')?'active':'';?>">Events Attending</a></li>
    </ul>
</div>
<a href="#" class="race_wallet">RACE WALLET - <span class="blue">R0.00</span></a>
<?php /*<!--a href="<?php echo Yii::app()->request->baseUrl; ?>/events/create" class="submit-event">Submit your event &nbsp; <span class="fa fa-plus"></span></a-->*/?>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/events/submitResults" class="submit-event">Submit Your Results &nbsp; <span class="fa fa-plus"></span></a>