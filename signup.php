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

$fName = ($_POST['reg_fname']);
$lName = ($_POST['reg_lname']);
$email = ($_POST['reg_email']);
$bday = ($_POST['reg_bday']);
$gender = ($_POST['reg_gender']);
$phone = ($_POST['reg_phone']);
$password = ($_POST['reg_password']);

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
$statement->bindValue(':fname', $fName);
$statement->bindValue(':lname', $lName);
$statement->bindValue(':email', $email);
$statement->bindValue(':birthday',$bday);
$statement->bindValue(':gender', $gender);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':password', $password);
$statement->execute();
$statement->closeCursor();
echo 'Account successfully created';
}
?>