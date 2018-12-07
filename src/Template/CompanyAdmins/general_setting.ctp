<?php
$language = [
    'recruitment_input' => 'Candidate input type'
];
?>
<style>
    .btn-primary {
        color: #fff;
        background-color: #763240 !important;
        border-color: #763240 !important;
    }
    .end-input{
        padding: 3% 0 2% 0;
        border-bottom: 1px solid #e5e5e5;
        margin-bottom: 2%;
    }
</style>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-12">
        <div class="well well-sm">
            <fieldset>
                <legend class="text-left">Configuration</legend>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="email3">Company name:</label>
                    <div class="col-sm-9">
                        <p><?= $company->name; ?></p>
                    </div>
                </div>

                <?php
                if (!empty($company_settings)) {

                    foreach ($company_settings as $item) {
                        if ($item['type'] == 'recruitment_input') {
                            $value_candi_input = [];
                            if (!empty($item['value'])) {
                                $value_candi_input = json_decode($item['value'], true);
                            }
                            ?>
                            <?php
                            echo $this->Form->create('');
                            ?>
                            <div class="form-group" style="padding-top:5%;margin-top:1%;">
                                <label class="col-md-3 control-label">Candidate input type :</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <?php
                                            $checked1 = "";
                                            $checked2 = "";
                                            $checked3 = "";
                                            if (in_array(1, $value_candi_input)) {
                                                $checked1 = 'checked';
                                            }
                                            if (in_array(2, $value_candi_input)) {
                                                $checked2 = 'checked';
                                            }
                                            if (in_array(3, $value_candi_input)) {
                                                $checked3 = 'checked';
                                            }
                                            ?>
                                            <input type="checkbox" <?= $checked1; ?> name="cnd_input_type[]" value="1">API
                                        </label>
                                        <label  class="checkbox-inline">
                                            <input type="checkbox" <?= $checked2; ?> name="cnd_input_type[]" value="2">Bulk import
                                        </label>
                                        <label  class="checkbox-inline">
                                            <input type="checkbox" <?= $checked3; ?> name="cnd_input_type[]" value="3">Manual input
                                        </label>
                                    </div>
                                </div>  
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-right end-input">
                                    <?php
                                    echo $this->Form->input('form_type', ['type' => 'hidden', 'value' => $item['type']]);
                                    ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <?php
                                    //echo $this->Html->link('<button type="button" class="btn btn-primary">Cancel</button>', ['controller' => 'CompanyAdmins', 'action' => 'access-map'], ['escape' => false]);
                                    ?>                        
                                </div>
                            </div>
                            <?php
                            echo $this->Form->end();
                            ?>
                            <?php
                        } else if ($item['type'] == 'hirchy_top_band') {
                            $top_band = 0;
                            if (!empty($item['value'])) {
                                $top_band = $item['value'];
                            }
                            echo $this->Form->create('');
                            ?>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email3">Top band:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="top_band">
                                        <option  value="0">Please select</option>";
                                        <?php
                                        if (!empty($bandList)) {

                                            foreach ($bandList as $id => $band) {
                                                $selected = "";
                                                if ($id == $top_band) {
                                                    $selected = 'selected';
                                                }
                                                echo "<option $selected  value=\"$id\">" . $band . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-right end-input">
                                    <?php
                                    echo $this->Form->input('form_type', ['type' => 'hidden', 'value' => $item['type']]);
                                    ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->end();
                        }
                    }
                    ?>
                    <!-- Form actions -->

                <?php }
                ?>
            </fieldset>            
        </div>
    </div>
</div>