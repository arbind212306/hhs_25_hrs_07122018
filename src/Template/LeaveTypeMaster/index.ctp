<h3>Leave Type</h3>
<p><?= $this->Html->link("Add leave Type", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Name</th>
         <th>Description</th>
        <th>Status</th>
        <!--th>Created on</th-->
        <!--th>Created By</th-->
    </tr>


    <?php 

        
        foreach ($Leavetypes as $category): ?>
    <tr>
        <td>
            <?= $this->Html->link($category->name, ['action' => 'edit', '_full' => true, $category->id]); ?>

        </td>
         <td>
            <?= $category->description; ?>
        </td>
        <td>
          <?php if($category->status=='1') {echo 'Active';}else{echo'InActive';} ?>
        </td>
         <!--td>
            <?php /*<?= date('d-m-Y H:i:s',strtotime($category->addedon)); ?> */ ?>
        </td-->
        <?php /* <td>
            <?= $category->addedby; ?>
        </td>*/?>
         <td>

<?php echo $this->Html->link(
                $this->Html->image('edit.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'edit',$category->id
                ), array('escape' => false)
            ); ?>

            <?php echo $this->Html->link(
                $this->Html->image('delete-sign.png',array('height' => '15', 'width' => '15')),
                array(

                    'action' => 'delete',$category->id
                ), array('escape' => false)
            ); ?>

           <?php /* <?= $this->Html->link('Edit', ['action' => 'edit', $category->id]) ?> / 
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $category->id],
                ['confirm' => 'Are you sure?'])
            ?>*/ ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>