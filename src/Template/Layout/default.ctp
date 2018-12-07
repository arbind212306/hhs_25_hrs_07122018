<!DOCTYPE html>
<html lang="en">
    <?php
    echo $this->element('header');
    ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php
            echo $this->element('top_user_info');
            //echo $this->element('top_search');
            ?>
            <!-- Third Row starts -->

            <?php
            echo $this->element('left_navigation');
            // echo $this->element('top_icons');
            ?>
            <?php /* <div class="row CenterCointainerStyle" id="rightColumn1">
              <?php
              //echo $this->element('page_menus');
              ?>
              <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8 RoundedDiv nopadding" id="centerDiv" style="width: 83.3%;">
              <div class="row nomargin box">
              <div class="col-md-12">
              <?php echo $this->Flash->render(); ?>
              <?= $this->fetch('content') ?>
              </div>
              <div class="col-md-0 nomargin">
              <?php
              echo $this->Html->image('SideBarIcons/LeftArrowblue.png', ['class' => 'float-right toprightarrow', 'ng-show' => '!showInfo', 'ng-click' => 'showInformation()']);
              echo $this->Html->image('SideBarIcons/RightArrowblue.png', ['class' => 'float-right toprightarrow', 'ng-show' => 'showInfo', 'ng-click' => 'showInformation()']);
              ?>
              </div>
              </div>
              </div>
              <?php
              echo $this->element('right');
              ?>
              </div> */ ?>

            <div class="content-wrapper" >
                <!-- Content Header (Page header) -->
                <section class="content-header">
                   <?php /* <h1>
                        Dashboard
                        <!--small>Version 2.0</small-->
                    </h1> */ ?>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php echo $this->Flash->render(); ?>
                    <?= $this->fetch('content') ?>
                    <!-- Info boxes -->

                    <!-- /.row -->


                    <!-- /.row -->

                    <!-- Main row -->
                    <!-- /.col -->
                </section>
            </div>
        </div>
        <?php
        echo $this->element('footer');
        ?>
    </body>
</html>