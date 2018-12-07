<h3>Approve Comp OFF Request</h3>

<table>
    <tr>
	    <th>Mark </th>
	    <th>Name </th>
        <th>Type</th>
        <th>Date</th>
		<th>Generated ON</th>
        <!--th>Remark</th-->
        <th>Action</th>
    </tr>

    <?php 
    echo $this->Form->create('compoff', array('action' => 'approvecompoffaction'));
echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
echo $this->Form->control('ip',['type' => 'hidden','value' => $_SERVER['REMOTE_ADDR']]);

  if(count($leaverequest) > 0){
        foreach ($leaverequest as $leave):   ?>
    <tr> <td nowrap >
	<input type="checkbox" name="leave_id[]" value="<?php echo $leave['id']; ?>" id="<?php echo $leave['id']; ?>" class="check">
                    <?php /*<?= $this->Html->link($leave['name'], ['action' => 'edit', '_full' => true, $leave['id']]); */

             echo $this->Form->control('emp[]',['type' => 'hidden','value' => $leave['empid'],'label'=>false]);		?>
        </td>
	
	     <td nowrap >
            <?= $leave['empname']; ?> (<?= $leave['empid']; ?>)
        </td>
		
		
        <td nowrap>
    
            <?= $leave['name']; ?>
        </td>
        <td nowrap>
            <?= date('d-M-Y',strtotime($leave['compoff_date'])); ?>
        </td>
        
         
         <td nowrap>
            <?= date('d-M-Y H:i:s',strtotime($leave['addedon'])); ?>
        </td> 
         <td nowrap>
		 
            <?php 
			
			$arrShift = array('0'=>'Pending','1'=>'Approve','2'=>'Reject'); 
			echo $this->Form->input('status[]', array('type'=>'select', 'options'=>$arrShift, 'label'=>false, 
			'empty'=>'','class'=>'form-control','disabled'=>'disabled'));
			
			 ?>
        </td>
        
        
    </tr>
	
    <?php endforeach; ?>
	
	   <tr>
        <td nowrap>
<?php	


echo $this->Form->button(__('Submit'),array('disabled'=>'disabled','class'=>'mbtn'));
  }

echo $this->Form->end();

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
 