<?php
setcookie('Cookies', 1, time()+2592000, '/');
setcookie('UserID', $row1['UserID'], time()+31536000, '/');
setcookie('Phone', $row1['Phone'], time()+31536000, '/');
setcookie('Name', $row1['Name'], time()+31536000, '/');
setcookie('Email', $row1['Email'], time()+31536000, '/');
setcookie('Password', $row1['Password'], time()+31536000, '/');
session_start();
$_SESSION['name'] = $row1['Name'];
$_SESSION['email'] = $row1['Email'];

?>