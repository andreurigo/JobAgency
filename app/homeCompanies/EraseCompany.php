<?php 
include('headerCompanies.html');
require ('../../models/mysqli_connect.php');
//Confirmation
echo '<form role="form" action="EraseCompany.php" method="post">
            <div class="labels col-md-6 col-md-offset-3 col-xs-12">
                <h2>Are you sure you want to erase this profile?</h2>
            </div>
            <div class="form-group col-md-2 col-md-offset-5 col-xs-7 col-xs-offset-3">
                <button id="yes" type="submit" class="btn btn-default">Yes</button>
                <a class="btn btn-default" value="Go back home" href="homeCompanies.php" />No</a>
            </div>
        </form>';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
//Erase inscriptions
    $q = "SELECT * FROM offers WHERE CompanyID = '".$_COOKIE['CompanyID']."'";
    $r = @mysqli_query ($dbc, $q);
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $DelQuery = "DELETE FROM usersoffers WHERE OfferID = ".$row['OfferID'];
        $DelResult = @mysqli_query ($dbc, $DelQuery);
    }
//Erase offers
    $q1= "DELETE FROM offers WHERE CompanyID=".$_COOKIE['CompanyID'];
    $r1 = @mysqli_query ($dbc, $q1);
//Erase company
    $q2 = "DELETE FROM companies WHERE CompanyID=".$_COOKIE['CompanyID'];
    $r2 = @mysqli_query ($dbc, $q2);
//Success alert
    if($r && $r1 && $r2){
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
    } else {
//Error alert
        include('../../models/error.php');
    }
}
//Close DB
mysqli_close($dbc);
include('footer.html');
?>