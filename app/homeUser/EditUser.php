<?php 
include('headerUser.html');
require ('../../models/mysqli_connect.php');
//Get user info
$q = "SELECT * FROM users WHERE UserID=".$_COOKIE['UserID'];
$r = @mysqli_query ($dbc, $q);
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
//Show fields to update
echo '<h3 class="worktitle text-center">Update your profile</h3><br>
        <form role="form" action="EditUser.php" method="post">
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <input placeholder="Name" type="text" class="form-control" name="Name" id="Name" value="'; 
echo ($_COOKIE['Name']).'">';
echo        '</div>
            <div id="phone" class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <input placeholder="Phone" type="text" class="form-control" name="Phone" id="phone" value="'; 
echo ($_COOKIE['Phone']).'">';
echo        '</div>
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <input placeholder="Email" type="text" class="form-control" name="Email" id="Email" value="'; 
echo ($_COOKIE['Email']).'">';
echo        '</div>
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <textarea placeholder="Finished Studies" type="text" class="form-control" name="Study" id="study">';
echo ($row['Studies']).'</textarea>';
echo        '</div>
            <div id="languages" class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <textarea placeholder="Languages" type="text" class="form-control" name="Languages" id="languages">';
echo ($row['Languages']).'</textarea>';
echo        '</div>
            <div id="laboral" class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <textarea placeholder="Work Experience" type="text" class="form-control" name="WorkExp" id="laboral">';
echo ($row['WorkExp']).'</textarea>';
//Submit button
echo        '</div>
            <div class="form-group col-md-5 col-md-offset-4 col-sm-12">
                <button type="submit" class="btn btn-success">Update profile</button>
            </div>
        </form>';

//Update changed fields
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $q1 = "UPDATE users SET Name = '".$_POST['Name']."', Phone = ".$_POST['Phone'].", Email = '".$_POST['Email']."', Studies = '".$_POST['Study']."', Languages = '".$_POST['Languages']."', WorkExp = '".$_POST['WorkExp']."'  WHERE UserID=".$_COOKIE['UserID'];
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