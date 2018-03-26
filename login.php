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

$query = 'SELECT fName, lName 
          FROM drk33.accounts
          WHERE email = :email and password = :password;';

$count=mysql_fetch_array($result);

$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);
$statement->execute();
$accountinfo = $statement->fetchAll();
$statement->closeCursor(); 
if(count($accountinfo)>0){
  
?>

<html>
<head>
  <title>Post-Login</title>
</head>

<?php foreach ($accountinfo as $account) : ?>
<html>
<body>
<table style="width:100%, border: 1px solid black">
  <tr style="border: 1px solid black">
    <th style="text-align:left">First Name</th>
    <th style="text-align:left">Last Name</th>
  </tr>
  <tr style="border: 1px solid black">
    <td><?php echo $account['fName']; ?></td>
    <td><?php echo $account['lName']; ?></td>
  </tr>
</table>

<?php 
endforeach;
} else {
  echo 'Wrong Username or Password! Return to <a href="index.html">login</a>';
  }

?>