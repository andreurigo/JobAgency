<?php
//Form filled up
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
//DB Connection
	require ('../../models/mysqli_connect.php');
    $class =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['class'])))); 
// Initialize an error array.
    $errors = array(); 
    
// Check for a first name:
    if (empty($_POST['name'])) {
        $errors[] = 'You forgot to enter your first name';
    } else {
        $name =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['name']))));
    }
    
 // Check for a password and match against the confirmed password:
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password';
        } else {
            $pass =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['pass1']))));
        }
    } else {
        $errors[] = 'You forgot to enter your password';
    }
    
// Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address';
    } elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $newemail =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['email'])))); 
    }else{
        $errors[] = 'Please enter a valid email address';
    }
    
// Check if it is a user
    if($class=='users'){
// Check for a phone:
        if (empty($_POST['phone'])) {
            $errors[] = 'You forgot to enter your phone';
        }else{
            $phone =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['phone']))));
            if(!preg_match("/^[6|7|9][0-9]{8}$/", $phone)) {$errors[] = 'Enter a valid phone number(666777888)';}
        }

// Check for studies:
        if (empty($_POST['study'])) {
            $errors[] = 'You forgot to enter your finished studies';
        } else {
            $study =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['study']))));
        }

// Check for a language:
        if (empty($_POST['languages'])) {
            $errors[] = 'You must enter at least one language and its level';
        } else {
            $language =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['languages']))));
        }

// Check for Work Experience:
        if (empty($_POST['laboral'])) {
            $errors[] = 'You forgot to enter your work experience';
        } else {
            $laboral =  mysqli_real_escape_string($dbc, trim(stripslashes(strip_tags($_POST['laboral']))));
        }
    }
        
// If everything's OK.
    if (empty($errors)) { 
// Check if user or company exists
        $q = "SELECT Email AS email FROM ".$class." WHERE Email='".$newemail."'";
        $query = mysqli_query ($dbc, $q);
        $num = mysqli_num_rows($query);

        if ($class == 'users'){$otherclass = 'companies';}else{$otherclass = 'users';}
        
        $q3 = "SELECT Email AS email FROM ".$otherclass." WHERE Email='".$newemail."'";
        $query3 = mysqli_query ($dbc, $q3);
        $num3 = mysqli_num_rows($query3);

// If not, Register the user in the database...
        if ($num == 0 && $num3 == 0)  {
            if ($class=='companies'){
                $q2 = "INSERT INTO `companies` (`Name`, `Email`, `Password`, `RegistrationDate`) VALUES ('$name', '$newemail', SHA1('$pass'), NOW())";
            }else{
                $q2 = "INSERT INTO `users`(`Name`, `Email`, `Password`, `Phone`, `Studies`, `WorkExp`, `Languages`, `RegistrationDate`) VALUES ( '$name', '$newemail', SHA1('$pass'), '$phone', '$study', '$laboral', '$language', NOW())";
            }
            $query2 = @mysqli_query($dbc,$q2);
            
// If it ran OK.
            if ($query2) { 
        
                $q4 = "SELECT * FROM ".$class." WHERE Email = '".$newemail."' LIMIT 1";
                $query4 = @mysqli_query($dbc,$q4);

                while ($row1 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
// Redirect to home page.
                    if ($class == 'companies') {
                        require ('../../models/cookiesCompany.php');
                        header("location: ../homeCompanies/homeCompanies.php");
                        exit;
                    } else {
                        require ('../../models/cookiesUser.php');
                        header("location: ../homeUser/homeUser.php");
                        exit;
                    } 
                }     
// If it did not run OK.
            } else {
// Error message:
                include('../../models/error.php');
            }
        }else{
//User or company already exists
            echo '<div class="row navbar-fixed-top">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">
                                
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    <strong>Warning!</strong> This email already exists.
                                </h4> 
                            </div>
                        </div>
                    </div>';
        }
        
// Close the database connection.
        mysqli_close($dbc); 
   
// Report the errors.
    }else { 
        $errorsString = '';
        foreach ($errors as $msg) {
            $errorsString = $errorsString.$msg.". ";
        }
        echo '<div class="row navbar-fixed-top">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">                   
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    <strong>Warning!</strong> '.$errorsString.'
                                </h4> 
                            </div>
                        </div>
                    </div>';
    } 
}
include("index.php");

?>