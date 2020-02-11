<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../../models/images/favicon.ico">
<title>Register in JobNow!</title>
<meta name="author" content="IAW-Team">
<link href="../../models/css/bootstrap.min.css" rel="stylesheet">
<link href="../../models/css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css" />
<script>
//Show Company/User fields for register
    function Company(){
        document.getElementById('phone').style.display = 'none';
        document.getElementById('studies').style.display = 'none';
        document.getElementById('languages').style.display = 'none';
        document.getElementById('laboral').style.display = 'none';
    }
    function User(){
        document.getElementById('phone').style.display = 'block';
        document.getElementById('studies').style.display = 'block';
        document.getElementById('languages').style.display = 'block';
        document.getElementById('laboral').style.display = 'block';
    }
</script>
</head>
<body>
    <div class="logo">
        <a class="logo" href="../login/index.html"><img src="../../models/images/logo2.png"></a>   
    </div>
    <div class="content"><br/>
        <h3 class="text-center">Sign up to use the platform</h3>
<!--Registration form-->
        <form role="form" action="register.php" method="post">
            <div class="radios form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <input name="class" onclick="User()" type="radio" value="users" checked/> I'm a Particular <br/>
                    <input name="class" onclick="Company()" type="radio" value="companies"/> I'm a Company
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <input placeholder="Name" type="text" class="form-control" name='name' id="Name" value=<?php if (isset($name)) echo htmlentities($name); ?>>
            </div>
            <div id="phone" class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <input placeholder="Phone" type="text" class="form-control" name='phone' id="phone" value=<?php if (isset($phone)) echo htmlentities($phone); ?>>
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <input placeholder="Email" type="text" class="form-control" name='email' id="Email" value=<?php if (isset($newemail)) echo htmlentities($newemail); ?>>
            </div>
            <div id="studies" class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <textarea rows="1" placeholder="Finished Studies" type="text" class="form-control" name='study' id="study"><?php if (isset($study)) echo nl2br($study); ?></textarea> 
            </div>
            <div id="languages" class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <textarea rows="1" placeholder="Languages" type="text" class="form-control" name='languages' id="languages"><?php if (isset($language)) echo htmlentities($language); ?></textarea> 
            </div>
            <div id="laboral" class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <textarea rows="1" placeholder="Work Experience" type="text" class="form-control" name='laboral' id="laboral"><?php if (isset($laboral)) echo htmlentities($laboral); ?></textarea>
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <input placeholder="Password" type="password" class="form-control" name='pass1' id="Password1">
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <input  placeholder="Password Confirmation" type="password" class="form-control" name='pass2' id="Password2">
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <button type="submit" class="btn btn-default">Sign Up</button>
            </div>
        </form>
    </div>
<!--FOOTER-->
    <div class="footer text-center text-info col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        Copyright &#169; 2016 JobNow!<br/>All rights reserved. This product is protected by copyright and distributed <br/>under licenses restricting copying, distributions, and decompilation
    </div>
    <script src="../../models/js/jquery.min.js"></script>
    <script src="../../models/js/bootstrap.min.js"></script>

</body>
</html>