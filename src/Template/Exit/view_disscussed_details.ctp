<?php
$date = $data[0]['created_date'];
$d = date('j-F-Y H:i', strtotime($date));
?>
<link rel="stylesheet" href="<?= $this->Html->Url->build('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

<!-- style -->
<style>
    #show-msg-txt{
        text-align: center;
        width: 60%;
        margin: 0 auto;
        color: white;
    }

    #discuss-link{
        margin-top: 20px;
        text-align: center;
    }
</style>
<!-- style -->

<!-- section for displaying message starts here -->
<section class="content" id="display-msg" style="display: none;">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert" id="show-msg-txt"></div>
            <div class="alert alert-warning" role="alert" id="show-msg-txt-warn" style="display:none;"></div>
            <div>
                <p id="discuss-link">
                    <?php echo $this->Html->link('>> Go Back', ['controller' => 'Exit', 'action' => 'ViewDiscussion']); ?>
                </p>
            </div>
        </div>
    </div>
</section>  
<!-- section for dispalying message ends here -->


<section class="content" id="appraiser-discussion">
    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php if (!empty($data)) {
                        echo $data[0]['name'];
                    } ?>
                        <small>Employee Id : <?php if (!empty($data)) echo $data[0]['emp_id']; ?></small></h3>
                    <small class="pull-right">Email Id : <?php if (!empty($data)) echo $data[0]['email']; ?></small>
                    <h4>Status : <small style="color: orange;"><?php
                            if (!empty($data)) {
                                if ($data[0]['appraiser_status'] == 0) {
                                    echo 'Pending with Functional Appraiser';
                                }elseif ($data[0]['appraiser_status'] == 1) {
                                    echo 'Pending with Reviewer';
                                }elseif ($data[0]['appraiser_status'] == 2) {
                                    echo 'Pending with HR Manager';
                                }
                            }
                    ?></small></h4>
                </div>
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <h5 class="box-title" style="width: 100%;">
                        Requested by <?php if (!empty($data)) echo $data[0]['name']; ?> Employee Id : <?php if (!empty($data)) echo $data[0]['emp_id']; ?>
                        <span class="pull-right">submitted Date : <?php if (!empty($d)) echo $d; ?></span></h5>
                </div>
                <!-- form start -->

<?= $this->Form->create(null, ['url' => false]); ?>
                <div class="col-sm-12"><p class="box-title"><label>Discussion remarks</label></p></div>
                <div class="box-body">
                    <input type="hidden" id="hidden_employee_id" value="<?php if (!empty($data[0]['emp_id']))
    echo $data[0]['emp_id'];
?>">
                    <input type="hidden" id="hidden_id" value="<?php if (!empty($id)) {
                                echo $id;
                            } ?>">
                    <div class="box-body pad">
                        <label>Employee Remark</label>
                        <textarea class="textarea" id="get-discuss-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" readonly><?php
                            if (!empty($data) && !empty($data[0]['disscuss_text'])) {
                                echo stripslashes($data[0]['disscuss_text']);
                            }
?></textarea>
                    </div>
                        <?php if(!empty($role) && $role == 6){ ?>
                    <div class="box-body pad">
                        <label>Discussion [Functional Appraiser] Remark</label>
                        <textarea class="textarea" id="appraiser-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo stripslashes($data[0]['appraiser_disscussed_text']) ?></textarea>
                    </div>
                    <div class="box-body pad">
                        <label>Discussion Reviewer Remark</label>
                        <textarea class="textarea" id="reviewer-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo stripslashes($data[0]['reviewer_discussed_text']) ?></textarea>
                    </div>
                    <div class="box-body pad">
                        <label>Discussion [HR Manager] Remark</label>
                        <textarea class="textarea" id="hr-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                        <?php }elseif(!empty($role) && $role == 4){ ?>
                        <div class="box-body pad">
                        <label>Discussion [Functional Appraiser] Remark</label>
                        <textarea class="textarea" id="appraiser-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo stripslashes($data[0]['appraiser_disscussed_text']) ?></textarea>
                    </div>
                    <div class="box-body pad">
                        <label>Discussion Reviewer Remark</label>
                        <textarea class="textarea" id="reviewer-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>    
                        <?php } else{ ?>
                    <div class="box-body pad">
                        <label>Disscussion [Functional Appraiser] Remark</label>
                        <textarea class="textarea"  id="get-discuss-appraiser-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>    
                        <?php } ?>
                    

                    <div class="box-footer pull-right">
                        <?php if(!empty($role) && $role == 6){ ?>
                        <button type="button" id="btn-approve-hr" class="btn btn-primary">Submit</button>
                        <?php }elseif(!empty($role) && $role == 4){ ?>
                         <button type="button" id="btn-approve-reviewer" class="btn btn-primary">Submit</button>   
                       <?php } else{ ?>
                        <button type="button" id="btn-approve-supervisor" class="btn btn-primary">Submit</button>
                        <?php } ?>
                        <button type="button" id="back-approve-supervisor" class="btn btn-default">Back</button>
                    </div>
                </div>
                <!-- /.box-body -->


<?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

<script src="<?= $this->Url->build('/bower_components/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= $this->Url->build('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script> 
<?= $this->Html->script(['exit']); ?>
<script>
    $(function () {
        $('.textarea').wysihtml5();
    });
    $("#get-discuss-txt").prop("disabled", true);
    $("#appraiser-txt").prop("disabled", true);
    $("#reviewer-txt").prop("disabled", true);
    // $(document).ready(function () {
    //     var a = $('#remark_div').height();
    //     var b = $('#div-txt').height();
    //     var c = Math.max(a, b);
    //     $('.set-div-heigth').height(c);
    // });
</script>