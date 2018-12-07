<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-md-12">
        <div class="well well-sm">
            <fieldset>
                <label>Employee listing</label> 
            </fieldset>
        </div>
    </div>    
    <div class="col-md-12">
        <div class="well well-sm">
            <fieldset>
                <div class="col-md-12 padding-md">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">EMP ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($userRights)) {
                                foreach ($userRights as $key => $usr) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= ($key + 1); ?></th>
                                        <td><?= $usr['first_name']; ?></td>
                                        <td><?= $usr['emp_id']; ?></td>
                                        <td>
                                            <?php
                                            if (!empty($usr['user_right'])) {
                                                echo $this->Html->link('<span style="color:#763240;"> Edit Access</span>', ['controller' => 'CompanyAdmins', 'action' => 'setAccess', $usr['user_right']['id']], ['escape' => false]);
                                            } else {
                                                echo $this->Html->link('<span style="color:#763240;"> Add Access</span>', ['controller' => 'CompanyAdmins', 'action' => 'addAccess', $usr['id']], ['escape' => false]);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>       
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>