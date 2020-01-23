<?php 
include('headerUser.html');
//PHP code to (un)subscribe to Offers
//Unsubscribe
if ( (isset($_GET['Action'])) && (is_numeric($_GET['Action'])) ) {
    require ('../../models/mysqli_connect.php');
    $Action = $_GET['Action'];
    if ($Action == 1) {
        if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
            $id = $_GET['OfferID'];
            $q = "DELETE FROM usersoffers WHERE OfferID=".$id." and UserID=".$_COOKIE['UserID'];

            $r = @mysqli_query ($dbc, $q);

            if($r){
                include('../../models/success.php');
            } else {
                include('../../models/error.php');
            }
        }
//Subscribe
    } elseif($Action ==2){
        if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
            $id = $_GET['OfferID'];
            $q = "INSERT INTO usersoffers (UserID, OfferID) VALUES (".$_COOKIE['UserID'].", ".$id.")";
            $r = @mysqli_query ($dbc, $q);

            if($r){
                $q1 = "SELECT companies.Name, companies.Email, offers.Title from offers INNER JOIN companies ON offers.CompanyID = companies.CompanyID where offers.OfferID = ". $_GET['OfferID'];
                $r1 = @mysqli_query ($dbc, $q1);     
                $row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
//Send email to company to notify subscription
                $CompName = $row1['Name'];
                $CompMail = $row1['Email'];
                $offername = $row1['Title'];
                $user = $_COOKIE['Name'];
                $email = $_COOKIE['Email'];
                $phone = $_COOKIE['Phone'];
                $headers = "From: $email \r\n";
                
                $message = "Hello $CompName. \r\n The user $user has been inscribed in your $offername job offer.\r\n The user's telephone number is $phone and the e-mail on which you can contact with him is: $email \r\n Please, do not answer this email.";

                mail ($CompMail, "Inscription", $message, $headers);
                include('../../models/success.php');
            } else {
                include('../../models/error.php');
            }

        }
    } else {
        include('../../models/error.php');
    }
    mysqli_close($dbc);
} else {
   include('../../models/error.php'); 
}
include('footer.html');
?>