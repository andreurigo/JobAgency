<?php
require "headerUser.html";
require "../../models/mysqli_connect.php";

$check = false;

$postOfferId = filter_input(INPUT_GET, "OfferID", FILTER_VALIDATE_INT);
$cookieUserId = filter_input(INPUT_COOKIE, "UserID", FILTER_VALIDATE_INT);
//Get Offer
if (isset($postOfferId) && is_numeric($postOfferId)) {
    $offerId = mysqli_real_escape_string($dbc, $postOfferId);
    $offerQuery = "SELECT c.Name, o.Title, o.Category, o.Description, o.OfferID FROM offers AS o INNER JOIN companies AS c ON o.CompanyID = c.CompanyID WHERE o.OfferID = $offerId LIMIT 1";
    $offerResult = @mysqli_query($dbc, $offerQuery);
    $offerFound = (bool) mysqli_num_rows($offerResult);

    $check = true;
}
//If offer exists
if (true === $offerFound && true === $check) {
    $offer = mysqli_fetch_array($offerResult, MYSQLI_ASSOC);
?>
    <h3 class="worktitle text-center">Offer Information</h3>
    <div class="col-md-10 col-md-offset-1">
        <table class="table-hover table">
            <tr>
                <th>Company</th>
                <td>
                    <p class="details"><?php print($offer['Name']); ?></p>
                </td>
            </tr>
            <tr>
                <th>Title</th>
                <td>
                    <p class="details"><?php print($offer['Title']) ?></p>
                </td>
            </tr>
            <tr>
                <th>Category</th>
                <td>
                    <p class="details">
                        <?php print(!is_null($offer['Category']) ? $offer['Category'] : 'Others'); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td></td>
                <tr>
                    <td>
                        <p class="description"><?php print(nl2br($offer['Description'])) ?></p>
                    </td>
                    <td></td>
                </tr>
            </tr>
        </table>
        <dd>        
            <?php
            $userId = mysqli_real_escape_string($dbc, $cookieUserId);
            $checkInscriptionQuery = "SELECT * FROM usersoffers WHERE UserID = $userId AND OfferID = {$offer['OfferID']} LIMIT 1";
            $checkInscriptionResult = mysqli_query($dbc, $checkInscriptionQuery);
            $inscribed = (boolean) mysqli_num_rows($checkInscriptionResult);
                
            if (false === $inscribed) {
            ?>
                 <a href="ActionOffer.php?Action=2&OfferID=<?php print($row['OfferID']) ?>">
                    <button type="button" class="btn btn-sm btn-warning">
                        Inscript
                    </button>
                </a>';
            <?php
            } else {
            ?>
                <button type="button" class="btn btn-sm btn-success">
                    Inscribed
                </button>
                <a href="ActionOffer.php?Action=1&OfferID=<?php print($row['OfferID']) ?>">
                    <button type="button" class="btn btn-sm btn-danger">
                        Cancel Inscription
                    </button>
                </a>';
            <?php
            }
            ?>
        </dd>
    </div>
<?php
} else {
    include "../../models/error.php";
}
mysqli_close($dbc);
include "footer.php";
?>