<?php
$date = $data['created_date'];
$d = date('j-F-Y H:i', strtotime($date));
$getlastWorkingDay = $data['request_for_last_working_day'];
$requestlastWorkingDay = date('j-F-Y', strtotime($getlastWorkingDay));
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
            <div>
                <p id="discuss-link">
                    <?php echo $this->Html->link('>> Go Back', ['controller' => 'Exit', 'action' => 'viewResignation']); ?>
                </p>
            </div>
        </div>
    </div>
</section>  
<!-- section for dispalying message ends here -->

<section class="content" id="resignation-section">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php if (!empty($data)) { echo $data['name'];} ?>
                          <small>Employee Id : <?php if (!empty($data)) echo $data['emp_id']; ?></small></h3>
                          <small class="pull-right">Email Id : <?php if (!empty($data)) echo $data['email']; ?></small>
                          <h4>Status : <small style="color: orange;"><?php 
                          if (!empty($data)) {
                              if($data['appraiser_status'] == 1){
                                echo 'Pending with Functional Appraiser';
                            } elseif ($data['appraiser_status'] == 2) {
                                echo 'Pending with Reviewer';
                            } elseif ($data['appraiser_status'] == 5) {
                                echo 'Resignation initiated by Functional Appraiser / Pending with HR Manager.';
                            }
                          }?></small></h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-header with-border">
                            <h5 class="box-title" style="width: 100%;">
                                <?php if($data['appraiser_status'] == 5){
                                    echo 'Initiated by'.' '.$supervisor_name['name'].', '.'Employee Id:'.' '.$supervisor_name['emp_id'];
                                }else{?>
                                Requested by <?php if (!empty($data)) echo $data['name']; ?> Employee Id : <?php if (!empty($data)) echo $data['emp_id']; } ?>
                                <span class="pull-right">submitted Date : <?php if (!empty($d)) echo $d; ?></span></h5>
                        </div>
                        <!-- form start -->

                        <?= $this->Form->create(null, ['url' => false]); ?>
                          <div class="box-body">
                          <input type="hidden" id="hidden_employee_id" value="<?php if (!empty($data)) echo $data['emp_id']; ?>">
                          <input type="hidden" id="hidden_id" value="<?php if(!empty($id)){echo $id;} ?>">
                          <?php if($data['appraiser_status'] == 5){}else{ ?>
                          <div class="box-body pad">
                            <label>Please find <?php if (!empty($data)) { echo $data['name']; } ?>
                            resignation below</label>
                            <textarea class="textarea" id="get-discuss-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" readonly><?php if (!empty($data)) { 
                            echo stripslashes($data['resignation_text']); } ?></textarea>
                            </div>
                         
                        <div class="row">
                            <div class="col-xs-12">
                              <div class="col-sm-6">
                               <div class="form-group">
                  <label for="notice period">Notice Period (in days)</label>
                  <input type="text" class="form-control" id="notice_period" value="<?php if(!empty($notice_details) && !empty($notice_details['notice_period'])){ 
                                    echo $notice_details['notice_period'].' '. 'days';} ?>" readonly>
                </div>
                <div class="form-group">
                                  <label for="last working day">Last working day</label>
                                  <input type="text" class="form-control" id="last_working_day"
                                  value="<?php if(!empty($lastWorkingDay)){ 
                                    echo $lastWorkingDay;} ?>" readonly >
                                </div>
                        <?php if(!empty($data['serve_notice_period'])){}else{ ?>          
                                <div class="form-group">
                  <label>Reason for last working day</label>
                  <textarea class="form-control" rows="3"  disabled><?php if(!empty($data)){
                    echo $data['reason_for_last_working_day'];
                  } ?></textarea>
                </div>
                        <?php } ?>
                            </div>  
                            <div class="col-sm-6">
                               <div class="form-group">
                  <label for="notice period">Mobile Number</label>
                  <input type="number" class="form-control" id="notice_period" value="<?php if(!empty($notice_details) && !empty($notice_details['mobile'])){ 
                                    echo $notice_details['mobile'];} ?>" readonly>
                </div>
                <div class="form-group">
                                  <label>Willing to serve notice period</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="serve_notice_period" id="" value="1" 
                              <?php if(!empty($data) && $data['serve_notice_period'] == 1){echo 'checked';} ?>>Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="serve_notice_period" id="" value="0" 
                                <?php if(!empty($data) && $data['serve_notice_period'] == 0){echo 'checked';} ?>>No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label for="last working day">Request for Last working day</label>
                                  <input type="text" class="form-control" id="last_working_day"
                                  value="<?php if(!empty($separation_date)) {
                                   echo $separation_date;} else {echo '';}  ?>" readonly >
                                </div>
                            </div>
                            </div>
                        </div> 
                        <hr style="color: #00c0ef;"> 
                         <?php } ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-12">
                                    <label>Reason for Resignation [FUNCTIONAL APPRAISER]</label>
                                </div>
                                <hr>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                  <label>Retain Option</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" class="dis12" name="retain_option" id="" value="2"
                                     <?php if(!empty($data) && ($data['appraiser_status'] == 2||5)){echo 'checked';} ?>>
                              Approve</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" class="dis12" name="retain_option" id="" value="3" 
                                     <?php if(!empty($data) && $data['appraiser_status'] == 3){echo 'checked';} ?>>
                                  Retain</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label>Hold Salary</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" class="dis12" name="hold_salary" id="" value="1"
                                     <?php if(!empty($data) && $data['hold_salary'] == 1){echo 'checked';} ?>>
                              Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" class="dis12" name="hold_salary" id="" value="0" 
                                     <?php if(!empty($data) && $data['hold_salary'] == 0){echo 'checked';} ?>>
                                  No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label for="last working">Last working day</label>
                                  <input type="text" class="form-control dis12" id="last_working"
                                  value="<?php if(!empty($separation_date)){echo $separation_date;} ?>" >
                                </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                  <label for="exit reason">Exit Reason</label>
                                  <select class="form-control dis12" id="exit-reason-supervisor">
                                        <option value="">select reason</option>
                                    <?php if(!empty($exit_reason)){ foreach($exit_reason as $r) {?>    
                                        <option value="<?php echo $r['id']; ?>"<?php 
                                        if(!empty($data) && $data['exit_reason'] == $r['id']){
                                            echo 'selected=selected';} ?> ><?php echo $r['reason']; ?></option>
                                    <?php } }?>    
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label>Serve Notice Period</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="serve_notice" id="" class="dis12" value="1"
                              <?php if(!empty($data) && $data['serve_notice_period'] == 1){echo 'checked';} ?> >Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="serve_notice" class="dis12" id="" value="0"
                              <?php if(!empty($data) && $data['serve_notice_period'] == 0){echo 'checked';} ?> >No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label>Waiver of Notice Pay</label>
                                  <div class="radio">
                                  <label>
                                      <input type="radio" name="waiver_notice_pay" class="dis12" id="" value="1"
                              <?php if(!empty($data) && $data['waiver_notice_pay'] == 1){echo 'checked';} ?>>Notice period to be waived off</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="waiver_notice_pay" class="dis12" id="" value="0" 
                              <?php if(!empty($data) && $data['waiver_notice_pay'] == 0){echo 'checked';} ?> >Recovery for notice period not served</label>
                              </div>
                                </div>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="box-body pad">
                            <label>Appraiser Comments</label>
                            <textarea class="textarea dis12" id="get-appraiser-txt" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" readonly>
                                <?php if(!empty($data['appraiser_comments'])){echo stripslashes($data['appraiser_comments']);} ?></textarea>
                            </div>
                        <hr style="color: #00c0ef;"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-12">
                                    <label>Reason for Resignation [Reviewer]</label>
                                </div>
                                <hr>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                  <label>Retain Option</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" class="" name="retain_option_reviewer" id="" value="2"
                                     <?php if(!empty($data) && $data['appraiser_status'] == 2||5){echo 'checked';} ?>>
                              Approve</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" class="" name="retain_option_reviewer" id="" value="3" 
                                     <?php if(!empty($data) && $data['appraiser_status'] == 3){echo 'checked';} ?>>
                                  Retain</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label>Hold Salary</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" class="" name="hold_salary_by_reviewer" id="" value="1"
                                     <?php if(!empty($data) && $data['hold_salary'] == 1){echo 'checked';} ?>>
                              Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" class="" name="hold_salary_by_reviewer" id="" value="0" 
                                     <?php if(!empty($data) && $data['hold_salary'] == 0){echo 'checked';} ?>>
                                  No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label for="last working">Last working day</label>
                                  <input type="text" class="form-control" id="last_working_by_reviewer"
                                  value="<?php if(!empty($separation_date)){echo $separation_date;} ?>" >
                                </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                  <label for="exit reason">Exit Reason</label>
                                  <select class="form-control" id="exit-reason-by-reviewer">
                                        <option value="">select reason</option>
                                    <?php if(!empty($exit_reason)){ foreach($exit_reason as $r) {?>    
                                        <option value="<?php echo $r['id']; ?>"<?php 
                                        if(!empty($data) && $data['exit_reason'] == $r['id']){
                                            echo 'selected=selected';} ?> ><?php echo $r['reason']; ?></option>
                                    <?php } }?>    
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label>Serve Notice Period</label>
                                  <div class="radio">
                                  <label>
                              <input type="radio" name="serve_notice_by_reviewer" id="" class="" value="1"
                              <?php if(!empty($data) && $data['serve_notice_period'] == 1){echo 'checked';} ?> >Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="serve_notice_by_reviewer" class="" id="" value="0"
                              <?php if(!empty($data) && $data['serve_notice_period'] == 0){echo 'checked';} ?> >No</label>
                              </div>
                                </div>
                                <div class="form-group">
                                  <label>Waiver of Notice Pay</label>
                                  <div class="radio">
                                  <label>
                                      <input type="radio" name="waiver_notice_pay_by_reviewer" class="" id="" value="1"
                              <?php if(!empty($data) && $data['waiver_notice_pay'] == 1){echo 'checked';} ?>>Notice period to be waived off</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <label><input type="radio" name="waiver_notice_pay_by_reviewer" class="" id="" value="0" 
                              <?php if(!empty($data) && $data['waiver_notice_pay'] == 0){echo 'checked';} ?> >Recovery for notice period not served</label>
                              </div>
                                </div>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="box-body pad">
                            <label>Reviewer Comments</label>
                            <textarea class="textarea" id="get-reviewer-comment" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                      <div class="box-footer pull-right">
                            <button type="button" id="btn-reviewer" class="btn btn-primary">Submit</button>
                            <button type="button" id="btn-backResignSupervisior" class="btn btn-default">Back</button>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Html->script(['exit']); ?>
<script>
$('#last_working').datepicker({
    minDate : 0
});
$('#last_working_by_reviewer').datepicker({
});

$(function () {
$('.textarea').wysihtml5();
});  
$( "#get-discuss-txt" ).prop( "disabled", true );
$(".dis12").prop("disabled", true);
$("input[name=serve_notice_period]").attr('disabled', true);
</script>