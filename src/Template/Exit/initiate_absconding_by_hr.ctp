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
                            <h4>Status: <small style="color: orange;">&nbsp;&nbsp;&nbsp;
                        <?php if($data['hr_status'] == 2){
                            echo 'Pending With HR Manager.';
                        } ?>
                        </small></h4>
                </div>
                <div class="box-header with-border">
                    <h5 class="box-title" style="width: 100%;">
                        <?php if($data['process'] == 1){
                              echo 'Terminated by'.' '.$get_appraiser_name['name'].', '.'Employee Id:'.' '.$get_appraiser_name['emp_id'];
                                }else{?>
                                Absconded by <?php if (!empty($get_appraiser_name)) echo $get_appraiser_name['name'] .', '; ?> Employee Id : <?php if (!empty($get_appraiser_name)) echo $get_appraiser_name['emp_id']; } ?>
                                <span class="pull-right">submitted Date : <?php if (!empty($data['created_date'])){ 
                                    echo date('d-m-Y H:i:s', strtotime($data['created_date'])); }?></span></h5>
                </div>
                
<?= $this->Form->create(null, ['url' => false]); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Process</label>
                                <div class="radio dis12">
                                    <label>
                                        <input type="radio" class="dis12" name="process" id="" value="0" 
                                            <?php if(!empty($data) && $data['process'] == 0){echo 'checked';} ?>>
                                        Absconding</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label><input type="radio" class="dis12" name="process" id="" value="1" 
                                        <?php if(!empty($data) && $data['process'] == 1){echo 'checked';} ?>>
                                        Termination</label>
                                </div>
                            </div>
                            <input type="hidden" id="hidden_empid" value="<?php if (!empty($data)) echo $data['emp_id']; ?>">
                            <input type="hidden" id="hidden_id" value="<?php if (!empty($id)) echo $id; ?>">
                            <div class="form-group">
                                <label for="exit reason">Reason for Termination</label>
                                <select class="form-control dis12" name="exit_reason" id="absconding-reason-reviewer">
                                    <option value="">--select--</option>
                                    <?php
                                    if (!empty($absconding_reason)) {
                                        foreach ($absconding_reason as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" 
                                                <?php if($data['reason_for_termination'] == $value['id']){
                                                    echo 'selected=selected';
                                                } ?> ><?= $value['terminate_reason']; ?></option>
    <?php }
}
?>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="last working day">Last working day</label>
                                <input type="text" id="last-working-day" 
                                       value="<?php if(!empty($data['separation_date'])){ 
                                           echo date('d-m-Y', strtotime($data['separation_date']));} ?>" 
                                           class="form-control dis12" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="box-body pad">
                                <label>Appraiser Comments</label>
                                <textarea class="form-control dis12" rows="7" id="remark"><?php if(!empty($data['remarks'])){echo stripslashes($data['remarks']);} ?>
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <hr style="color: #00c0ef;">
                    <div class="col-xs-12">
                        <div class="col-xs-10">
                        <label>Reason for termination [Reviewer]</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exit reason">Reason for Termination</label>
                                <select class="form-control dis12" name="exit_reason_reviewer" id="absconding-reason">
                                    <option value="">--select--</option>
                                    <?php
                                    if (!empty($absconding_reason)) {
                                        foreach ($absconding_reason as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php 
                                            if($data['reason_for_termination'] == $value['id']){
                                                    echo 'selected=selected';
                                                } ?>>
                                                    <?= $value['terminate_reason']; ?> </option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="box-body pad">
                                <label>Reviwer Comments</label>
                                <textarea class="form-control dis12" rows="7" id="reviewer-comment-abscond"><?php 
                                if(!empty($data['reviewer_comment'])){echo $data['reviewer_comment'];} ?>
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <hr style="color: #00c0ef;">
                    <div class="col-xs-12">
                        <div class="col-xs-10">
                        <label>Reason for termination [HR Manager]</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exit reason">Reason for Termination</label>
                                <select class="form-control " name="exit_reason_reviewer" id="absconding-reason-hr">
                                    <option value="">--select--</option>
                                    <?php
                                    if (!empty($absconding_reason)) {
                                        foreach ($absconding_reason as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php 
                                            if($data['reason_for_termination'] == $value['id']){
                                                    echo 'selected=selected';
                                                } ?>>
                                                    <?= $value['terminate_reason']; ?> </option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="box-body pad">
                                <label>HR Manager Comments</label>
                                <textarea class="form-control " rows="7" id="hr-comment-abscond"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer pull-right">
                        <button type="button" id="btn-absconding-hr" class="btn btn-primary">Submit</button>
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
$(".dis12").prop("disabled", true);
</script>