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

$id = ($_GET['id']);
$qry = "delete from drk33.todos
             where id = :id;";

$stmnt = $db->prepare($qry);
$stmnt->bindValue(':id', $id);
$stmnt->execute();
$stmnt->closeCursor(); 
header ('location: todo.php');
?>