<!DOCTYPE html>
<html>
<head>
<title>New Task</title>
<link href="css/login.css" rel="stylesheet">
</head>
<?php
if(isset($_POST['message'])) {
session_start();
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

$owneremail = ($_SESSION['email']);
$ownerid = $_SESSION['id'];
$message = ($_POST['message']);
$duedate = ($_POST['dueDate']);
$isdone = 0;

$qry = "INSERT INTO drk33.todos
             (owneremail, ownerid, createddate, dueDate, message)
          VALUES
             (:owneremail, :ownerid, Current_Timestamp, :dueDate, :message);";

$stmnt = $db->prepare($qry);
$stmnt->bindValue(':owneremail', $owneremail);
$stmnt->bindValue(':ownerid', $ownerid);
$stmnt->bindValue(':dueDate',$duedate);
$stmnt->bindValue(':message', $message);
$stmnt->execute();
$stmnt->closeCursor(); 
echo 'Task successfully added, return to <a href="todo.php">list.</a>';
} else echo 'Please fill out the form'; ?>
<form class="form-signin" method="post" action="newtodo.php">
        <h2 class="form-signin-heading">Create a new task</h2>
        <label id="labelMessage" for="message"><b>Task description</b></label>
        <input type="text" id="inputMessage" class="form-control" placeholder="Enter message" name="message" required />
        
        <label id="labelDueDate" for="dueDate"><b>Due Date</b></label>
        <input type="datetime-local" id="inputDueDate" class="form-control" name="dueDate" required />

        <br />
        <button type="submit" id="submitButton">Add Task</button>
      </form>