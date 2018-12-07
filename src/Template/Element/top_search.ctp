<div class="row RowColor" style="width:100%;">
    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-7 box">
        <div class="centered ToggleLeftBar">
            <?php
            echo $this->Html->image('SideBarIcons/expandwhite.png', ['height' => '32px', 'width' => '32px', 'class' => 'img-responsive', 'ng-click' => 'showLeftInformation()', 'title' => "Toggle Bar"]);
            ?>
        </div>
        <div class="centered RowSeparator">|</div>
        <div style="float:left;" class="nopadding">
            <ul class="bcrumb">
                <li>
                    <?php
                    echo $this->Html->link($this->Html->image('SideBarIcons/homewhite.png', ['height' => '20px', 'width' => '20px']), ['controller' => 'Pages', 'action' => 'dashboard'], ['escape' => false]);
                    ?>
                </li>
                <li><a href="organizationalstructure.html">Organizational Structure</a></li>
                <li>Controls</li>
            </ul>
        </div>						
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5 col-xs-5 box" style="padding-top:5px;">
            <!--<img ng-show="!ShowSearch" src="images/SideBarIcons/search.png" ng-click="ShowSearch=true" class="topright"/>
            <img ng-show="ShowSearch" src="images/SideBarIcons/searchcancel.png" ng-click="ShowSearch=false" class="topright"/>-->
        <form class="searchbox">
            <input type="search" placeholder="Search......" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
            <input type="submit" class="searchbox-submit" value="GO">
            <span class="searchbox-icon">
                <i class="glyphicon glyphicon-search glyphicon-color" style="color:white;"></i>
            </span>
        </form>
    </div>
</div>