<h3>Self Roster</h3>
<hr />


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#todate,#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <?php 
    
        // Hard code the user for now.
     echo $this->Form->create();
     echo $this->Form->control('id', ['type' => 'hidden']);
     echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
          echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
     //echo $this->Form->control('fromdate');
	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('fromdate',array('name'=>'fromdate','id'=>'fromdate','placeholder'=>'From Date','autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	 echo '</div></div></div>';
	 	 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('todate',array('name'=>'todate','id'=>'todate','placeholder'=>'To Date' ,'autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	  echo '</div></div></div>';
     //echo $this->Form->control('todate');
    
      foreach($shifts as $shift){
         
         $arrShift[$shift['id']]=$shift['shift_name'];
     }
      echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('shift_id', array('type'=>'select', 'options'=>$arrShift, 'label'=>'Shift', 'empty'=>'Select Category','required'=>'required','class'=>'form-control')); 
	   echo '</div></div></div>';
    
    ?>
  
  
 <div class="row"><div class="col-md-8"><div class="form-group">
            <span class="label1"><b>Weekly Off </b><span class="mand">*</span></span>
            <span class="value" colspan="3" style="padding-left:0px;">
                <span class="radio1"><input id="chkMon" type="checkbox" name="weekoff[]" value="1" ></span> Mon&nbsp;&nbsp;
              <span class="radio1"><input id="chkTue" type="checkbox" name="weekoff[]" value="2"  ></span> Tue&nbsp;&nbsp;
              <span class="radio1"><input id="ChkWed" type="checkbox" name="weekoff[]" value="3"></span> Wed&nbsp;&nbsp;
              <span class="radio1"><input id="ChkThurs" type="checkbox" name="weekoff[]" value="4"></span> Thurs&nbsp;&nbsp;
              <span class="radio1"><input id="ChkFri" type="checkbox" name="weekoff[]" value="5"></span> Fri&nbsp;&nbsp;
              <span class="radio1"><input id="ChkSat" type="checkbox" name="weekoff[]" value="6"></span> Sat&nbsp;&nbsp;
              <span class="radio1"><input id="ChkSun" type="checkbox" name="weekoff[]" value="7"></span> sun&nbsp;&nbsp;
            </span>
  </div> </div> </div><br />
  
  <?php
    
    echo $this->Form->button(__('Add'));
    echo $this->Form->end();

     