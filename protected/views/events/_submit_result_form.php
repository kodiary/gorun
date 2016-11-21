<div class="submit-result-form white" style="display: none;">
            
                <?php
                $c=0;
                foreach($m_time as $mt)
                            {
                                $c++;
                                ?>
                                <div class="">
                                <?php
                                if($mt->distance1){
                                    if($c==1){?>
                                    
                                     <input type="hidden" class="is_tri" value="0" />
                                     
                                     <?php }
                                     $mod = $race_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id));
                                    ?>
                                <div class="submit_result_parent">
                                <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                <input type="hidden" class="id" value="<?php echo $mod->id?>" />
                                <input type="hidden" class="distance" value="<?php echo $mt->distance1?><?php if($mt->distance2!=0){?>, <?php echo $mt->distance2?>k<?php }?>" />
                                <div class="e_dis_block e_dis_submit"><?php echo $mt->distance1?><?php if($mt->distance2!=0){?>, <?php echo $mt->distance2?>k <?php }?></span></div>
                                <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour" value="<?php echo $mod->dist_hour;?>" placeholder="00" /><br />HOURS</div>
                                <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min" value="<?php echo $mod->dist_min;?>" placeholder="00" /><br />MINUTES</div>
                                <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec" value="<?php echo $mod->dist_sec;?>" placeholder="00" /><br />SECONDS</div>
                                <div class="clearfix"></div>
                                </div>
                                <?php
                                }
                                ?>
                                <?php
                                if($mt->distance_swim_1){
                                    
                                    $mod1 = $tri_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id,'is_tri_swim'=>1));
                                    $modt1 = $tri_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id,'transition_time'=>1));
                                    $modt2 = $tri_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id,'transition_time'=>2));
                                    $mod2 = $tri_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id,'is_tri_run'=>1));
                                    $mod3 = $tri_result->findByAttributes(array('event_time_id'=>$mt->id,'user_id'=>Yii::app()->user->id,'is_tri_bike'=>1));
                                    if($c==1){?>
                                     <input type="hidden" class="is_tri" value="1" />
                                    
                                     <?php }
                                    ?>
                                <span class="e_dis">
                                    <div class="submit_result_parent">
                                     <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                     <input type="hidden" class="id" value="<?php echo $mod1->id?>" />
                                    <input type="hidden" class="tri_type" value="s" />
                                    <input type="hidden" class="distance" value="<?php echo $mt->distance_swim_1?><?php if($mt->distance_swim_2!=0){?>, <?php echo $mt->distance_swim_2?>k <?php }?>" />
                                    <div class="e_dis_block e_dis_submit" style="line-height: 22px;font-size:16px;"><?php /*echo $mt->distance_run_1?><?php if($mt->distance_run_2!=0){?>, <?php echo $mt->distance_run_2?>k <?php }<br />*/?><strong>Swim </strong></div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour_s" placeholder="00" value="<?php echo $mod1->dist_hour;?>" /><br />HOURS</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min_s" placeholder="00" value="<?php echo $mod1->dist_min;?>" /><br />MINUTES</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec_s" placeholder="00" value="<?php echo $mod1->dist_sec;?>" /><br />SECONDS</div>
                                    <div class="clearfix"></div>
                                    <div class="gap"></div>
                                    </div>
                                    
                                    <div class="submit_result_parent">
                                     <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                     <input type="hidden" class="id" value="<?php echo $modt1->id?>" />
                                    <input type="hidden" class="tri_type" value="t1" />
                                    <input type="hidden" class="distance" value="0" />
                                    <div class="e_dis_block e_dis_submit" style="line-height: 22px;font-size:16px;"><?php /*echo $mt->distance_run_1?><?php if($mt->distance_run_2!=0){?>, <?php echo $mt->distance_run_2?>k <?php }<br />*/?><strong class="blue">T1 </strong></div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour_t1" placeholder="00" value="<?php echo $modt1->dist_hour;?>" /><br />HOURS</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min_t1" placeholder="00" value="<?php echo $modt1->dist_min;?>" /><br />MINUTES</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec_t1" placeholder="00" value="<?php echo $modt1->dist_sec;?>" /><br />SECONDS</div>
                                    <div class="clearfix"></div>
                                    <div class="gap"></div>
                                    </div>
                                    
                                    <div class="submit_result_parent">
                                     <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                     <input type="hidden" class="id" value="<?php echo $mod2->id?>" />
                                    <input type="hidden" class="tri_type" value="b" />
                                    <input type="hidden" class="distance" value="<?php echo $mt->distance_bike_1?><?php if($mt->distance_bike_2!=0){?>, <?php echo $mt->distance_bike_2?>k <?php }?>" />
                                    <div class="e_dis_block e_dis_submit" style="line-height: 22px;font-size:16px;"><?php /*echo $mt->distance_bike_1?><?php if($mt->distance_bike_2!=0){?>, <?php echo $mt->distance_bike_2?>k<?php }?><br />*/?><strong>Bike </strong> </div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour_b" placeholder="00" value="<?php echo $mod2->dist_hour;?>" /><br />HOURS</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min_b" placeholder="00" value="<?php echo $mod2->dist_min;?>" /><br />MINUTES</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec_b" placeholder="00" value="<?php echo $mod2->dist_sec;?>" /><br />SECONDS</div>
                                    <div class="clearfix"></div>
                                    <div class="gap"></div>
                                    </div>
                                    
                                    <div class="submit_result_parent">
                                     <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                    <input type="hidden" class="tri_type" value="t2" />
                                    <input type="hidden" class="id" value="<?php echo $modt2->id?>" />
                                    <input type="hidden" class="distance" value="0" />
                                    <div class="e_dis_block e_dis_submit" style="line-height: 22px;font-size:16px;"><?php /*echo $mt->distance_run_1?><?php if($mt->distance_run_2!=0){?>, <?php echo $mt->distance_run_2?>k <?php }<br />*/?><strong class="blue">T2 </strong></div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour_t2" placeholder="00" value="<?php echo $modt2->dist_hour;?>" /><br />HOURS</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min_t2" placeholder="00" value="<?php echo $modt2->dist_min;?>" /><br />MINUTES</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec_t2" placeholder="00" value="<?php echo $modt2->dist_sec;?>" /><br />SECONDS</div>
                                    <div class="clearfix"></div>
                                    <div class="gap"></div>
                                    </div>
                                    
                                    <div class="submit_result_parent">
                                     <input type="hidden" class="event_time_id" value="<?php echo $mt->id?>" />
                                     <input type="hidden" class="id" value="<?php echo $mod3->id?>" />
                                    <input type="hidden" class="tri_type" value="r" />
                                    <input type="hidden" class="distance" value="<?php echo $mt->distance_run_1?><?php if($mt->distance_run_2!=0){?>, <?php echo $mt->distance_run_2?>k <?php }?>" />
                                    <div class="e_dis_block e_dis_submit" style="line-height: 22px;font-size:16px;"><?php /*echo $mt->distance_swim_1?><?php if($mt->distance_swim_2!=0){?>, <?php echo $mt->distance_swim_2?>k<?php }?><br />*/?><strong>Run </strong> </div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input hour_r" placeholder="00" value="<?php echo $mod3->dist_hour;?>" /><br />HOURS</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input min_r" placeholder="00" value="<?php echo $mod3->dist_min;?>" /><br />MINUTES</div>
                                    <div class="e_dis_block e_dis_bottom"><input type="text" class="submit_input sec_r" placeholder="00" value="<?php echo $mod3->dist_sec;?>" /><br />SECONDS</div>
                                    <div class="clearfix"></div>
                                    </div>
                                    
                                </span>
                                <?php
                                }
                                ?>
                                
                                
                                
                                </div>
                                <?php
                                if($c!=count($m_time)){
                                ?>
                                <div class="row">
                                <hr style="margin-left: 0;margin-right:0;" />
                                </div>
                                <?php
                                }
                            }
                ?>
                <div class="blackSubmit">
                    <a href="javascript:void(0)" id="submit_result">SUBMIT RESULTS</a>
                </div>
                <div class="blackbg">
                   Input your results. <a href="javascript:void(0)" class="blue clearResult">Clear Results</a>
                </div>
            </div>