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

$fName = ($_POST['reg_fName']);
$lName = ($_POST['reg_lName']);
$email = ($_POST['reg_email']);
$bday = ($_POST['reg_bday']);
$gender = ($_POST['reg_gender']);
$phone = ($_POST['reg_phone']);
$password = ($_POST['reg_password']);

$query = "INSERT INTO drk33.accounts
             (fName, lName, email, birthday, gender, phone, password)
          VALUES
             (:fName, :lName, :email, :birthday, :gender, :phone, :password)";

$statement = $db->prepare($query);
$statement->bindValue(':fName', $fName);
$statement->bindValue(':lName', $lName);
$statement->bindValue(':email', $email);
$statement->bindValue(':birthday',$bday);
$statement->bindValue(':gender', $gender);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':password', $password);
$statement->execute();
$statement->closeCursor();
