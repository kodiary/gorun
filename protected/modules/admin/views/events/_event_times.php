<?php
$sel_from = " \t ".
            '<select id="From" class="span2" name="from[]">
                <option value="6:00 AM">6:00 AM</option>
                <option value="6:30 AM">6:30 AM</option>
                <option value="7:00 AM">7:00 AM</option>
                <option value="7:30 AM">7:30 AM</option>
                <option value="8:00 AM">8:00 AM</option>
                <option value="8:30 AM">8:30 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="9:30 AM">9:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="11:30 AM">11:30 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="12:30 PM">12:30 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="1:30 PM">1:30 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="2:30 PM">2:30 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="3:30 PM">3:30 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="4:30 PM">4:30 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="5:30 PM">5:30 PM</option>
                <option value="6:00 PM">6:00 PM</option>
                <option value="6:30 PM">6:30 PM</option>
                <option value="7:00 PM">7:00 PM</option>
                <option value="7:30 PM">7:30 PM</option>
                <option value="8:00 PM">8:00 PM</option>
                <option value="8:30 PM">8:30 PM</option>
                <option value="9:00 PM">9:00 PM</option>
                <option value="9:30 PM">9:30 PM</option>
                <option value="10:00 PM">10:00 PM</option>
                <option value="10:30 PM">10:30 PM</option>
                <option value="11:00 PM">11:00 PM</option>
                <option value="11:30 PM">11:30 PM</option>
                <option value="12:00 AM">12:00 AM</option>
                <option value="12:30 AM">12:30 AM</option>
                <option value="1:00 AM">1:00 AM</option>
                <option value="1:30 AM">1:30 AM</option>
                <option value="2:00 AM">2:00 AM</option>
                <option value="2:30 AM">2:30 AM</option>
                <option value="3:00 AM">3:00 AM</option>
                <option value="3:30 AM">3:30 AM</option>
                <option value="4:00 AM">4:00 AM</option>
                <option value="4:30 AM">4:30 AM</option>
                <option value="5:00 AM">5:00 AM</option>
                <option value="5:30 AM">5:30 AM</option>
            </select>'. '&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;';
        $sel_to= '<select id="To" class="span2" name="to[]">
                <option value="6:00 AM">6:00 AM</option>
                <option value="6:30 AM">6:30 AM</option>
                <option value="7:00 AM">7:00 AM</option>
                <option value="7:30 AM">7:30 AM</option>
                <option value="8:00 AM">8:00 AM</option>
                <option value="8:30 AM">8:30 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="9:30 AM">9:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="11:30 AM">11:30 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="12:30 PM">12:30 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="1:30 PM">1:30 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="2:30 PM">2:30 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="3:30 PM">3:30 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="4:30 PM">4:30 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="5:30 PM">5:30 PM</option>
                <option value="6:00 PM">6:00 PM</option>
                <option value="6:30 PM">6:30 PM</option>
                <option value="7:00 PM">7:00 PM</option>
                <option value="7:30 PM">7:30 PM</option>
                <option value="8:00 PM">8:00 PM</option>
                <option value="8:30 PM">8:30 PM</option>
                <option value="9:00 PM">9:00 PM</option>
                <option value="9:30 PM">9:30 PM</option>
                <option value="10:00 PM">10:00 PM</option>
                <option value="10:30 PM">10:30 PM</option>
                <option value="11:00 PM">11:00 PM</option>
                <option value="11:30 PM">11:30 PM</option>
                <option value="12:00 AM">12:00 AM</option>
                <option value="12:30 AM">12:30 AM</option>
                <option value="1:00 AM">1:00 AM</option>
                <option value="1:30 AM">1:30 AM</option>
                <option value="2:00 AM">2:00 AM</option>
                <option value="2:30 AM">2:30 AM</option>
                <option value="3:00 AM">3:00 AM</option>
                <option value="3:30 AM">3:30 AM</option>
                <option value="4:00 AM">4:00 AM</option>
                <option value="4:30 AM">4:30 AM</option>
                <option value="5:00 AM">5:00 AM</option>
                <option value="5:30 AM">5:30 AM</option>
            </select>';
        if($id && $id>0)
        {
            $times = EventsTime::model()->findAllByAttributes(array('event_id'=>$id));
            
            foreach($times as $time)
            { 
                $test_from='<option value="'.$time->from.'">'.$time->from.'</option>';
                $replace_from='<option value="'.$time->from.'" selected>'.$time->from.'</option>';
                $new_sel_from=str_replace($test_from,$replace_from,$sel_from);//select that is saved in db -- from
               
                $test_to='<option value="'.$time->to.'">'.$time->to.'</option>';
                $replace_to='<option value="'.$time->to.'" selected>'.$time->to.'</option>';
                $new_sel_to=str_replace($test_to,$replace_to,$sel_to);//select that is saved in db -- to
               
                //echo $time->from." >> " .$replace_from."<br>";
                echo "<div class='select-list'><input type='hidden' name='on_date[]' value='".date('Y-m-d',strtotime($time->on_date))."' />";
                echo "<div class='event_date'>".date('l, d F Y' ,strtotime($time->on_date))."</div>".$new_sel_from.$new_sel_to."</div>";
            }
        }
        else
        {
            echo "<div class='select-list'><input type='hidden' name='on_date[]' value='".date('Y-m-d', strtotime($start))."' />";        
            echo "<div class='event_date'>".date('l, d F Y' ,strtotime($start))."</div>".$sel_from.$sel_to."</div>";
            
            for($i=1; $i<=$day; $i++)
            {
                echo "<div class='select-list'><input type='hidden' name='on_date[]' value='".date('Y-m-d',strtotime($start)+($i*24*60*60))."' />";
                echo "<div class='event_date'>".date('l, d F Y' ,strtotime($start)+($i*24*60*60))."</div>".$sel_from.$sel_to."</div>";
            }
        }
?>

<script>
$(document).ready(function(){
    $('.event_times SELECT').selectBox();
});
</script>