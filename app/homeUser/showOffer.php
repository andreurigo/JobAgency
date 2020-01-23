<?php 
include('headerUser.html');
$check = false;
//Get Offer
if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
	require ('../../models/mysqli_connect.php');
    $id = $_GET['OfferID'];
    $q = "SELECT * FROM offers WHERE OfferID = ".$id;
    $r = @mysqli_query ($dbc, $q);
    $num = mysqli_num_rows($r);
    $check = true;
}
//If offer exists
    if($num > 0 && $check) {
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
//Get company name
            $q1 = "SELECT * FROM companies WHERE CompanyID = ".$row['CompanyID'];
            $r1 = @mysqli_query ($dbc, $q1);
            $row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
//Show offer info
            echo            '<h3 class="worktitle text-center">
                                Offer Information
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <table class="table-hover table">
                                <tr><th>Company</th><td><p class="details">'. $row1['Name'] .'</p></td></tr>
                                <tr><th>Title</th><td><p class="details">'. $row['Title'] .'</p></td></tr>
                                <tr><th>Category</th><td><p class="details">';
                                if ($row['Category'] == NULL) { echo 'Others';} else { echo $row['Category'];} 
            echo                '</p></td></tr>
				                <tr><th>Description</th><td></td><tr><td><p class="description">'. nl2br($row['Description']) .'</p></td><td></td></tr></tr></table><dd>';
            
//Check for inscription
            $qi = "SELECT * FROM usersoffers WHERE UserID = ".$_COOKIE['UserID']." AND OfferID = ".$row['OfferID']." LIMIT 1";
            $ri = mysqli_query ($dbc, $qi);
            $numi = mysqli_num_rows($ri);
            
            if ($numi == 0) {
                echo                '<a href="ActionOffer.php?Action=2&OfferID=' . $row['OfferID'] . '">
                                        <button type="button" class="btn btn-sm btn-warning">
                                            Inscript
                                        </button>
                                    </a>';
            } else {
                echo                '<button type="button" class="btn btn-sm btn-success">
                                            Inscribed
                                    </button>
                                    <a href="ActionOffer.php?Action=1&OfferID=' . $row['OfferID'] . '">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            Cancel Inscription
                                        </button>
                                    </a>';
            }                 
            echo               '</dd>
                    </div>';
        }
    } else {
        include('../../models/error.php');
    }
    mysqli_close($dbc);
include('footer.html');
?>