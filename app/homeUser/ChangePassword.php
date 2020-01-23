<?php 
include('headerUser.html');
//PHP code to change password
if(isset($_POST['submit'])){
    $actualpword = sha1($_POST['oldpass']);
    $pword = sha1($_POST['newpass1']);
    $pword2 = sha1($_POST['newpass2']);
//Check if current password is correct
    if($actualpword != $_COOKIE['Password']){
        echo    '<div class="container-fluid row col-md-12">
                    <div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <h4>
                            Error!
                        </h4> <strong>Warning!</strong> Current password incorrect.
                    </div>
                </div>';
//Check if new password confirmaion match
    } elseif($pword != $pword2){
        echo    '<div class="container-fluid row col-md-12">
                    <div class="alert alert-dismissable alert-danger">        
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <h4>
                            Error!
                        </h4> <strong>Warning!</strong> New passwords don\'t match.
                    </div>
                </div>';
//Check if password is being changed
    } elseif($actualpword == $pword) {
        echo    '<div class="container-fluid row col-md-12">
                    <div class="alert alert-dismissable alert-danger">        
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <h4>
                            Error!
                        </h4> <strong>Warning!</strong> Please insert a different password.
                    </div>
                </div>';
    } else {
//Change password
        require ('../../models/mysqli_connect.php');
        $q = "UPDATE users SET Password='".$pword."' WHERE UserID=".$_COOKIE['UserID'];
        $r = @mysqli_query ($dbc, $q);
//If it ran OK
        if($r){
            include('../../models/success.php');
            $id = $_COOKIE['UserID'];
            require('../../models/removecookies.php');
            $qi = "SELECT * FROM users where UserID='".$id."' LIMIT 1";
			$ri = @mysqli_query ($dbc, $qi);
            while ($row1 = mysqli_fetch_array($ri, MYSQLI_ASSOC)) {
                require('../../models/cookiesUser.php');
            }
//If it dind't run OK...
        } else {
            include('../../models/error.php');
        }
        mysqli_close($dbc);
    }
}
?>
<div class="container-fluid">
    <div class="row col-md-8">
        <div class="page-header">
            <h1 class="worktitle">
                Change your password <?php echo $_COOKIE['Name'] ?>
            </h1>
        </div>
    </div>
    <div class="row labels col-md-12">
            <form role="form" action="" method="post">
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="passwordold">
                        Current Password
                    </label>
                    <input type="password" class="form-control" name='oldpass' id="oldpass">
                </div>
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="newpassword1">
                        New Password
                    </label>
                    <input type="password" class="form-control" name='newpass1' id="newpass1">
                </div>
                <div class="form-group col-md-2 col-md-offset-5">
                    <label for="Password2" >
                        Repeat New Password
                    </label>
                    <input type="password" class="form-control" name='newpass2' id="newpass2">
                </div>
                <div class="col-xs-2 col-xs-offset-5">
                    <button type="submit" name="submit" class="btn btn-danger">
                        Change Password
                    </button>
                </div>
            </form>
<?php
include('footer.html');
?>