<?php
include('headerCompanies.html');
//PHP code to change password
if(isset($_POST['submit'])){

    $actualpword = sha1($_POST['oldpass']);
    $pword = sha1($_POST['newpass1']);
    $pword2 = sha1($_POST['newpass2']);

    if($actualpword != $_COOKIE['Password']){
        echo    '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">
                                
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    Error!
                                </h4> <strong>Warning!</strong> Actual password incorrect.
                            </div>
                        </div>
                    </div>
                </div>';
    } elseif($pword != $pword2){
        echo    '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">        
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    Error!
                                </h4> <strong>Warning!</strong> New passwords doesn\'t match.
                            </div>
                        </div>
                    </div>
                </div>';
    } elseif($actualpword == $pword) {
        echo    '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">        
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    Error!
                                </h4> <strong>Warning!</strong> Please insert a different password.
                            </div>
                        </div>
                    </div>
                </div>';
    } else {
        require ('../../models/mysqli_connect.php');
        $q = "UPDATE companies SET Password='".$pword."' WHERE CompanyID=".$_COOKIE['CompanyID'];

        $r = @mysqli_query ($dbc, $q);

        if($r){
            include('../../models/success.php');
            $id = $_COOKIE['CompanyID'];
            require('../../models/removecookies.php');

            $qi = "SELECT * FROM companies where CompanyID='".$id."' LIMIT 1";

			$ri = @mysqli_query ($dbc, $qi);

            while ($row1 = mysqli_fetch_array($ri, MYSQLI_ASSOC)) {
                require('../../models/cookiesCompany.php');
            }
        } else {
            include('../../models/error.php');
        }
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h1>
                    Change your password <?php echo $_COOKIE['Name'] ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="cuerpo" class="col-md-12">
            <form role="form" action="" method="post">
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="passwordold" style="color:white;">
                        Actual Password
                    </label>
                    <input type="password" class="form-control" name='oldpass' id="oldpass">
                </div>
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="newpassword1" style="color:white;">
                        New Password
                    </label>
                    <input type="password" class="form-control" name='newpass1' id="newpass1">
                </div>
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="Password2" style="color:white;">
                        Repeat New Password
                    </label>
                    <input type="password" class="form-control" name='newpass2' id="newpass2">
                </div>
                <div class="col-xs-2 col-xs-offset-5">
                    <button type="submit" name="submit" class="btn btn-default">
                        Change Password
                    </button>
                </div>
            </form>
<?php
include('footer.html');
?>