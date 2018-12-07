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

<section class="content" id="add-discussion">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php if (!empty($name)) echo $name; ?>
                <small>Employee Id : <?php if (!empty($emp_id)) echo $emp_id; ?></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <?= $this->Form->create(null, ['url' => false]); ?>
              <input type="hidden" id="hidden_employee_id" value="<?php if (!empty($emp_id)) echo $emp_id; ?>">
                <textarea class="textarea" id="get-discuss-txt" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                <div class="box-footer">
                	<button type="button" class="btn btn-primary" id="submit-discuss-text">Submit</button>
              	</div>          
              <?php echo $this->Form->end(); ?>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
 <!-- <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>  -->
 <script src="<?= $this->Url->build('/bower_components/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= $this->Url->build('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script> 
<?= $this->Html->script(['exit']); ?>
  <script>
  	 $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    // CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
  </script>