<?php 
// pr($exit_reason);
?>
<!-- plugin -->
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
            <div>
                <p id="discuss-link">
                    <?php echo $this->Html->link('>> Go Back', ['controller' => 'Exit', 
                        'action' => 'initiateResignation']); ?>
                </p>
            </div>
        </div>
    </div>
</section>  
<!-- section for dispalying message ends here -->   

<section class="content" id="initiate-section">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php if (!empty($data)) { echo $data['name'];} ?>
                        <small>Employee Id : <?php if (!empty($data)) echo $data['emp_id']; ?></small></h3>
                    <small class="pull-right">Email Id : <?php if (!empty($data)) echo $data['email']; ?></small>
                </div>
                <?= $this->Form->create(null, ['url' => false]); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-10">
                            <label>Reason for Resignation [FUNCTIONAL APPRAISER]</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date of resignation">Date of resignation</label>
                                <input type="text" id="exit-datepicker" class="form-control" >
                                <input type="hidden" id="hidden_employee_id" value="<?php if (!empty($data)) echo $data['emp_id']; ?>">
                                <input type="hidden" id="hidden_id" value="<?php if(!empty($id)){echo $id;} ?>">
                            </div> 
                            <div class="form-group">
                                  <label>Hold Salary</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="hold_salary" id="" value="1">Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="hold_salary" id="" value="0" checked>No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                <label for="last working day">Last working day</label>
                                <input type="text" id="last-working-day" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exit reason">Exit Reason</label>
                                <select class="form-control" name="exit_reason" id="exit-reason">
                                    <option value="">--select--</option>
                                    <?php
                                    if(!empty($exit_reason)){
                                    foreach ($exit_reason as $value) { ?>
                                        <option value="<?php echo $value['id'] ?>"><?= $value['reason']; ?></option>
                                   <?php }}
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group">
                                  <label>Serve notice period</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="serve_notice_period" id="" value="1" checked>Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="serve_notice_period" id="" value="0">No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label>Waiver of Notice Pay</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="waiver_notice_pay" id="" value="1" checked
                              >Notice period to be waived off</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="waiver_notice_pay" id="" value="0">Recovery for notice period not served</label>
                              </div>
                                </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                    <div class="box-body pad">
                            <label>Comments</label>
                            <textarea class="textarea" id="get-comments" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" readonly></textarea>
                            </div>
                            </div>
                            </div>
                    </div>        
                    <div class="box-footer pull-right">
                        <button type="button" id="btn-resignation" class="btn btn-primary">Submit</button>
                        <button type="button" id="btn-resignation-cancel" class="btn btn-default">Cancel</button>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<script src="<?= $this->Url->build('/bower_components/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= $this->Url->build('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Html->script(['exit']); ?>
<script>
$(function () {
//bootstrap WYSIHTML5 - text editor
$('.textarea').wysihtml5();
});    
$('#exit-datepicker').datepicker({
//minDate : 0,
dateFormat: 'dd-mm-yy'
});
$('#last-working-day').datepicker({
minDate : 0,
dateFormat: 'dd-mm-yy'
});
</script>