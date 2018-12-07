<h3>Holiday Master</h3>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( ".hdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  
  

  </script>
  <?php 
    
        // Hard code the user for now.
     echo $this->Form->create($holiday);
     echo $this->Form->control('ip', ['type' => 'hidden','value' => $this->request->clientIp()]);
     
     echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
       echo $this->Form->control('custid',['type' => 'hidden','value' => $this->request->session()->read('custid')]);
     // foreach($shifts as $shift){
         
         //$arrShift[$shift['id']]=$shift['shift_name'];
     //}
     echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('year', array('name'=>'year','value'=>$holiday->year ,'type'=>'select','id'=>'year', 'label'=>'Year', 'empty'=>'Select Year','required'=>'required','class'=>'form-control')); 
	 
	  echo '</div></div></div>';
	 
	  echo '<div class="row"><div class="col-md-4"><div class="form-group">';
     echo $this->Form->input('location', array('type'=>'select', 'options'=>'', 'label'=>'Location', 'empty'=>'Select Location','class'=>'form-control'));
 echo '</div></div></div>';	 

    ?>
  <div class="tableContainer" id="div-report"  align="center">
<table id="tbl-report" cellpadding="4" cellspacing="0" width="98%" style="width:100%;" border="0" class="table">  
 <thead> 
        <tr>
            <th>Date</th>
            <th>Holiday Description</th>
        </tr>
     </thead>
    <tbody class="holidayrow">

     <tr class="row2">
        <td align="Left" valign="top"><?php  echo $this->Form->input('Holiday Date',array('name'=>'hdate','value'=>$holiday->hdate , 'id'=>'hdate','placeholder'=>'Holiday Date','label'=>false,'autocomplete'=>'off','required'=>'required','class'=>'form-control1 hdate')); ?></td>
        <td valign="top" align="Left"><?php  echo $this->Form->input('Holiday Description',array('name'=>'reason','value'=>$holiday->reason,'id'=>'hdate','placeholder'=>'Holiday Description','label'=>false,'autocomplete'=>'off','required'=>'required','class'=>'form-control1')); ?>

        </td>
         



    </tr>
      
</tbody>
</table>
</div>

  
  <?php
    
    echo $this->Form->button(__('Add'));
    echo $this->Form->end();

    ?>

  <script>
      for(y = 2000; y <= 2500; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2015 selected
        
        var syear = <?php echo $holiday->year; ?>;
        if (y == syear) {
            optn.selected = true;
        }
        
        document.getElementById('year').options.add(optn);
}

    

</script>