<?php
$documentRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_DEFAULT);

require "$documentRoot/app/homeCompanies/headerCompanies.html";
require "$documentRoot/models/mysqli_connect.php";

//Cookies data
$companyId = filter_input(INPUT_COOKIE, "CompanyID", FILTER_VALIDATE_INT);
$name = filter_input(INPUT_COOKIE, "Name", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_COOKIE, "Email", FILTER_VALIDATE_EMAIL);

//Get number of offers and inscriptions
$totalOffersQuery = "SELECT COUNT(OfferID) AS count FROM offers WHERE CompanyID = $companyId";
$totalSuscribersQuery = "SELECT COUNT(UserID) AS count FROM usersoffers INNER JOIN offers ON offers.OfferID = usersoffers.OfferID WHERE CompanyID = $companyId";

$totalOffers = mysqli_query($dbc, $totalOffersQuery);
$totalSuscribers = mysqli_query($dbc, $totalSuscribersQuery);

$totalOffersQty = mysqli_num_rows($totalOffers);
$totalSuscribersQty = mysqli_num_rows($totalSuscribers);

$offersCount = 0;
if ($totalOffersQty > 0) {
    $offers = mysqli_fetch_assoc($totalOffers);
    $offersCount += $offers["count"];
}

$suscribersCount = 0;
if ($totalSuscribersQty > 0) {
    $suscribers = mysqli_fetch_assoc($totalSuscribers);
    $suscribersCount += $suscribersCount["count"];
}
//Get registration date
$currentCompanyQuery = "SELECT * FROM companies WHERE CompanyID = $companyId";
$currentCompany = mysqli_query($dbc, $currentCompanyQuery);
$currentCompanyQty = mysqli_num_rows($currentCompany);
if ($currentCompanyQty > 0) {
    $currentCompany = mysqli_fetch_assoc($currentCompany);
    $createdAt = $currentCompany['RegistrationDate'];
}
mysqli_close($dbc);
?>
<!--Profile page-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="welcome text-center">
                Welcome <?php print($name ?? null); ?>!
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 class="inscriptions text-center">
                Active Offers:
            </h3>
        </div>
        <div class="col-md-4">
            <h1 class="numoffers text-center text-success">
                <?php print($offersCount ?? null); ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 class="inscriptions text-center">
                Inscriptions:
            </h3>
        </div>
        <div class="col-md-4">
            <h1 class="numoffers text-center text-success">
                <?php print($suscribersCount ?? null); ?>
            </h1>
        </div>
    </div>
    <div class="allprofile row">
        <div class="col-md-12">
            <h2 class="profile text-center">
                Profile
            </h2>
            <h2 class="text-center">
                Email: <?php print($email ?? null); ?>
            </h2>
            <h2 class="text-center">
                Registered: <?php print($createdAt ?? null); ?>
            </h2>
            <h2 class="text-center">
                <a class="eraseuser" href="EditCompany.php">Edit Profile</a><br><br>
                <a class="eraseuser" href="EraseCompany.php">Erase Profile</a>
            </h2>
        </div>
    </div>
</div>
<?php
include("$documentRoot/app/homeCompanies/footer.php");
?>