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

$reg_fname = ($_POST['reg_fname']);
$reg_lname = ($_POST['reg_lname']);
$reg_email = ($_POST['reg_email']);
$reg_birthday = ($_POST['reg_birthday']);
$reg_gender = ($_POST['reg_gender']);
$reg_phone = ($_POST['reg_phone']);
$reg_password = ($_POST['reg_password']);

echo $fName;

$query = 'SELECT fName, lName, password
          FROM drk33.accounts
          WHERE email = :email;';

$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->execute();
$accountinfo = $statement->fetch();
$statement->closeCursor(); 

if (in_array($email, $accountinfo)) {
echo 'Email already in database, <a href="index.html">try again with a different email</a>';
}
else {

$query = "INSERT INTO drk33.accounts
             (fname, lname, email, birthday, gender, phone, password)
          VALUES
             (:fname, :lname, :email, :birthday, :gender, :phone, :password)";

$statement = $db->prepare($query);
$statement->bindValue(':fname', $reg_fname);
$statement->bindValue(':lname', $reg_lname);
$statement->bindValue(':email', $reg_email);
$statement->bindValue(':birthday',$reg_birthday);
$statement->bindValue(':gender', $reg_gender);
$statement->bindValue(':phone', $reg_phone);
$statement->bindValue(':password', $reg_password);
$statement->execute();
$statement->closeCursor();
echo 'Account successfully created';
}
?>