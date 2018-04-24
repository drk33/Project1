<!DOCTYPE html>
<html>
<head>
<title>New Task</title>
<link href="css/login.css" rel="stylesheet">
</head>
<?php
if(isset($_POST['message'])) {
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
$message = ($_POST['message']);
$duedate = ($_POST['dueDate']);
$id = ($_GET['id']);
$qry = "update drk33.todos
             set message = :message, dueDate = :dueDate where id = :id;";

$stmnt = $db->prepare($qry);
$stmnt->bindValue(':dueDate',$duedate);
$stmnt->bindValue(':message', $message);
$stmnt->bindValue(':id', $id);
$stmnt->execute();
$stmnt->closeCursor(); 
echo 'Task successfully added, return to <a href="todo.php">list.</a>';
} else echo 'Please fill out the form'; ?>
<form class="form-signin" method="post" action="edit.php?id=<?php echo $_GET['id'];?>">
        <h2 class="form-signin-heading">Create a new task</h2>
        
        <label id="labelMessage" for="message"><b>Update description</b></label>
        <input type="text" id="inputMessage" class="form-control" placeholder="Update description" name="message" required />
        
        <label id="labelDueDate" for="dueDate"><b>Update due date</b></label>
        <input type="datetime-local" id="inputDueDate" class="form-control" name="dueDate" required />

        <br />
        <button type="submit" id="submitButton">Add Task</button>
      </form>