<h3>Apply Leave</h3>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#todate,#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <?php 
    
echo $this->Form->create();
echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
echo $this->Form->input('fromdate',array('name'=>'fromdate','id'=>'fromdate','placeholder'=>'From Date','autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	 echo '</div></div></div>';
 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
echo $this->Form->input('todate',array('name'=>'todate','id'=>'todate','placeholder'=>'To Date' ,'autocomplete'=>'off','required'=>'required','class'=>'form-control'));
	 echo '</div></div></div>';

 foreach($ltypes as $ltype){

    $arrShift[$ltype['id']]=$ltype['name'];
}

 echo '<div class="row"><div class="col-md-4"><div class="form-group">';
echo $this->Form->input('leave_type', array('type'=>'select', 'options'=>$arrShift, 'label'=>'Type', 'empty'=>'Select Type','required'=>'required','class'=>'form-control')); 
	 echo '</div></div></div>';

echo $this->Form->button(__('Add'));
echo $this->Form->end();

     