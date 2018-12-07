<style>
    .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
    .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
    .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
    .tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
    .tab-pane { padding: 15px 0; }
    .tab-content{padding:20px}
    .card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
</style>
<script>
    var csrfToken = "<?= $this->request->getParam('_csrfToken'); ?>";
</script>
<?= $this->Flash->render() ?>
<div class="container" style="overflow-x: scroll;">
    <div class="row">
        <div class="col-md-8">
            <!-- Nav tabs --><div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Information</a></li>
                    <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact details</a></li>
                  <!--  <li role="presentation"><a href="#family" aria-controls="family" role="tab" data-toggle="tab">Family members</a></li>
                    <li role="presentation"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Information</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="basic">
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
                                                            Edit Basic Information 
                                                        </h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <?php
                                                    //pr($employee);
                                                    echo $this->Form->create();
                                                    $empDetl = $employee['employee_detail'];
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($employee['first_name'])) {
                                                                    $value = $employee['first_name'];
                                                                }
                                                                $label = "First name";
                                                                $ele = 'first_name';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($employee['middle_name'])) {
                                                                    $value = $employee['middle_name'];
                                                                }
                                                                $label = "Middle name";
                                                                $ele = 'middle_name';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($employee['last_name'])) {
                                                                    $value = $employee['last_name'];
                                                                }
                                                                $label = "Last name";
                                                                $ele = 'last_name';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($employee['email'])) {
                                                                    $value = $employee['email'];
                                                                }
                                                                $label = "Email";
                                                                $ele = 'email';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($empDetl['dob'])) {
                                                                    $value = date('Y-m-d', strtotime($empDetl['dob']));
                                                                }
                                                                $label = "Date of birth";
                                                                $ele = 'dob';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => 'dd-mm-yyyy']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($empDetl['designation_id'])) {
                                                                    $value = $empDetl['designation_id'];
                                                                }
                                                                $ele = "designation_id";
                                                                echo '<label for="' . $ele . '">Designation</label>';
                                                                echo $this->Form->select($ele, $desigData, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="business_id">Business</label>
                                                                <select class="form-control" name="business_id" id="business_id">
                                                                    <?php
                                                                    $value = "";
                                                                    if (!empty($empDetl['business_id'])) {
                                                                        $value = $empDetl['business_id'];
                                                                    }
                                                                    echo '<option value="0">Please select</option>';
                                                                    if (!empty($businessData)) {
                                                                        foreach ($businessData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '"  ' . $seleted . '>' . $desg['title'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($empDetl['unit_id'])) {
                                                                    $value = $empDetl['unit_id'];
                                                                }
                                                                $ele = "unit_id";
                                                                echo '<label for="' . $ele . '">Unit</label>';
                                                                echo $this->Form->select($ele, $unitData, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="zone_id">Zone</label>
                                                                <select class="form-control" name="zone_id" id="zone_id">
                                                                    <?php
                                                                    $value = "";
                                                                    if (!empty($empDetl['zone_id'])) {
                                                                        $value = $empDetl['zone_id'];
                                                                    }
                                                                    if (!empty($zoneData)) {
                                                                        foreach ($zoneData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '" ' . $seleted . '>' . $desg['title'] . '</option>';
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
                                                                    $value = "";
                                                                    if (!empty($empDetl['c_location_id'])) {
                                                                        $value = $empDetl['c_location_id'];
                                                                    }
                                                                    if (!empty($zoneData)) {
                                                                        foreach ($zoneData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '" ' . $seleted . '>' . $desg['title'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($empDetl['department_id'])) {
                                                                    $value = $empDetl['department_id'];
                                                                }
                                                                $ele = "department_id";
                                                                echo '<label for="' . $ele . '">Department</label>';
                                                                echo $this->Form->select($ele, $dptData, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="sub_department_id">Sub Department</label>
                                                                <select class="form-control" name="sub_department_id" id="department_id">
                                                                    <?php
                                                                    $value = "";
                                                                    if (!empty($empDetl['sub_department_id'])) {
                                                                        $value = $empDetl['sub_department_id'];
                                                                    }
                                                                    echo '<option value="0">Please select</option>';
                                                                    if (!empty($dptData1)) {
                                                                        foreach ($dptData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '" ' . $seleted . '>' . $desg['title'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($empDetl['band_id'])) {
                                                                    $value = $empDetl['band_id'];
                                                                }
                                                                $ele = "band_id";
                                                                echo '<label for="' . $ele . '">Band</label>';
                                                                echo $this->Form->select($ele, $bandData, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="grade_id">Grade</label>
                                                                <select class="form-control" name="grade_id" id="department_id">
                                                                    <?php
                                                                    $value = "";
                                                                    if (!empty($empDetl['grade_id'])) {
                                                                        $value = $empDetl['grade_id'];
                                                                    }
                                                                    echo '<option value="0">Please select</option>';
                                                                    if (!empty($dptData1)) {
                                                                        foreach ($dptData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '" ' . $seleted . '>' . $desg['title'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="appraiser_id">Appraiser</label>
                                                                <select class="form-control" name="appraiser_id" id="department_id">
                                                                    <?php
                                                                    $value = "";
                                                                    if (!empty($empDetl['appraiser_id'])) {
                                                                        $value = $empDetl['appraiser_id'];
                                                                    }
                                                                    echo '<option value="0">Please select</option>';
                                                                    if (!empty($dptData1)) {
                                                                        foreach ($dptData as $desg) {
                                                                            if ($desg['id'] == $value) {
                                                                                $seleted = 'selected';
                                                                            } else {
                                                                                $seleted = '';
                                                                            }
                                                                            echo '<option value="' . $desg['id'] . '" ' . $seleted . '>' . $desg['title'] . '</option>';
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
                                                                    $value = "";
                                                                    if (!empty($empDetl['appraiser_id'])) {
                                                                        $value = $empDetl['appraiser_id'];
                                                                    }
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
                                                            echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Employees', 'action' => 'index'], ['escape' => false]);
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
                    </div>
                    <div role="tabpanel" class="tab-pane" id="contact">
                        <section class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <!--                                    <h3 class="box-title">&nbsp;</h3>-->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <?php
                                            $permanent_contact = [];
                                            $current_contact = [];
                                            if (!empty($contactData)) {
                                                foreach ($contactData as $cData) {

                                                    if ($cData['address_type'] == 1) { // Permanent
                                                        $permanent_contact = $cData;
                                                    } else if ($cData['address_type'] == 2) { // current
                                                        $current_contact = $cData;
                                                    }
                                                }
                                            }
                                            ?>        
                                            <div class="col-md-12">
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            Permanent Address
                                                        </h4>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <?php
                                                    echo $this->Form->create('', ['action' => 'contact-details']);
                                                    echo $this->Form->input('address_type', ['type' => 'hidden', 'value' => 1]);
                                                    echo $this->Form->input('employee_id', ['type' => 'hidden', 'value' => $employee['id']]);
                                                    if (!empty($permanent_contact)) {
                                                        echo $this->Form->input('key', ['type' => 'hidden', 'value' => $permanent_contact['id']]);
                                                    }
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['address'])) {
                                                                    $value = $permanent_contact['address'];
                                                                }
                                                                $label = "Address";
                                                                $ele = 'address';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label, 'type' => 'textarea', 'rows' => 3]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['country_id'])) {
                                                                    $value = $permanent_contact['country_id'];
                                                                }
                                                                $ele = "country_id";
                                                                echo '<label for="' . $ele . '">Country</label>';
                                                                echo $this->Form->select($ele, $countries, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['state_id'])) {
                                                                    $value = $permanent_contact['state_id'];
                                                                }
                                                                $ele = "state_id";
                                                                echo '<label for="' . $ele . '">State</label>';
                                                                echo $this->Form->select($ele, $states, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['city'])) {
                                                                    $value = $permanent_contact['city'];
                                                                }
                                                                $label = "City";
                                                                $ele = 'city';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['pincode'])) {
                                                                    $value = $permanent_contact['pincode'];
                                                                }
                                                                $label = "Pincode";
                                                                $ele = 'pincode';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['mobile1'])) {
                                                                    $value = $permanent_contact['mobile1'];
                                                                }
                                                                $label = "Mobile 1";
                                                                $ele = 'mobile1';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['mobile2'])) {
                                                                    $value = $permanent_contact['mobile2'];
                                                                }
                                                                $label = "Mobile 2";
                                                                $ele = 'mobile2';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['mobile3'])) {
                                                                    $value = $permanent_contact['mobile3'];
                                                                }
                                                                $label = "Mobile 3";
                                                                $ele = 'mobile3';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
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
                                                            echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Employees', 'action' => 'index'], ['escape' => false]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->end();
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="border-top: 2px solid #DDD;padding-top: 4%;">
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            Current Address
                                                        </h4>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <?php
                                                    echo $this->Form->create('', ['action' => 'contact-details']);
                                                    echo $this->Form->input('address_type', ['type' => 'hidden', 'value' => 2]);
                                                    echo $this->Form->input('employee_id', ['type' => 'hidden', 'value' => $employee['id']]);
                                                    if (!empty($current_contact)) {
                                                        echo $this->Form->input('key', ['type' => 'hidden', 'value' => $current_contact['id']]);
                                                    }
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['address'])) {
                                                                    $value = $current_contact['address'];
                                                                }
                                                                $label = "Address";
                                                                $ele = 'address';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label, 'type' => 'textarea', 'rows' => 3]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['country_id'])) {
                                                                    $value = $current_contact['country_id'];
                                                                }
                                                                $ele = "country_id";
                                                                echo '<label for="' . $ele . '">Country</label>';
                                                                echo $this->Form->select($ele, $countries, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['state_id'])) {
                                                                    $value = $current_contact['state_id'];
                                                                }
                                                                $ele = "state_id";
                                                                echo '<label for="' . $ele . '">State</label>';
                                                                echo $this->Form->select($ele, $states, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['city'])) {
                                                                    $value = $current_contact['city'];
                                                                }
                                                                $label = "City";
                                                                $ele = 'city';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['pincode'])) {
                                                                    $value = $current_contact['pincode'];
                                                                }
                                                                $label = "Pincode";
                                                                $ele = 'pincode';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['mobile1'])) {
                                                                    $value = $current_contact['mobile1'];
                                                                }
                                                                $label = "Mobile 1";
                                                                $ele = 'mobile1';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['mobile2'])) {
                                                                    $value = $current_contact['mobile2'];
                                                                }
                                                                $label = "Mobile 2";
                                                                $ele = 'mobile2';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($current_contact['mobile3'])) {
                                                                    $value = $current_contact['mobile3'];
                                                                }
                                                                $label = "Mobile 3";
                                                                $ele = 'mobile3';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
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
                                                            echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Employees', 'action' => 'index'], ['escape' => false]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->end();
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="col-md-12" style="border-top: 2px solid #DDD;padding-top: 4%;">
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            Emergency contact
                                                        </h4>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <?php
                                                    echo $this->Form->create('', ['action' => 'contact-emergency']);
                                                    echo $this->Form->input('employee_id', ['type' => 'hidden', 'value' => $employee['id']]);
                                                    if (!empty($contactEData)) {
                                                        echo $this->Form->input('key', ['type' => 'hidden', 'value' => $contactEData['id']]);
                                                    }
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['contact_name'])) {
                                                                    $value = $contactEData['contact_name'];
                                                                }
                                                                $label = "Contact name";
                                                                $ele = 'contact_name';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['relationship'])) {
                                                                    $value = $contactEData['relationship'];
                                                                }
                                                                $label = "Relationship";
                                                                $ele = 'relationship';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">                                            
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['address'])) {
                                                                    $value = $contactEData['address'];
                                                                }
                                                                $label = "Address";
                                                                $ele = 'address';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label, 'type' => 'textarea', 'rows' => 3]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['country_id'])) {
                                                                    $value = $contactEData['country_id'];
                                                                }
                                                                $ele = "country_id";
                                                                echo '<label for="' . $ele . '">Country</label>';
                                                                echo $this->Form->select($ele, $countries, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['state_id'])) {
                                                                    $value = $contactEData['state_id'];
                                                                }
                                                                $ele = "state_id";
                                                                echo '<label for="' . $ele . '">State</label>';
                                                                echo $this->Form->select($ele, $states, ['value' => $value, 'empty' => 'Please select', 'label' => 'false', 'id' => $ele, 'class' => 'form-control']);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['city'])) {
                                                                    $value = $contactEData['city'];
                                                                }
                                                                $label = "City";
                                                                $ele = 'city';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['pincode'])) {
                                                                    $value = $contactEData['pincode'];
                                                                }
                                                                $label = "Pincode";
                                                                $ele = 'pincode';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['mobile1'])) {
                                                                    $value = $contactEData['mobile1'];
                                                                }
                                                                $label = "Mobile 1";
                                                                $ele = 'mobile1';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['mobile2'])) {
                                                                    $value = $contactEData['mobile2'];
                                                                }
                                                                $label = "Mobile 2";
                                                                $ele = 'mobile2';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($contactEData['mobile3'])) {
                                                                    $value = $contactEData['mobile3'];
                                                                }
                                                                $label = "Mobile 3";
                                                                $ele = 'mobile3';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
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
                                                            echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Employees', 'action' => 'index'], ['escape' => false]);
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
                    </div>    
                    <div role="tabpanel" class="tab-pane" id="family">
                        <section class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <!--                                    <h3 class="box-title">&nbsp;</h3>-->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <?php
                                            ?>        
                                            <div class="col-md-12">
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            Family Details
                                                        </h4>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <!-- form start -->
                                                    <?php
                                                    echo $this->Form->create('', ['action' => 'family-details']);
                                                    echo $this->Form->input('employee_id', ['type' => 'hidden', 'value' => $employee['id']]);
                                                    if (!empty($permanent_contact)) {
                                                        echo $this->Form->input('key', ['type' => 'hidden', 'value' => $permanent_contact['id']]);
                                                    }
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['name'])) {
                                                                    $value = $permanent_contact['name'];
                                                                }
                                                                $label = "Name";
                                                                $ele = 'name';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['relationship'])) {
                                                                    $value = $permanent_contact['relationship'];
                                                                }
                                                                $label = "Relationship";
                                                                $ele = 'relationship';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['dob'])) {
                                                                    $value = $permanent_contact['dob'];
                                                                }
                                                                $label = "Date of birth";
                                                                $ele = 'dob';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php
                                                                $value = "";
                                                                if (!empty($permanent_contact['occupation'])) {
                                                                    $value = $permanent_contact['occupation'];
                                                                }
                                                                $label = "Occupation";
                                                                $ele = 'occupation';
                                                                echo '<label for="' . $ele . '">' . $label . '</label>';
                                                                echo $this->Form->input($ele, ['value' => $value, 'class' => 'form-control', 'id' => $ele, 'label' => false, 'placeholder' => $label]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <?php
                                                                        $value = "";
                                                                        if (!empty($permanent_contact['is_dependent'])) {
                                                                            $value = $permanent_contact['is_dependent'];
                                                                        }
                                                                        $ele = 'is_dependent';
                                                                        echo $this->Form->input($ele, ['value' => $value, 'label' => false, 'type' => 'checkbox']);
                                                                        ?>
                                                                        Dependent
                                                                    </label>
                                                                </div>
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
                                                            echo $this->Html->link('&nbsp;<button type="button"  class="btn btn-primary">Cancel</button>', ['controller' => 'Employees', 'action' => 'index'], ['escape' => false]);
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
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
                </div>
            </div>
        </div>
    </div>
</div>