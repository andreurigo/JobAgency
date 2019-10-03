<?php 
include('headerCompanies.html');
require ('../../models/mysqli_connect.php');
//Get number of offers and inscriptions
$q = "SELECT count(OfferID) as Count FROM offers WHERE CompanyID = '".$_COOKIE['CompanyID']."'";
$qI = "SELECT count(UserID) as CountI FROM usersoffers INNER JOIN offers ON offers.OfferID = usersoffers.OfferID WHERE CompanyID = '".$_COOKIE['CompanyID']."'";
$r = @mysqli_query ($dbc, $q);
$rI = @mysqli_query ($dbc, $qI);
$num = mysqli_num_rows($r);
$numI = mysqli_num_rows($rI);

if ($numI > 0) {
    while ($rowI = mysqli_fetch_array($rI, MYSQLI_ASSOC)) {
        $countI = $rowI['CountI'];
    }
}
if ($num > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $count = $row['Count'];
    }
}
//Get registration date
$q1 = "SELECT * FROM companies WHERE CompanyID = '".$_COOKIE['CompanyID']."'";
$r1 = @mysqli_query ($dbc, $q1);
$num1 = mysqli_num_rows($r1);
if ($num1 > 0) {
    while ($row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
        $register=$row1['RegistrationDate'];
    }
}
mysqli_close($dbc);
?>
<!--Profile page-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1 class="welcome text-center">
                Welcome <?php echo $_COOKIE['Name'].'!'; ?>
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
				<?php echo $count; ?>
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
				<?php echo $countI; ?>
			</h1>
		</div>
	</div>
	<div class="allprofile row">
		<div class="col-md-12">
			<h2 class="profile text-center">
				Profile
			</h2>
			<h2 class="text-center">
				Email: <?php echo $_COOKIE['Email']; ?>
			</h2>
			<h2 class="text-center">
                Registered: <?php echo $register; ?>
			</h2>
			<h2 class="text-center">
				<a class="eraseuser" href="EditCompany.php">Edit Profile</a><br><br>
				<a class="eraseuser" href="EraseCompany.php">Erase Profile</a>
			</h2>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>