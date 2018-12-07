<div>
<span><b> Leave Balance :- </b></span>&nbsp;&nbsp;&nbsp;

 <?php foreach ($leavesb as $leaveb){  ?>
<span> <?php echo $leaveb['name']; ?> -  <?php echo $leaveb['INleave_bal']; ?>  </span>&nbsp;&nbsp;&nbsp;
<?php } ?>

</div>
<br />
<h3>Leave Request</h3>
<p><?= $this->Html->link("Apply for Leave", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Leave</th>
        <th>From</th>
        <th>To </th>
        <th align="center">No of Days </th>
        <th>Requested On </th>
        <th>Status</th>
    </tr>

    <?php 
    

        foreach ($leaves as $leave):   ?>
    <tr>
        <td nowrap>
            <?php /*<?= $this->Html->link($leave['name'], ['action' => 'edit', '_full' => true, $leave['id']]); */ ?>
            <?= $leave['name']; ?>
        </td>
        <td nowrap>
            <?= date('d-M-Y',strtotime($leave['fromdate'])); ?>
        </td>
         <td nowrap>
            <?= date('d-M-Y',strtotime($leave['todate'])); ?>
        </td>
         <td nowrap >
            <?= $leave['no_of_days']; ?>
        </td>
         <td nowrap>
            <?= date('d-M-Y H:i:s',strtotime($leave['requestedon'])); ?>
        </td>
         <td nowrap>
            <?php if($leave['status']=='1') {echo 'Approved';}else if($leave['status']=='0'){echo 'Pending';}else if($leave['status']=='2'){echo 'Rejected';} ?>
        </td>
        
        
    </tr>
    <?php endforeach; ?>
</table>
    
 