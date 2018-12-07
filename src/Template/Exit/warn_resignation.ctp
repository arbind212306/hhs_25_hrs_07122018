<style>
#exit-div-warn{
	margin-top: 10% ;
}
#exit-warn-btn{
	margin: 0 auto;
}
</style>

<!-- warning section starts here -->
<section class="content" id="warning-resignation">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3"></div>
			<div class="col-md-6 exit-div-warn" >
          <!-- Horizontal Form -->
          <div class="box box-warning" id="exit-div-warn">
            <div class="box-header with-border" style="text-align: center; color: red;">
              <h3 class="box-title">Are you sure you want resign !!</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo $this->Form->create(null, ['url' => false]); ?>
              <div class="box-body">
                <div class="form-group">
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" id="exit-warn-btn" style="text-align: center;">
                <button type="button" id="warning-btn-no" class="btn btn-default">No</button> &nbsp;&nbsp;
                <button type="button" id="warning-btn-yes" class="btn btn-primary">Yes</button>
              </div>
              <!-- /.box-footer -->
              <?= $this->Form->end(); ?>
          </div>
          <!-- /.box -->
        </div>
		</div>
	</div>
</section>
<!-- warning section ends here -->

<!-- section displaying employess total workings days and status starts here -->
<section class="content" id="warning-alert-resignation" style="display: none;">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3"></div>
			<div class="col-md-6 exit-div-warn" >
          <!-- Horizontal Form -->
          <div class="box box-info" id="exit-div-warn">
            <div class="box-header with-border">
              <h3 class="box-title"><?php if(!empty($name)) echo $name.',' ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <form class="form-horizontal"> -->
              <div class="box-body">
                <div class="form-group">
                   <div class="col-sm-12">You have been in this organization for 
                    <?php if(!empty($noOfWorkingDays)) echo $noOfWorkingDays ?> days. <br>
                    Would you like to discuss further on the decession that you have taken.
                	</div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" id="exit-warn-btn" style="text-align: center;">
                <button type="button" id="deny-resignation" class="btn btn-default">Yes, I would like to discuss</button> &nbsp;&nbsp;
                <button type="button" id="confirm-resignation" class="btn btn-primary">No, I want to submit my Resignation</button>
              </div>
              <!-- /.box-footer -->
            <!-- </form> -->
          </div>
          <!-- /.box -->
        </div>
		</div>
	</div>
</section>
<!-- section for displaying employess total workings days and status ends here -->

<?= $this->Html->script(['exit']); ?>