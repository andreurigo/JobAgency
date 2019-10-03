<?php
setcookie('Cookies', 1, time()+2592000, '/');
setcookie('UserID', $userFound['UserID'], time()+31536000, '/');
setcookie('Phone', $userFound['Phone'], time()+31536000, '/');
setcookie('Name', $userFound['Name'], time()+31536000, '/');
setcookie('Email', $userFound['Email'], time()+31536000, '/');
setcookie('Password', $userFound['Password'], time()+31536000, '/');
session_start();
$_SESSION['name'] = $userFound['Name'];
$_SESSION['email'] = $userFound['Email'];

?>