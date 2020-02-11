<?php 
include('headerCompanies.html');
require ('../../models/mysqli_connect.php');
//Get user stats
$q = "SELECT * FROM companies WHERE CompanyID=".$_COOKIE['CompanyID'];
$r = @mysqli_query ($dbc, $q);
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
//Show fields to update
echo '<h3 class="worktitle text-center">Update your profile</h3><br/>
        <form role="form" action="EditCompany.php" method="post">
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <input placeholder="Name" type="text" class="form-control" name="Name" id="Name" value="'; 
echo ($_COOKIE['Name']).'">';
echo        '</div>
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <input placeholder="Email" type="text" class="form-control" name="Email" id="Email" value="'; 
echo ($_COOKIE['Email']).'">
            </div>
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <button type="submit" class="btn btn-success">Update profile</button>
            </div>
        </form>';

//Update changed fields
if($_SERVER['REQUEST_METHOD'] == 'POST'){
//Update user
    $q1 = "UPDATE companies SET Name = '".$_POST['Name']."', Email = '".$_POST['Email']."' WHERE CompanyID=".$_COOKIE['CompanyID'];
    $r1 = @mysqli_query ($dbc, $q1);
    if($r1){
        include('../../models/success.php');      
    } else {
        include('../../models/error.php');
    }
}

mysqli_close($dbc);
include('footer.html');
?>