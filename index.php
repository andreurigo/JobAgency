<?php
    $errorMsg = filter_input(INPUT_GET, "error_msg", FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login in JobNow!</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="IAW-Team">
        <link rel="shortcut icon" href="models/images/favicon.ico">
        <link href="models/css/bootstrap.min.css" rel="stylesheet">
        <link href="models/css/style.css" rel="stylesheet">
    </head>
    <body>
        <!--Cookie alert-->
        <div id="cookie">
            <div class='alert alert-dismissable alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4>Attention!</h4> 
                <strong>This site uses cookies!</strong>
                By continuing to browse the site, you are agreeing to ocur use of cookies. 
                <a href='https://en.wikipedia.org/wiki/HTTP_cookie' class='alert-link'> Find out more.</a>
            </div>
        </div>  
        <script>
            //Check if cookies are accepted
            if (-1 !== parseInt(document.cookie.indexOf("Cookies"))) document.getElementById("cookie").style.display = "none";
        </script>
        <!--logo-->
        <div class="logo">
            <img src="models/images/logo2.png">   
        </div>
        <!--login page-->
        <h3 class="text-center">Login to use the platform</h3>
        <div class="form">
            <form role="form" action="login.php" method="post">
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3 alert-danger">
                    <?php !empty($errorMsg) ? print($errorMsg) : null ?>
                </div>
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <input placeholder="Email Address" size="20" type="email" class="form-control text-center" name="email" id="Email1"/>
                </div>
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <input  placeholder="Password" size="20" type="password" class="form-control text-center" name="pass"id="Password1"/>
                </div>
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <button type="submit" class="btn btn-default" >Login</button>
                    <a class="btn btn-default" value="Go to my link location" href="app/register/index.php" />Register</a>
                </div>
            </form>
        </div>
        <!--footer-->
        <div class="footer text-center text-info col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            Copyright &COPY; <?php echo(date('Y')); ?> JobNow!
            </br>
            All rights reserved. This product is protected by copyright and distributed
            </br>under licenses restricting copying, distributions, and decompilation
        </div>
        <script src="models/js/jquery.min.js"></script>
        <script src="models/js/bootstrap.min.js"></script>
    </body>
</html>