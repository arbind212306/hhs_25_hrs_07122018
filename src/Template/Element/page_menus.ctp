<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
    <?php
    if (!empty($allowed_menu)) {

        foreach ($allowed_menu as $parent) {
            ?>
            <div class="EFR">
                <label ng-show="plus" ng-click="plus = false;minus = true;">
                    <?php
                    echo '&emsp;+&nbsp;' . $parent['name'];
                    ?>
                </label>
                <label ng-show="minus" ng-click="minus = false;plus = true;">&emsp;-&nbsp;<?= $parent['name'] ?></label>
                <?php
                if (!empty($parent['children'])) {
                    ?>
                    <div class="text EFR" ng-show="minus">
                        <ul class="list-unstyled">
                            <li class="active treeview">
                                <a href="#">
                                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gears"></i> <span>Control Panel</span>
                                </a>
                            </li>




                            <?php
                            foreach ($parent['children'] as $child) {
                                ?>
                                <li>
                                    <?php
                                    echo $this->Html->link('- ' . $child['name'], ['controller' => $child['controller'], 'action' => $child['action']], ['escape' => false, 'style' => 'color:#000 !important;']);
                                    ?>
                                    <?php
                                }
                                ?>
                        </ul>
                    </div> 
                <?php }
                ?>
            </div>
            <?php
        }
    }
    ?>



</div>