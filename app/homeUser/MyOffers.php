<?php 
include('headerUser.html');
//Get inscripted offers
require ('../../models/mysqli_connect.php');

$q = "SELECT offers.OfferID 
FROM usersoffers 
INNER JOIN offers 
ON usersoffers.OfferID = offers.OfferID 
WHERE usersoffers.UserID = '".$_COOKIE['UserID']."'";
$r = @mysqli_query ($dbc, $q);
$num = mysqli_num_rows($r);

//If there are such offers show them
if($num > 0){ 
    
    echo '<div class="container-fluid">
	        <div class="row">
		        <div class="col-md-10 col-md-offset-1">
			        <h3 class="text-center worktitle">';
	echo                $_COOKIE['Name']."'s Inscriptions";
	echo	        '</h3>
			        <table class="table-hover table">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $qi = "SELECT * FROM offers where OfferID =".$row['OfferID']." LIMIT 1";
        $ri = @mysqli_query ($dbc, $qi);
        while ($row1 = mysqli_fetch_array($ri, MYSQLI_ASSOC)) { 
            echo '<tr><th>Title<p class="details">'. $row1['Title'] .'</p></th></tr>
                  <tr><th>Category<p class="details">';
            if ($row1['Category'] == NULL) { echo 'Others';} else { echo $row1['Category'];} 
            echo '</p></th></tr>
				  <tr><th>Description<p class="description">'. nl2br($row1['Description']) .'</p></th></tr>
                  <tr><td><a href="ActionOffer.php?Action=1&OfferID=' . $row['OfferID'] . '">
                            <a href="showOffer.php?OfferID=' . $row['OfferID'] . '">
								<button type="button" class="btn btn-sm btn-primary">
									View offer
								</button>
							</a>
							<button type="button" class="btn btn-sm btn-danger">
								Cancel Inscription
							</button>
						</a></td></tr>';
        }
    }
    echo            '</table>
		        </div>
	        </div>
        </div>';
}
mysqli_close($dbc);
include('footer.html');
?>