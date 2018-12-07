<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- File: src/Template/Articles/edit.ctp -->

<h1>Edit shift</h1>
<?php
     echo $this->Form->create($shift);
     echo $this->Form->control('id', ['type' => 'hidden']);
     echo $this->Form->control('shift_name');
     echo $this->Form->control('start_time');
     echo $this->Form->control('end_time');
    // echo $this->Form->control('night_shift');
       
    
    $night_shift= [['value'=>'0','text'=>'No'],['value'=>'1','text'=>'Yes']]; 

    echo $this->Form->input('night_shift', array(
                      'options' => $night_shift,
                      'type' => 'radio'
                      ));
 
    ?>
  <div>
            <span class="label">Weekly Off <span class="mand">*</span></span>
            <span class="value" colspan="3" style="padding-left:0px;">
                <span class="radio"><input id="chkMon" type="checkbox" name="weekoff[]" value="mon" ></span> Mon&nbsp;&nbsp;
              <span class="radio"><input id="chkTue" type="checkbox" name="weekoff[]" value="tues"  ></span> Tue&nbsp;&nbsp;
              <span class="radio"><input id="ChkWed" type="checkbox" name="weekoff[]" value="wed"></span> Wed&nbsp;&nbsp;
              <span class="radio"><input id="ChkThurs" type="checkbox" name="weekoff[]" value="thrus"></span> Thurs&nbsp;&nbsp;
              <span class="radio"><input id="ChkFri" type="checkbox" name="weekoff[]" value="fri"></span> Fri&nbsp;&nbsp;
              <span class="radio"><input id="ChkSat" type="checkbox" name="weekoff[]" value="sat"></span> Sat&nbsp;&nbsp;
              <span class="radio"><input id="ChkSun" type="checkbox" name="weekoff[]" value="sun"></span> sun&nbsp;&nbsp;
            </span>
  </div>

<?php
    
    echo $this->Form->button(__('Save'));
    echo $this->Form->end();
?>
