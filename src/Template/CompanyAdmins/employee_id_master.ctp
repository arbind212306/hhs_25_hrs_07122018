 <section class="content-header" style="padding-left:2%;">
       
        <h4>
           Employee Id Master dg <?php echo $this->Flash->render(); ?>
        </h4>
    </section>
<div class="row"> 
    <div class="col-md-12">
        <div class="well well-sm">	 
            <?php
				//pr($userRight);die;
				echo $this->Form->create('');
				if (empty($new)) {  
					$userObj = $userRight['employee'];
					$text1 = 'Edit';
					echo $this->Form->input('u_right_id', ['value' => $userRight['id'], 'type' => 'hidden']);
				} else {
					$userObj = $user;
					$text1 = 'Add';
					echo $this->Form->input('u_id', [value => $user['id'], 'type' => 'hidden']);
				}
            ?>
            <fieldset>
                <div class="col-md-12 padding-md">
				 <div class="form-group">
					<label for="prefix">Custom Prefix</label>
					<input type="text" class="form-control" id="prefix" name="employee_id_logic[prefix][value]" placeholder="Prefix">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" name="employee_id_logic[prefix][check]" value="1"  id="prefixCheck">
					<label class="form-check-label" for="prefixCheck">Use Custom Prefix</label>
				  </div> 
				   <div class="form-group">
					<label for="companyPrefix">Company</label>
					<input type="text" class="form-control" id="companyPrefix" name="employee_id_logic[companyPrefix][value][1]" placeholder="Company">
				  </div>
				  <div class="form-group">
					<label for="companyPrefix">Company</label>
					<input type="text" class="form-control" id="companyPrefix" name="employee_id_logic[companyPrefix][value][2]" placeholder="Company">
				  </div> 
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" name="employee_id_logic[companyPrefix][check]" value="1" id="companyPrefixCheck">
					<label class="form-check-label" for="companyPrefixCheck">Use Company Prefix</label>
				  </div> 
				   <div class="form-group">
					<label for="companyPrefix">Business Unit Prefix</label>
					<input type="text" class="form-control" id="businessUnitPrefix" name="employee_id_logic[businessUnitPrefix][value][1]" placeholder="Business Unit Prefix">
				  </div>
				    <div class="form-group">
					<label for="companyPrefix">Business Unit Prefix</label>
					<input type="text" class="form-control" id="businessUnitPrefix" name="employee_id_logic[businessUnitPrefix][value][2]" placeholder="Business Unit Prefix">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" name="employee_id_logic[businessUnitPrefix][check]" value="1" id="businessUnitPrefixCheck">
					<label class="form-check-label" for="businessUnitPrefixCheck">Use Business Unit Prefix</label>
				  </div> 
				  <div class="form-group">
					<label for="designationPrefix">Designation Prefix</label>
					<input type="text" class="form-control" id="designationPrefix" name="employee_id_logic[designationPrefix][value]" placeholder="Designation Prefix">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" name="employee_id_logic[designationPrefix][check]" value="1" id="designationPrefixCheck">
					<label class="form-check-label" for="designationPrefixCheck">Use Designation Prefix</label>
				  </div> 
				   <div class="form-group">
					<label for="companyPrefix">Location Prefix</label>
					<input type="text" class="form-control" id="locationPrefix" name="employee_id_logic[locationPrefix][value]" placeholder="Location Prefix">
				  </div>
				  <div class="form-check">
					<input type="checkbox" class="form-check-input" name="employee_id_logic[locationPrefix][check]" value="1" id="locationPrefixCheck">
					<label class="form-check-label" for="locationPrefixCheck">Use Location Prefix</label>
				  </div> 
				  <div class="form-group">
					<label for="companyPrefix">Increment Last Employee Id by</label>
					<input type="number" class="form-control" id="lastEmployeeIdIncrement" min="1" value="1" name="employee_id_logic[lastEmployeeIdIncrement][value]" placeholder="Increment Last Employee Id by">
				  </div>
				  
                </div>
				 <!-- Form actions -->
                <div class="form-group">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <?php 
                           echo $this->Form->input('form_type', ['type' => 'hidden', 'value' => 'empid_logic']); 
                        echo $this->Html->link('<button type="button" class="btn btn-primary">Cancel</button>', ['controller' => 'CompanyAdmins', 'action' => 'access-map'], ['escape' => false]);
                        ?>                        
                    </div>
                </div>
            </fieldset>
			 <?php
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>