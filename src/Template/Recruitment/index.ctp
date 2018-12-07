<style>
    .btn-primary {
        color: #fff;
        background-color: #763240 !important;
        border-color: #763240 !important;
        padding:7%;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

    <script>
        var csrfToken = "<?= $this->request->getParam('_csrfToken'); ?>";
    </script>
    <!-- Content Header (Page header) -->
    
    <section class="content-header" style="padding-left:2%;">
        <?=$this->Flash->render() ?>
        <h4>
            New Recruitments
        </h4>
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
                                    <button type="button" id="genrate_eid" class="btn btn-block btn-primary">Generate EID</button>
                                </p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <?php
                                ?>
                            </div>
                            <?php
                            if (!empty($candidate_setting)) {
                                //pr($candidate_setting);die;
                                ?>
                                <div class="col-md-2">
                                    <p>
                                        <?php
                                        if (in_array(2, $candidate_setting)) {
                                            ?>
                                            <button type="button" id="import_file_init" class="btn btn-block btn-primary">Upload sheet</button>
                                            <a href="<?php echo $this->Url->build('/sample/sample_employees.xlsx'); ?>">Download sample</a>
                                            <?php
                                            echo $this->Form->create('', ['id' => 'employee_sheet_form', 'type' => 'file']);
                                            ?>
                                            <input id="import_file" type="file" name="employee_sheet" class="hidden" />
                                            <?php
                                            echo $this->Form->end();
                                        }
                                        ?>                                    
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <?php
                                        if (in_array(3, $candidate_setting)) {
                                            echo $this->Html->link('<button type="button"  class="btn btn-block btn-primary">Add candidate&nbsp;</button>', ['controller' => 'Recruitment', 'action' => 'add'], ['escape' => false]);
                                        }
                                        ?>                                    
                                    </p>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Recruitment Id</th>
                                    <th>MRF ID</th>
                                    <th>Candidate</th> 
                                    <th>Business</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($candidateData)) {
                                    foreach ($candidateData as $cData) {
                                         //pr($cData);die;
                                        ?>   
                                        <tr>
                                            <td><input type="checkbox" value="<?= $cData['id']; ?>" class="emp-chk"></td>
                                            <td>
                                                <?php
                                                if (!empty($cData['recruitment_id'])) {
                                                    echo $cData['recruitment_id'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($cData['mrf_id'])) {
                                                    echo $cData['mrf_id'];
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
                                                if (!empty($cData['busines']['title'])) {
                                                    echo $cData['busines']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($cData['department']['title'])) {
                                                    echo $cData['department']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($cData['designation']['title'])) {
                                                    echo $cData['designation']['title'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $this->Html->link('<button type="button" class="btn btn-sm btn-primary">Edit</button>', ['action' => 'edit', $cData['id']], ['escape' => false]);
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

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<?php
echo $this->Html->script(['recruit']);
?>