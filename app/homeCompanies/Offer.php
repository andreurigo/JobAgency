<?php 
include('headerCompanies.html');
//Get Offer info
$check = false;
if ( (isset($_GET['OfferID'])) && (is_numeric($_GET['OfferID'])) ) {
	require ('../../models/mysqli_connect.php');
    $id = $_GET['OfferID'];
    $q = "SELECT * FROM offers WHERE OfferID = ".$id;
    $r = @mysqli_query ($dbc, $q);
    $num = mysqli_num_rows($r);
    $check = true;
}
//If exists offer show info
    if($num > 0 && $check) {
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<div class="offer container-fluid">
                    <div class="row col-md-5 col-md-offset-1">
                            <h3 class="worktitle text-center">
                                Offer Information
                            </h3>
                            <dl><br>
                                <dt>
                                    Title
                                </dt>
                                <dd>';
            echo                      $row['Title'].'
                                </dd><br>
                                <dt>
                                    Category
                                </dt>
                                <dd>';
                                    if ($row['Category'] == NULL) { echo 'Others';} else { echo $row['Category'];};
            echo                '</br></br></dd>
                                <dt>
                                    Description </br>
                                </dt>
                                <dd>';
            echo                     nl2br($row['Description']).'
                                </br></br></dd>
                                <dt>
                                    Actions </br>
                                </dt>
                                <dd>
                                </br>
                                    <a href="NewOffer.php?Action=2&OfferID=' . $row['OfferID'] . '">
                                        <button type="button" class="btn btn-lg btn-info">
                                            Edit Offer
                                        </button>
                                    </a></br></br>
                                    <a href="ActionOffer.php?Action=3&OfferID=' . $row['OfferID'] . '">
                                        <button type="button" class="btn btn-lg btn-danger">
                                            Remove Offer
                                        </button>
                                    </a>
                                </dd>
                            </dl>
                        </div>
                            
                        <div class="col-md-6">
                            <h3 class="text-center worktitle">
                                Inscriptions
                            </h3>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>';
//Get inscripted Users
                $qi = "SELECT users.UserID, users.Name
                FROM users 
                INNER JOIN 
                usersoffers 
                ON users.UserID = usersoffers.UserID 
                WHERE usersoffers.OfferID =".$row['OfferID'];

                $ri = @mysqli_query ($dbc, $qi);
                $num1 = mysqli_num_rows($ri);
//Show users
                if ($num1 > 0) {
                    while ($row1 = mysqli_fetch_array($ri, MYSQLI_ASSOC)) {
                        echo '<tr role="button" data-href="User.php?UserID=' . $row1['UserID'] . '">
                                <td>'.$row1['Name'].'</td>
                              </tr>';
                    }
//Show no inscriptions message
                } else {
                    echo '<tr>
                            <td>
                                No inscriptions
                            </td>
                         </tr>';
                }
                echo                '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
        }
    } else {
//Show errors
        include('../../models/error.php');
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