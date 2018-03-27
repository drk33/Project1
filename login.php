<?php
$dsn = 'mysql:host=mysql01.ucs.njit.edu;dbname=drk33';
$username = 'drk33';
$pwd = 'uDV0XQgv';
  
try {
    $db = new PDO($dsn, $username, $pwd);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>An error occurred while connecting to
             the database: $error_message </p>" . "<br>";
}

$email=($_POST['email']);
$password=($_POST['password']);

$query = 'SELECT fName, lName, password
          FROM drk33.accounts
          WHERE email = :email;';

$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->execute();
$accountinfo = $statement->fetch();
$statement->closeCursor(); 
if (count($accountinfo) > 1) {
  
if ($password == $accountinfo['password']) { 
  echo $accountinfo['fName'] . ' ' . $accountinfo['lName'];
} elseif ($password != $accountinfo['password']) {
  echo 'Password is incorrect. <a href="index.html">Try again</a>'; }
  else {
  echo 'An error has occurred. <a href="index.html">Please try again</a>'; }}
  else {
  echo 'Account does not exist. <a href="index.html">Try signing up</a>'; }
  ?>