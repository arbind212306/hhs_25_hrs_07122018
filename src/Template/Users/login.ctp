<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Human Resource Information System</title>
        <?php
        echo $this->Html->css(['bootstrap']);
        ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
        echo $this->Html->css(['Style', 'bootstrap-custom']);
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- Leave those next 4 lines if you care about users using IE8 -->
        <!--[if lt IE 9]>
        <script src="../js/html5shiv.min.js"></script>
        <script src="../js/respond.min.js"></script>
        <![endif]-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <?php
        $webroot = $this->Url->build('/');
        ?>
    </head>
    <body style="background-image: url('<?= $webroot; ?>img/login-bg.jpg');" class="login-bg"><!--<img src="images/login-bg.png"></img>-->
        <div class="center-outer">
            <div class="center-inner">
                <div class="center-content box-shadow login-box">
                    <?php
                    echo $this->Form->create('');
                    ?>
                    <form>
                        <div class="form-group text-center">
                            
                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <hr/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block ">Sign In</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="forgot-password.html" class="text-muted">Forgot Password?</a>
                        </div>
                        <?php
                        echo $this->Form->end();
                        ?>
                </div>
            </div>
        </div>
        <?php
        echo $this->Html->script(['jquery-1.12.4', 'bootstrap']);
        ?>
    </body>
</html>