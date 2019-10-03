<?php 
require "headerUser.html";
require "../../models/mysqli_connect.php";
//Check if it is a search

$postTitle = filter_input(INPUT_POST, "Title", FILTER_SANITIZE_STRING);
$cookieUserId = filter_input(INPUT_COOKIE, "UserID", FILTER_VALIDATE_INT);
if (isset($postTitle)) {
    if (strlen($postTitle) > 0) {
        $title = mysqli_real_escape_string($dbc, $postTitle);
        $offersQuery = "SELECT o.Title, o.Category, o.Description, o.OfferID, c.Name, o.created_at FROM offers AS o INNER JOIN companies AS c ON o.CompanyID = c.CompanyID WHERE o.Title LIKE '%$title%' OR o.Category LIKE '%$title%'";
        $offersResult = @mysqli_query($dbc, $offersQuery);
        $totalOffers = mysqli_num_rows($offersResult);
    } else {
        include "../../models/error.php";
        $totalOffers = 0;
    }
    //If not a search get all offers
} else {
    $offersQuery = "SELECT o.Title, o.Category, o.Description, o.OfferID, c.Name, o.created_at FROM offers AS o INNER JOIN companies AS C ON o.CompanyID = c.CompanyID ORDER BY o.created_at DESC";
    $offersResult = @mysqli_query($dbc, $offersQuery);
    $totalOffers = mysqli_num_rows($offersResult);
}

if ($totalOffers > 0) {
    $offers = mysqli_fetch_all($offersResult, MYSQLI_ASSOC);
?>
    <div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <h3 class="text-center worktitle">Work Offers</h3>
                <table class="table table-hover">
                    <thead>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>Created at</th>
                    </thead>
                    <tbody>
                        <?php    
                        foreach ($offers as $offer) {
                            $inscriptionCheckerQuery= "SELECT * FROM usersoffers WHERE OfferID = {$offer['OfferID']} AND UserID = $cookieUserId LIMIT 1";
                            $inscriptionCheckerResult = @mysqli_query($dbc, $inscriptionCheckerQuery);
                            // Count the number of returned rows:
                            $inscribed = (bool) mysqli_num_rows($inscriptionCheckerResult);
                        ?>
                            <tr role="button" data-href="showOffer.php?OfferID=<?php print($offer['OfferID']); ?>">
                            <th>
                                <p style="<?php print($inscribed === true ? 'color:gray' : null) ?>" class="details">
                                    <?php print($offer['Title']) ?>
                                </p>
                            </th>
                            <th>
                                <p class="description"><?php print($offer['Name']) ?></p>
                            </th>
                            <th>
                                <p class="description">
                                    <?php print(!is_null($offer['Category']) ? $offer['Category'] : 'Others') ?>
                                </p>
                            </th>
                            <th>
                                <p class="description">
                                    <?php print($offer['created_at']) ?>
                                </p>
                            </th>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
}
mysqli_close($dbc);
require "footer.php";
?>
<script>
    $(
        function(){
            $(".table").on(
                "click", "tr[role='button']", function (e) {
                    window.location = $(this).data("href");
                }
            );
        }
    );
</script>
