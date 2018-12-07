<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript"  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"  src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<div  style="min-height: 902.8px;">
    <style>
        .btn-primary {
            color: #fff;
            background-color: #763240 !important;
            border-color: #763240 !important;
            padding: 8%;margin: 5%;
        }
    </style>
    <script>
        var csrfToken = "<?= $this->request->getParam('_csrfToken'); ?>";
    </script>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employees
            <small>&nbsp;</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content" style="overflow-x: scroll;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--                                    <h3 class="box-title">&nbsp;</h3>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <p>
                                    &nbsp;
                                </p>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Emp Id</th>
                                    <th>Employee</th>                                    
                                    <th>Business</th> 
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($empData)) {
                                    foreach ($empData as $cData) {
                                        $empData=$cData['employee_detail'];
                                        //pr($cData);die;
                                        ?>   
                                        <tr>
                                            <td>
                                                <?php
                                                if (!empty($cData['emp_id'])) {
                                                    echo $cData['emp_id'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $name = "";
                                                if (!empty($cData['first_name'])) {
                                                    $name .= $cData['first_name'];
                                                }
                                                if (!empty($cData['last_name'])) {
                                                    $name .= " " . $cData['last_name'];
                                                }
                                                echo $name;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($empData['busines']['title'])) {
                                                    echo $empData['busines']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($empData['department']['title'])) {
                                                    echo $empData['department']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($empData['designation']['title'])) {
                                                    echo $empData['designation']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($empData['unit']['title'])) {
                                                    echo $empData['unit']['title'];
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <!--                                                <button type="button" class="btn btn-sm btn-primary">Appointment Latter</button>-->
                                                <?php
                                                echo $this->Html->link('<button type="button" class="btn btn-sm btn-primary">Edit</button>', ['controller'=>'EmpPersonal','action' => 'index', $cData['emp_id']], ['escape' => false]);
                                                ?>
                                                <?php
                                                //echo $this->Html->link('<button type="button" class="btn btn-sm btn-primary">Download</button>', ['action' => 'empInfo', $cData['id'].'.pdf'], ['escape' => false]);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <?php }
                                ?>                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?php
echo $this->Html->script(['employees']);
?>