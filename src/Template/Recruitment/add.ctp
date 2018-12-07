<?php
$is_edit = false;
if (!empty($this->request->data['id'])) {
    $is_edit = true;
}
?>
<style>
    .btn-primary {
        color: #fff;
        background-color: #763240 !important;
        border-color: #763240 !important;
    }
</style>


    <script>
        var csrfToken = "<?= $this->request->getParam('_csrfToken'); ?>";
    </script>
    <?= $this->Flash->render() ?>
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--                                    <h3 class="box-title">&nbsp;</h3>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <?php
                                        if ($is_edit) {
                                            echo 'Edit';
                                        } else {
                                            echo 'Add';
                                        }
                                        ?>
                                        candidate</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <?php
                                echo $this->Form->create();
                                if ($is_edit) {
                                    echo $this->Form->input('id', ['type' => 'hidden']);
                                }
                                ?>
                                <div class="box-body">
                                    <div class="col-md-6">
                                        <div class="form-group">                                            
                                            <?php
                                            $label = "First name";
                                            $ele = 'first_name';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "Middle name";
                                            $ele = 'middle_name';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "Last name";
                                            $ele = 'last_name';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "Email";
                                            $ele = 'email';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "Date of birth";
                                            $ele = 'dob';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => 'dd-mm-yyyy']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "MRF ID";
                                            $ele = 'mrf_id';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['type' => 'text', 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $label = "Recruitment ID";
                                            $ele = 'recruitment_id';
                                            echo '<label for="' . $ele . '">' . $label . '</label>';
                                            echo $this->Form->input($ele, ['type' => 'text', 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $ele = "designation_id";
                                            echo '<label for="' . $ele . '">Designation</label>';
                                            echo $this->Form->select($ele, $desigData, ['empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="business_id">Business</label>
                                            <select class="form-control" name="business_id" id="business_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($businessData)) {
                                                    foreach ($businessData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $ele = "unit_id";
                                            echo '<label for="' . $ele . '">Unit</label>';
                                            echo $this->Form->select($ele, $unitData, ['empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zone_id">Zone</label>
                                            <select class="form-control" name="zone_id" id="zone_id">
                                                <?php
                                                if (!empty($zoneData)) {
                                                    foreach ($zoneData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="c_location_id">Location</label>
                                            <select class="form-control" name="c_location_id" id="c_location_id">
                                                <?php
                                                if (!empty($zoneData)) {
                                                    foreach ($zoneData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $ele = "department_id";
                                            echo '<label for="' . $ele . '">Department</label>';
                                            echo $this->Form->select($ele, $dptData, ['empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_id">Sub Department</label>
                                            <select class="form-control" name="" id="department_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($dptData1)) {
                                                    foreach ($dptData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            $ele = "band_id";
                                            echo '<label for="' . $ele . '">Band</label>';
                                            echo $this->Form->select($ele, $bandData, ['empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_id">Grade</label>
                                            <select class="form-control" name="" id="department_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($dptData1)) {
                                                    foreach ($dptData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_id">Hiring Manager</label>
                                            <select class="form-control" name="" id="department_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($dptData1)) {
                                                    foreach ($dptData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_id">Appraiser</label>
                                            <select class="form-control" name="" id="department_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($dptData1)) {
                                                    foreach ($dptData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department_id">Supervisor</label>
                                            <select class="form-control" name="" id="department_id">
                                                <?php
                                                echo '<option value="0">Please select</option>';
                                                if (!empty($dptData1)) {
                                                    foreach ($dptData as $desg) {
                                                        echo '<option value="' . $desg['id'] . '">' . $desg['title'] . '</option>';
                                                    }
                                                }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">&nbsp;</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        &nbsp;
                                        <?php
                                        echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Recruitment', 'action' => 'index'], ['escape' => false]);
                                        ?>
                                    </div>
                                </div>
                                <?php
                                echo $this->Form->end();
                                ?>
                            </div>
                        </div>
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
