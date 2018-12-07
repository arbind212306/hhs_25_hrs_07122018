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
                        'action' => 'initiateAbscondingTermination']); ?>
                </p>
            </div>
        </div>
    </div>
</section>  
<!-- section for dispalying message ends here -->   

<section class="content" id="initiate-absconding">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php if (!empty($data)) {
                        echo $data['name'];
                    } ?>
                        <small>Employee Id : <?php if (!empty($data)) echo $data['emp_id']; ?></small></h3>
                    <small class="pull-right">Email Id : <?php if (!empty($data)) echo $data['email']; ?></small>
                </div>
<?= $this->Form->create(null, ['url' => false]); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Process</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="process" id="" value="0">Absconding</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label><input type="radio" name="process" id="" value="1" checked>Termination</label>
                                </div>
                            </div>
                            <input type="hidden" id="hidden_empid" value="<?php if (!empty($data)) echo $data['emp_id']; ?>">
                            <input type="hidden" id="hidden_id" value="<?php if (!empty($id)) echo $id; ?>">
                            <div class="form-group">
                                <label for="exit reason">Reason for Termination</label>
                                <select class="form-control" name="exit_reason" id="absconding-reason">
                                    <option value="">--select--</option>
                                    <?php
                                    if (!empty($absconding_reason)) {
                                        foreach ($absconding_reason as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>"><?= $value['terminate_reason']; ?></option>
    <?php }
}
?>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="last working day">Last working day</label>
                                <input type="text" id="last-working-day" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box-body pad">
                                <label>Remarks</label>
                                <textarea class="form-control" rows="7" id="remark" placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer pull-right">
                        <button type="button" id="btn-absconding" class="btn btn-primary">Submit</button>
                        <button type="button" id="btn-cancel-absconding" class="btn btn-default">Cancel</button>
                    </div>
                </div>
<?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?= $this->Html->script(['exit']); ?>
<script>    
$('#last-working-day').datepicker({
//minDate : 0,
dateFormat: 'dd-mm-yy'
});
</script>