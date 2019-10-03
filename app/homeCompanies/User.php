<?php 
include('headerCompanies.html');
$check = false;
//Get User
if ( isset($_GET['UserID']) ) {
	require ('../../models/mysqli_connect.php');
    $UserID = $_GET['UserID'];
    $q = "SELECT * FROM users WHERE UserID = ".$UserID;
    $r = @mysqli_query ($dbc, $q);
    $num = mysqli_num_rows($r);
    $check = true;
    
} else { header("Location: {$_SERVER['HTTP_REFERER']}");}

//Show User info
    if($num > 0 && $check) {
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<div class="offer container-fluid">
                    <div class="row col-md-5 col-md-offset-1">
                            <h3 class="worktitle text-center">
                                User Information
                            </h3>
                            <dl><br>
                                <dt>
                                    Name
                                </dt>
                                <dd>';
            echo                    $row['Name'].'
                                </dd></br>
                                <dt>
                                    Phone 
                                </dt>
                               <dd>';
            echo                    $row['Phone'].'
                                </br></br></dd>
                                <dt>
                                    Email </br>
                                </dt>
                                <dd>';
            echo                    $row['Email'].'
                                </br></br></dd>
                                <dt>
                                    Studies </br>
                                </dt>
                                <dd>';
            echo                    nl2br($row['Studies']).'
                                </br></br></dd>
                                <dt>
                                    Work Experience </br>
                                </dt>
                                <dd>';
            echo                    nl2br($row['WorkExp']).'
                                </br></br></dd>
                                <dt>
                                    Languages </br>
                                </dt>
                                <dd>';
            echo                    nl2br($row['Languages']).'
                                </br></br></dd>
                                <dt>
                                    Registration Date </br>
                                </dt>
                                <dd>';
            echo                    $row['RegistrationDate'].'
                                </br></br></dd>
                                  
                            </dl>
                    </div>';
        }
    } else {
//Error message
        include('../../models/error.php');
    }
mysqli_close($dbc);
include('footer.php');
?>