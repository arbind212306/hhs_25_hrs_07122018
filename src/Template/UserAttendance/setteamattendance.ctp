<h3>Mark Team Attendance</h3>
<hr />

  
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <div class="searchbox">
 
<?php 
    
      
     echo $this->Form->create();
 
     echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
     echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
    
?>
 <div class="row"><div class="col-md-3">
  <div class="row"><div class="col-md-12"><div class="form-group"><div class="input text required"><label for="fromdate">Fromdate</label><input type="text" name="fromdate" id="fromdate" placeholder="From Date" autocomplete="off" required class="form-control"></div></div></div>
  </div>
   </div>
   <div class="col-md-3">
  <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <div class="input text required">
  <label for="todate">Todate</label>
  <input type="text" name="todate" id="todate" placeholder="To Date" autocomplete="off" required class="form-control"></div>
  </div>
  </div>
  </div>
 </div>
 
  
 <div class="col-md-4">
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
   <label for="todate">Employee's</label>
 <?php

	 foreach($emplist as $emp){
         
         $arrEmp[strtolower($emp['emp_id'])]=$emp['empname']."(".strtolower($emp['emp_id']).")";
     }
	 
	 
	 echo $this->Form->input('emp', array('name'=>'emp','type'=>'select', 'options'=>$arrEmp, 'label'=>false, 'class'=>'emp form-control','required'=>'required','multiple'=>'multiple','id'=>'emplist'));
    ?>

  </div>
  </div>
 </div>
 </div>

 <div class="col-md-3">
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
   <label for="todate">First Half</label>
 <?php

	 foreach($shiftcat as $cat){
         
         $arrCat[strtolower($cat['id'])]=$cat['name'];
     }
	 
	 
	 echo $this->Form->input('first_half', array('name'=>'first_half','type'=>'select', 'options'=>$arrCat, 'label'=>false,'empty'=>'--Select--', 'class'=>'emp form-control','required'=>'required'));
    ?>

  </div>
  </div>
 </div>
 </div>
 
   <div class="col-md-3">
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
   <label for="todate">Second Half</label>
 <?php

	 foreach($shiftcat as $cat){
         
         $arrCat[strtolower($cat['id'])]=$cat['name'];
     }
	 
	 
	 echo $this->Form->input('second_half', array('name'=>'second_half','type'=>'select', 'options'=>$arrCat, 'label'=>false,'empty'=>'--Select--', 'class'=>'emp form-control','required'=>'required'));
    ?>

  </div>
  </div>
 </div>
 </div>
 
<div class="col-md-8"><div class="form-group">
          
              <span class="value" colspan="3" style="padding-left:0px;">
              <span class="radio1"> <b>Comp off </b>&nbsp;&nbsp;<input  id="chkMon" type="checkbox" name="compoff" value="1"></span> 
</span>
</div> 
</div> 
  </div>
  
    </div>
	
  
  <div class="row"><div class="col-md-4"><div class="form-group">   <?php
    
    echo $this->Form->button(__('Set Attendance'));
    echo $this->Form->end();
	
?></div></div></div>

  

 <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.1/themes/start/jquery-ui.css" />

<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/grid.locale-en.js"></script>

<link rel="stylesheet" href="<?php echo $this->Url->build('/');?>/css/bootstrap-multiselect.css" type="text/css">

<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/prettify.min.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<style>
#gbox_jqGrid{    z-index: 0;}
</style>

<script>
  $(function() {
    $( "#todate,#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });

    $(document).ready(function() {
        $('#emplist').multiselect(
		{
			includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
            enableFiltering: true,
			maxHeight: 200
		});
    });
</script>