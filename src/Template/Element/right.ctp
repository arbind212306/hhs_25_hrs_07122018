<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2 nopadding " ng-show="showInfo" id="rightDiv"><!-- style="border-left:6px solid #e2f0d9 !important; height: 50%;">-->
    <div style="margin-left:4%;">
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/officephone.png');
            ?>
            <label class="RightBarLabelText ">0124-12345678 Ext: 6086</label>
        </p>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/mobile.png');
            ?>
            <label class="RightBarLabelText">+91-987456123</label>
        </p>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/mail.png');
            echo $this->Html->image('SideBarIcons/linkedin.png');
            echo $this->Html->image('SideBarIcons/twitter.png');
            echo $this->Html->image('SideBarIcons/facebook.png');
            ?>
        </p>
        <hr>
        <p><label class="RightBarHead">Hire Date</label></p>
        <p><label class="RightBarLabelText">Oct 01, 2018</label></p>
        <p><label class="RightBarLabelText">0Y - 0M - 10D</label></p>
        <hr>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/fulltime.png');
            ?>
            <label class="RightBarLabelText">Full Time</label>
        <p>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/team.png');
            ?>
            <label class="RightBarLabelText">Development</label>
        <p>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/location.png');
            ?>
            <label class="RightBarLabelText">Gurgaon, India</label>
        <p>
        <hr>
        <p><label class="RightBarHead">Manager</label></p>
        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                <?php
                echo $this->Html->image('SideBarIcons/manager1.png');
                ?>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 col-xs-9"><label class="RightBarLabelText"><b>Abhishek Verma</b></label><br>
                <label class="RightBarLabelText">Program Manager</label>
            </div>
        </div>


        <p>
            <label class="RightBarHead"><br>Direct Reports</label>
        </p>
        <p ng-repeat="woman in ['Pratibha', 'Kajol']">
            <?php
            echo $this->Html->image('SideBarIcons/femalereportees.png');
            ?>
            <label class="RightBarLabelText">{{woman}}</label>
        </p>
        <p ng-repeat="man in ['Azhar', 'Saurabh', 'Sumit']">
            <?php
            echo $this->Html->image('SideBarIcons/malereportees.png');
            ?>
            <label class="RightBarLabelText">{{man}}</label>
        </p>
        <p>
            <?php
            echo $this->Html->image('SideBarIcons/morereportees.png');
            ?>
            <label class="RightBarLabelText">More....</label>
        </p>
    </div>
</div>