<h3>Leave Summary</h3>

<table>
    <tr>
	     
      
        <th>Leave</th>
        <th>Date</th>
        <th>Alloted </th>
        <th>Withdrown</th>
        
    </tr>

    <?php 
	
   /* echo $this->Form->create('leave', array('action' => 'approveleaveaction'));
	echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
	echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
   */

  if(count($leavesummary) > 0){
        foreach ($leavesummary as $leave):   ?>
    <tr>
	
	     <td nowrap >
            <?= $leave['name']; ?>
        </td>
		
		
       
        <td nowrap>
            <?= date('d-M-Y',strtotime($leave['addedon'])); ?>
        </td>
         
         <td nowrap >
            <?= $leave['credit']; ?>
        </td>
         <td nowrap>
             <?= $leave['debit']; ?>
        </td>
       
        
        
    </tr>
	
    <?php endforeach; ?>
	
	   <tr>
        <td nowrap>
<?php	


    //echo $this->Form->button(__('Submit'),array('disabled'=>'disabled','class'=>'mbtn'));
  }

    //echo $this->Form->end();

	?>
	</td>
        
        
    </tr>
</table>
<script>
    $(document).on('click', '.check', function() {
        
       
        if($(this).is(':checked'))
        {
        $(this).closest('tr').find('#status').prop('disabled', false);
		
		 $('.mbtn').prop('disabled',false);
		        
        }
        else{
            
             $(this).closest('tr').find('#status').prop('disabled', true);
			  $('.mbtn').prop('disabled',true);
        }
        
});
</script>
 