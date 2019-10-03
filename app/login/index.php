<?php
//Login form filled up
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
//DB connection
	require ('../../models/mysqli_connect.php'); 
// Check if it a user
	$q = "SELECT Email AS email, Password AS password FROM users WHERE Email = '".$_POST['email']."' LIMIT 1";
	$r = @mysqli_query ($dbc, $q);
	$num = mysqli_num_rows($r);
    
// User exists
	if($num == 1){
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			if ($_POST['email'] == $row['email'] && sha1($_POST['pass']) == $row['password']){
				$q = "SELECT * FROM users where Email='".$row['email']."' LIMIT 1";
				$r = @mysqli_query ($dbc, $q);

				while ($row1 = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					require ('../../models/cookiesUser.php');
					header("location: ../homeUser/homeUser.php");
					exit;
				}
			} else {
// User does not exist
				echo '<div class="row navbar-fixed-top" >
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">                   
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
									<strong>Warning!</strong> Incorrect Credentials
                                </h4> 
                            </div>
                        </div>
                    </div>';
			}
		}
	} else {
// Check if it a company
		$q = "SELECT Email AS email, Password AS password FROM companies WHERE Email = '".$_POST['email']."' LIMIT 1";
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows($r);
//Company exists
		if($num == 1){
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) { //obtenemos los valores de la query
				if ($_POST['email'] == $row['email'] && sha1($_POST['pass']) == $row['password']){
					$q = "SELECT * FROM companies where Email='".$row['email']."' LIMIT 1";
					$r = @mysqli_query ($dbc, $q);
					while ($row1 = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
						require ('../../models/cookiesCompany.php');
						header("location: ../homeCompanies/homeCompanies.php");
						exit;
					}
				} else {
					echo '<span class=" text-center Incorrect">Incorrect credentials</span>';
				}
			}
		}else{
//Company does not exist
			echo '<div class="row navbar-fixed-top" >
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">                   
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
									<strong>Warning!</strong> Incorrect Credentials
                                </h4> 
                            </div>
                        </div>
                    </div>';
		}
	}
// Close DB connection
	mysqli_close($dbc); 
}
include("index.html");

?>