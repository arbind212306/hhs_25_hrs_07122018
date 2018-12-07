<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Initiate Resignation</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Unit</th>
                        <th>Department</th>
                        <th>Grade</th>
                        <th>Location</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($data)){
                        foreach ($data as $value){
                            $id = $value['id'];
                            $encode = time()."_".str_replace(' ','_', base64_encode($id));
                    ?>
                    <tr>
                        <td><?= $value['emp_id'] ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['unit_id'] ?></td>
                        <td><?= $value['department_id'] ?></td>
                        <td><?= $value['grade_id'] ?></td>
                        <td><?= $value['c_location_id'] ?></td>
                        <td>
                    <?php if(($value['status'] == 1) && ($value['appraiser_status'] !=5)){
                                echo '<p style="color:green;">Applied Resignation</p>';
                       }elseif(($value['appraiser_status'] ==5)){
                           echo '<p style="color:orange;">Initiated Resignation</p>';
                       }
                       else{
                                echo $this->Html->link('Initiate Resignation', 
                                ['controller' => 'Exit', 'action' => 'initiateRequest', $encode]); 
                            } ?>
                        </td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>-->

<script>
    $(document).ready(function () {
        $('#example').DataTable();
        responsive: true;
    });
</script>    