<?php 
include('headerUser.html');
require ('../../models/mysqli_connect.php');
//Check if it is a search
if (isset($_POST['Title'])) {
    if($_POST['Title'] != ''){
        $title = $_POST['Title'];
        $q = "SELECT offers.Title, offers.Category, offers.Description, offers.OfferID, offers.created_at, companies.Name FROM offers INNER JOIN companies on offers.CompanyID = companies.CompanyID WHERE offers.Title LIKE '%".$title."%' OR offers.Category LIKE '%".$title."%'";
        $r = @mysqli_query ($dbc, $q);
        $num = mysqli_num_rows($r);
//If it's an empty search..
    }else{
        include('../../models/error.php');
        $num = 0;
    }
//If not a search get all offers
}else{
    $q = "SELECT offers.Title, offers.Category, offers.Description, offers.OfferID, offers.created_at, companies.Name FROM offers INNER JOIN companies on offers.CompanyID = companies.CompanyID ORDER BY OfferID DESC";
    $r = @mysqli_query ($dbc, $q);
    $num = mysqli_num_rows($r);
}

//Show offers
if($num > 0){ 
    
    echo '<div">
	        <div class="row">
		        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			        <h3 class="text-center worktitle">';
	echo               "Work Offers";
	echo	        '</h3>
			        <table class="table table-hover">
                        <thead>
                            <th> Title </th>
                            <th> Company </th>
                            <th> Category </th>
                            <th> Created at </th>
                        </thead>
                        <tbody>';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$qi = "SELECT * FROM usersoffers WHERE OfferID = ".$row['OfferID']." AND UserID = ".$_COOKIE['UserID']." LIMIT 1";
		$ri = @mysqli_query ($dbc, $qi);
		// Count the number of returned rows:
		$num1 = mysqli_num_rows($ri);
		if($num1 == 1){
			$inscribed = true;
		} else {
			$inscribed = false;
		}
			echo '<tr role="button" data-href="showOffer.php?OfferID=' . $row['OfferID'] . '">
                    <th><p'; 
                        if($inscribed){ echo ' style="color:gray" ';} 
            echo ' class="details">'.$row['Title'].'</p></th>
                    <th><p class="description">'.$row['Name'].'</p></th>
                    <th><p class="description">';
                        if ($row['Category'] == NULL) { echo 'Others</td>';} else { echo $row['Category'].'
                    </p></th>';};
            echo'<th><p class="description">'.$row['created_at'].'</p></th> </tr>';
    }
    echo                '
                        </tbody>
			        </table>
		        </div>
	        </div>
        </div>';
}


mysqli_close($dbc);
include('footer.html');
//JQuery code for selectable table fields
echo ' <script>
            $(function(){
                 $(".table").on("click", "tr[role=\"button\"]", function (e) {
                      window.location = $(this).data("href");
                 });
});
        </script>';
?>