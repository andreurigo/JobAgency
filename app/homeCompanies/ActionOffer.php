<?php
require "$documentRoot/app/homeCompanies/headerCompanies.html";
$actionType =  filter_input(INPUT_POST, "Action", FILTER_VALIDATE_INT);
if (isset($actionType) && is_numeric($actionType)) {
    //PHP code to create/update/delete Offers
    include "../../models/mysqli_connect.php";
    //Create offer
    if ($actionType === 1) {
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, "cateogry", FILTER_SANITIZE_STRING);
        //Check fields
        if (!(empty(trim($_GET['title']))) && !(empty(trim($_GET['description'])))) {
            if ($category == 'NULL') {
                $category = NULL;
            }
            $q = "INSERT INTO offers (Title, Category, Description, CompanyID) VALUES ('".$title."','".$category."','".$description."',".$_COOKIE['CompanyID'].")";

            $r = @mysqli_query ($dbc, $q);

            if($r){
                include('../../models/success.php');
            } else {
                include('../../models/error.php');
            }
        } else {
//If empty fields...
            if (!((empty(trim($_GET['title']))))) {
                $title = $_GET['title'];
                $href = 'NewOffer.php?Title='.$title;
            } elseif (!((empty(trim($_GET['description']))))) {
                $description = $_GET['description'];
                $href = 'NewOffer.php?Description='.$description;
            } else {
                $href = 'NewOffer.php';
            }
            echo '<div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">
                                
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    Error!
                                </h4> <strong>Warning!</strong> Missing data. <a href="'.$href.'" class="alert-link">Return</a>
                            </div>
                        </div>
                    </div>';
        }
    } 
//Update offer
    elseif ($Action == 2) {
        if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
            $id = $_GET['OfferID'];
            if (!(empty(trim($_GET['title']))) && !(empty(trim($_GET['description'])))) {
            $title = $_GET['title'];
            $description = $_GET['description'];
            $category = $_GET['category'];
            if ($category == 'NULL') {
                $category = NULL;
            }
            $q = "UPDATE offers SET Title='".$title."', Description='".$description."', Category='".$category."' WHERE OfferID=".$id;
            $r = @mysqli_query ($dbc, $q);

            if($r){
                include('../../models/success.php');
            } else {
                include('../../models/error.php');
            }
        } else {
//If empty fields...
            if (!((empty(trim($_GET['title']))))) {
                $title = $_GET['title'];
                $href = 'NewOffer.php?Action=2&OfferID='.$id.'Title='.$title;
            } elseif (!((empty(trim($_GET['description']))))) {
                $description = $_GET['description'];
                $href = 'NewOffer.php?Action=2&OfferID='.$id.'Description='.$description;
            } else {
                $href = 'NewOffer.php?Action=2&OfferID='.$id;
            }
            echo '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-danger">
                                
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <h4>
                                    Error!
                                </h4> <strong>Warning!</strong> Missing data. <a href="'.$href.'" class="alert-link">Return</a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        }
    } 
//Delete Offer
    elseif ($Action == 3) {
        if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
            $id = $_GET['OfferID'];
            $q = "DELETE FROM usersoffers WHERE OfferID=".$id;

            $r = @mysqli_query ($dbc, $q);

            if($r){
                $q1 = "DELETE FROM offers WHERE OfferID=".$id;

                $r1 = @mysqli_query ($dbc, $q1);

                if($r1){
                    include('../../models/success.php');
                } else {
                    include('../../models/error.php'); 
                }
            }
        }
    } else {
        include('../../models/error.php');
    }
    mysqli_close($dbc);
} else {
   include('../../models/error.php'); 
}
include('footer.php');
?>