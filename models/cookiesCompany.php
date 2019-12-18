<?php
setcookie("Cookies", 1, strtotime("+7 days"), "/");
setcookie("CompanyID", $companyFound["CompanyID"], strtotime("+7 days"), "/");
setcookie("Name", $companyFound["Name"], strtotime("+7 days"), "/");
setcookie("Email", $companyFound["Email"], strtotime("+7 days"), "/");
setcookie("Password", $companyFound["Password"], strtotime("+7 days"), "/");
session_start();

$_SESSION["name"] = $companyFound["Name"];
$_SESSION["email"] = $companyFound["Email"];
?>