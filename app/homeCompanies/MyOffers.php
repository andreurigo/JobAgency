<?php
include('headerCompanies.html');
require ('../../models/mysqli_connect.php');
//Check if it is a search
if (isset($_POST['Title'])) {
    if($_POST['Title'] != ''){
        $title = $_POST['Title'];
        $q = "SELECT * FROM offers WHERE CompanyID = ".$_COOKIE['CompanyID']." AND (Title LIKE '%".$title."%' OR Category LIKE '%".$title."%')";
        $r = @mysqli_query ($dbc, $q);
        $num = mysqli_num_rows($r);
//If it is an empty search
    }else{
        include('../../models/error.php');
        $num = 0;
    }
//If not a search get all offers
}else{
    $q = "SELECT * FROM offers WHERE CompanyID = '".$_COOKIE['CompanyID']."'";
    $r = @mysqli_query ($dbc, $q);
    $num = mysqli_num_rows($r);
}

//If offers exist create table
if($num > 0){ 
    
    echo '<div>
	        <div class="row">
		        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			        <h3 class="text-center worktitle">';
	echo                $_COOKIE['Name']."'s Offers";
	echo	        '</h3>
			        <table class="table table-hover">
				        <thead>
					        <tr>
						        <th>Title</th>
								<th>Category</th>
                                <th>Inscribed</th>
					        </tr>
				        </thead>
                       <tbody>';

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $qi = "SELECT COUNT(OfferID) AS Inscriptions FROM usersoffers where OfferID =".$row['OfferID']." LIMIT 1";
        $ri = @mysqli_query ($dbc, $qi);
        while ($row1 = mysqli_fetch_array($ri, MYSQLI_ASSOC)) { 

            echo '<tr role="button" data-href="Offer.php?OfferID=' . $row['OfferID'] . '">
                    <td>'.$row['Title'].'</td>
					<td>';
						if ($row['Category'] == NULL) { echo 'Others';} else { echo $row['Category'];};	
			echo	'</td>
				    <td>'.$row1['Inscriptions'].'</td>
			    </tr>';
        }
    }
    echo                '</tbody>
			        </table>
		        </div>
	        </div>
        </div>';
}
mysqli_close($dbc);
include('footer.php');
//JQuery code for clickable table fields
echo ' <script>
            $(function(){
                 $(".table").on("click", "tr[role=\"button\"]", function (e) {
                      window.location = $(this).data("href");
                 });
});
        </script>';
?>