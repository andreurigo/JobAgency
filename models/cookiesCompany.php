<?php
setcookie('Cookies', 1, time() + 2592000, '/');
setcookie('CompanyID', $companyFound['CompanyID'], time() + 31536000, '/');
setcookie('Name', $companyFound['Name'], time() + 31536000, '/');
setcookie('Email', $companyFound['Email'], time() + 31536000, '/');
setcookie('Password', $companyFound['Password'], time() + 31536000, '/');
session_start();
$_SESSION['name'] = $companyFound['Name'];
$_SESSION['email'] = $companyFound['Email'];

?>