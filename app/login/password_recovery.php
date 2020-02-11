<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../models/images/favicon.ico">
        <title>Password recovery</title>
        <meta name="author" content="IAW-Team">
        <link href="../../models/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../models/css/style.css" rel="stylesheet">
    </head>
    <body>
        <!--logo-->
        <div class="logo">
            <img src="../../models/images/logo2.png">   
        </div>
        <!--login page-->
        <h3 class="text-center">Enter email to recover your password</h3>
        <div class="form">
            <form method="POST" action="<?php print(filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL)); ?>">    
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <input placeholder="Email Address" size="20" type="email" class="form-control text-center" name="email" id="Email1">
                    <label>*The email could be in the spam folder. Check it if you not see nothing new in your inbox.</label>
                </div>
                <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
            <?php
            if (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === "POST") {
                include_once '..\..\models\mysqli_connect.php';
                $email = mysqli_real_escape_string($dbc, filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));

                $findUserByEmailQuery = mysqli_query($dbc, "SELECT UserID, Email FROM users WHERE Email = '$email'");
                $findUserByEmailResult = mysqli_num_rows($findUserByEmailQuery);

                if (1 === $findUserByEmailResult) {
                    $userFoundData = mysqli_fetch_array($findUserByEmailQuery, MYSQLI_ASSOC);
                    $newPass = mysqli_real_escape_string($dbc, uniqid("sjo", true));

                    $updateUserQuery = "UPDATE users SET Password = SHA1('$newPass') WHERE UserID = {$userFoundData['UserID']}";
                    if (mysqli_query($dbc, $updateUserQuery)) {
                        $mailHeaders = [
                            'to' => $userFoundData['Email'],
                            'subject' => 'Password recovery request',
                            'msg' => "Your new password is: $newPass",
                            'additionalHeaders' => 'From: noreply@borsatreball.santjosepobrer.com' . "\r\n" .
                                'Reply-To: webmaster@santjosepobrer.com' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion()
                        ];

                        if (mail($mailHeaders['to'], $mailHeaders['subject'], $mailHeaders['msg'], $mailHeaders['additionalHeaders'])) {
                            print("<p class=\"alert alert-success\">Email sent!</p>");
                        } else {
                            print("<p class=\"alert alert-danger\">Email not sent!</p>");
                        }
                    } else {
                        print("<p class=\"alert alert-danger\">An error has been ocurred while trying to update user password.</p>");
                    }
                } else {
                    print("<p class=\"alert alert-danger\">Email not found!</p>");
                }
            }
            ?>
        </div>
        <!--footer-->
        <div class="footer text-center text-info col-lg-12 col-md-12 col-sm-12 col-xs-12" >
            Copyright &#169; 2016 JobNow!<br/>All rights reserved. This product is protected by copyright and distributed <br/>under licenses restricting copying, distributions, and decompilation
        </div>
        <script src="../../models/js/jquery.min.js"></script>
        <script src="../../models/js/bootstrap.min.js"></script>
    </body>
</html>
