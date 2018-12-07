<!-- style -->
<style>
    #show-msg-txt{
        text-align: center;
        width: 60%;
        margin: 0 auto;
        color: white;
    }

/*    #discuss-link{
        margin-top: 20px;
        text-align: center;
    }*/
</style>
<!-- style -->

<?php
if(!empty($cancelRequest)){ ?>
    <!-- section for displaying message starts here -->
<!--<section class="content" id="display-msg" style="">-->
    <div class="row" style="margin-bottom:5px;">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert" id="show-msg-txt"><?php echo $cancelRequest; ?></div>
        </div>
    </div>
<!--</section>-->  
<!-- section for dispalying message ends here --> 
<?php }
?>


<section>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cancel Absconded/terminated Request</h3>
            </div>
            <!-- /.box-header -->
            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Exit', 'action' => 'cancelAbscondingTermination']]); ?>
            <div class="box-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Date of Joining</th>
                        <th>Business</th>
                        <th>Location</th>
                        <!--<th>Status</th>-->
                        <th><input type="checkbox"  value="" id="th_check" readonly="readonly"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($modified_data)){
                        foreach ($modified_data as $value){
                    ?>
                    <tr>
                        <td><?= $value['emp_id'] ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['doj'] ?></td>
                        <td><?= $value['business_id'] ?></td>
                        <td><?= $value['c_location_id'] ?></td>
                        <td><input type="checkbox" class="cancel-absconding" name="cancelAbsconding[]" 
                                   value="<?php echo $value['emp_id'];?>"></td>
                    </tr>
                    <?php } }?>
                </tbody>
                <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <!--<th></th>-->
                <th><button type="submit" id="cancel_Request" >Cancel Request</button></th>
            </tr>
        </tfoot>
                
            </table>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        </div>
    </div>
</section>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>-->
<?php //echo $this->Html->script(['exit']); ?>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
        responsive: true;
    });
    $('#th_check').attr("disabled", true);
</script>  