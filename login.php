<?php
//Login form filled up
if ("POST" === $_SERVER["REQUEST_METHOD"]) { 
    //DB connection
    include "models/mysqli_connect.php";

    // Check if is a user
    $emailPost = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $passwordPost = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);

    $email = mysqli_real_escape_string($dbc, strip_tags($emailPost));
    $password = mysqli_real_escape_string($dbc, strip_tags($passwordPost));

    $findUserQuery = "SELECT UserID, Email, Phone, Name, Password FROM users WHERE Email = '$email' LIMIT 1";
    $findUserResult = @mysqli_query($dbc, $findUserQuery);

    $totalUsersFound = mysqli_num_rows($findUserResult);
    // User exists
    if (1 === $totalUsersFound) {
        $userFound = mysqli_fetch_assoc($findUserResult);
        if ($email === $userFound["Email"] && sha1($password) === $userFound["Password"]) {
            include 'models/cookiesUser.php';

            exit(header("location: app/homeUser/homeUser.php"));
        } else {
            $errorMsg = "<span class=\"text-center Incorrect\">Incorrect credentials.</span>";
        }
    } else {
        // Check if is a company
        $findCompanyQuery = "SELECT Email, Password FROM companies WHERE Email = '$email' LIMIT 1";
        $findCompanyResult = @mysqli_query($dbc, $findCompanyQuery);
        $totalCompaniesFound = mysqli_num_rows($findCompanyResult);

        //Company exists
        if (1 === $totalCompaniesFound) {
            $companyFound = mysqli_fetch_assoc($findCompanyResult);
            //obtenemos los valores de la query
            if ($email === $companyFound["email"] && sha1($password) === $companyFound["password"]) {
                include 'models/cookiesCompany.php';

                exit(header("location: app/homeCompanies/homeCompanies.php"));
            } else {
                $errorMsg = "<span class=\"text-center Incorrect\">Incorrect credentials.</span>";
            }
        } else {
            $errorMsg = "<span class=\"text-center Incorrect\">User or company not found.</span>"; 
        }
    }
} else {
    // Close DB connection
    mysqli_close($dbc); 
}
exit(header("Location: index.php?error_msg=$errorMsg"));
?>