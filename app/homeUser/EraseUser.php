<?php 
include('headerUser.html');
require ('../../models/mysqli_connect.php');
//Show confirmation
echo '<form role="form" action="EraseUser.php" method="post">
            <div class="labels col-md-6 col-md-offset-3 col-xs-12">
                <h2>Are you sure you want to erase this profile?</h2>
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <button id="yes" type="submit" class="btn btn-default" >Yes</button>
                <a class="btn btn-default" value="Go back home" href="homeUser.php" />No</a>
            </div>
        </form>';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
//Erase user from inscribed offers
    $q = "DELETE FROM usersoffers WHERE UserID=".$_COOKIE['UserID'];
    $r = @mysqli_query ($dbc, $q);
//Erase user
    $q1 = "DELETE FROM users WHERE UserID=".$_COOKIE['UserID'];
    $r1 = @mysqli_query ($dbc, $q1);
//If user was erased...
    if($r && $r1){
        echo '<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissable alert-success">

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                ×
                            </button>
                            <h4>
                                Alert!
                            </h4> <strong>Success!</strong> Everything has gone fine. <a href="../login/index.html" class="alert-link">Go Home</a>
                        </div>
                    </div>
                </div>
            </div>';     
//If user was NOT erased
    } else {
        include('../../models/error.php');
    }
}

mysqli_close($dbc);
include('footer.php');
?>