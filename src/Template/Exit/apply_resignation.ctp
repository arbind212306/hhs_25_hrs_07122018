<!-- <div id="discussion-form"></div> -->
			
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
					<?php echo $this->Html->link('>> Go To Home', ['controller' => 'Users', 'action' => 'gotoDashboard']); ?>
				</p>
			</div>
		</div>
	</div>
</section>	
<!-- section for dispalying message ends here -->		  

<!-- form for applying resignation starts here -->
			<section class="content" id="add-resignation">
				<div class="row">
					<div class="col-md-12">
			          <!-- general form elements -->
			          <div class="box box-primary">
			            <div class="box-header with-border">
			              <h3 class="box-title"><?php if (!empty($name)) echo $name; ?>
			              <small>Employee Id : <?php if (!empty($emp_id)) echo $emp_id; ?></small></h3>
			              <small class="pull-right">Email Id : <?php if (!empty($email)) echo $email; ?></small>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->

			            <?= $this->Form->create(null, ['url' => false]); ?>
			              <div class="box-body">
			              <input type="hidden" id="hidden_employee_id" value="<?php if (!empty($emp_id)) echo $emp_id; ?>">
			              <div class="box-body pad">
			                <textarea class="textarea" id="get-discuss-txt" placeholder="Place some text here"
			                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
			                </div>
			                <div class="col-md-10">
			                	<p>Based on your feedback we would like you to classify your top exit reasons.<p>
			                </div>
			                <div class="row"> 
			                <div class="col-md-12">         
			                <div class="col-md-6">         
				                <div class="form-group">
				                  <label for="exit reason">Exit Reason</label>
				                  <select class="form-control" id="exit-reason">
					                    <option value="">select reason</option>
					                <?php if(!empty($exit_reason)){ foreach($exit_reason as $r) {?>    
					                    <option value="<?php echo $r['id']; ?>"><?php echo $r['reason']; ?></option>
					                <?php } }?>    
		                  			</select>
				                </div>
				            </div>
				            <div class="col-md-6">    
			                	<div class="form-group">
				                  <label for="mobile number">Mobile Number</label>
				                  <input type="number" class="form-control" id="mobile" 
				                  value="<?php if(!empty($data) && !empty($data['mobile'])){ 
				                  	echo $data['mobile'];} ?>" placeholder="Enter Mobile Number" readonly>
			                	</div>
			                </div>
			              </div>
			          </div>
			          <div class="row"> 
			                <div class="col-md-12">         
			                <div class="col-md-6">
				                <div class="form-group">
				                  <label for="notice peroid">Notice Period (in days)</label>
				                  <input type="text" class="form-control" id="notice_period" 
				                  value="<?php if(!empty($data) && !empty($data['notice_period'])){ 
				                  	echo $data['notice_period'].' '. 'days';} ?>" readonly>
				                </div>
				                <div class="form-group">
				                  <label>Willing to serve notice period</label>
				                  <div class="radio">
				                  <label>
		                      <input type="radio" name="serve_notice_period" id="noticeYes" value="1" checked>Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                      <label><input type="radio" name="serve_notice_period" id="noticeNo" value="0">No</label>
		                      </div>
				                </div>
                                            <div class="form-group" id="shortfall" style="display:none;">
				                  <label for="shortfall day">Notice period short fall days</label>
				                  <input type="text" class="form-control" id="shortfall_day" readonly="">
			                	</div>
				            </div>
				            <div class="col-md-6">    
			               <div class="form-group" id="display_lastWorkingday">
				                  <label for="last working day">Last working day</label>
				                  <input type="text" class="form-control" id="last_working_day"
				                  value="<?php if(!empty($lastWorkingDay)){ 
				                  	echo $lastWorkingDay;} ?>" readonly >
			                	</div>
                                                <div class="form-group" id="rqst_last_day" style="display:none;">
				                  <label for="last working day">Request for last working day</label>
				                  <div class="input-group date">
					                <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input type="text" class="form-control pull-right" id="exit-datepicker">
					                </div>
			                	</div>
                                                <div class="form-group" id="early_relieve" style="display:none;">
		                  <label>Reason for early Relieving</label>
		                  <textarea class="form-control" rows="3" id="reason_last_working_day" placeholder="Enter ..."></textarea>
		                </div>
			                </div>
			              </div>
			          </div>
			          <div class="box-footer pull-right">
			                <button type="button" id="submit-resignation" class="btn btn-primary">Submit</button>
			                <button type="button" id="submit-resignation" class="btn btn-default">Cancel</button>
			              </div>
			          	</div>
			              <!-- /.box-body -->

			              
			            <?php echo $this->Form->end(); ?>
			          </div>
			          <!-- /.box -->
			        </div>
				</div>
			</section>
<!-- form for applying resignation ends here -->
			<!-- <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>  -->
<script src="<?= $this->Url->build('/bower_components/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= $this->Url->build('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Html->script(['exit']); ?>
<script>
$(function () {
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
// CKEDITOR.replace('editor1')
//bootstrap WYSIHTML5 - text editor
$('.textarea').wysihtml5();
})
$('#exit-datepicker').datepicker({
minDate : 0,
dateFormat: 'dd-mm-yy'
});

//code setting the shortfall days based on request for last working days
$('#exit-datepicker').change(function(){
	var request_date = $('#exit-datepicker').val();
	var lastWorkingDay = '<?php echo $lastWorkingDay ?>'; 
	//code for getting the date in string format
	var a = new Date(lastWorkingDay.split('-')[2],lastWorkingDay.split('-')[1]-1,lastWorkingDay.split('-')[0]);
	var b = new Date(request_date.split('-')[2],request_date.split('-')[1]-1,request_date.split('-')[0]);
	//code to convert date to millisecond
	var c= Date.parse(a);
	var d = Date.parse(b);
	//code to get difference in number of days
	var diff = Math.round((a-b)/(1000*60*60*24));
	$('#shortfall_day').val(diff);
});

$(document).ready(function(){
$('#noticeYes').click(function(){
   $('#display_lastWorkingday').show();
   $('#rqst_last_day').hide();
   $('#early_relieve').hide();
   $('#shortfall').hide();
});
$('#noticeNo').click(function(){
   $('#display_lastWorkingday').hide();
   $('#rqst_last_day').show();
   $('#early_relieve').show();
   $('#shortfall').show();
});
});

</script>
