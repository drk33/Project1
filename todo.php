<?php
session_start();
echo 'Welcome ' . $_SESSION['fName'] . ' ' . $_SESSION['lName'] . '!';
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
$email = $_SESSION['email'];
$qry = 'SELECT message, id, duedate
          FROM drk33.todos
          WHERE owneremail = :email && isdone = 0 order by duedate asc;';
$smt = $db->prepare($qry);
$smt->bindValue(':email', $email);
$smt->execute();
$todoinfo = $smt->fetchAll();
$smt->closeCursor(); 
?>

<html>
<head>
  <style>
  table{
  border: 1px solid black;
  border-collapse: collapse;}
  table {width: 50%}

  th{
  border-bottom: 1px solid black;
  border-collapse: collapse;}
  table {width: 50%}
  
  td{
  border-collapse: collapse;}
  table {width: 50%}
  th, td {
  padding: 15px;
  text-align: center;
  }
  </style>
  
    <title>To-Do List</title>
    <link href="css/login.css" rel="stylesheet">
</head>
<table>
  <tr>
    <th>To-do</th>
    <th>ID</th>
    <th>Due Date</th>
    <th></th> 
    <th></th> 
    <th><button type="button" onclick="location.href = 'newtodo.php';" id="add_btn" class="add_btn">Add Task</button></th>
  </tr>
<?php foreach ($todoinfo as $todo) : ?>
<html>
<body>
  <tr>
    <td><?php echo $todo['message']; ?></td>
    <td><?php echo $todo['id']; ?></td>
    <td><?php echo $todo['duedate']; ?></td>
    <td><button type="button" onclick="location.href = 'edit.php';" id="edit_btn" class="edit_btn">Edit</button></td>
    <td><button type="button" onclick="location.href = 'complete.php';" id="complete_btn" class="complete_btn">Completed</button></td>
    <td><button type="button" onclick="location.href = 'delete.php';" id="delete_btn" class="delete_btn">Delete</button></td>
  </tr>

<?php endforeach;
$qry = 'SELECT message
          FROM drk33.todos
          WHERE owneremail = :email && isdone = 1 order by duedate asc;';
$smt = $db->prepare($qry);
$smt->bindValue(':email', $email);
$smt->execute();
$todofinished = $smt->fetchAll();
$smt->closeCursor(); 
?> 
<html>
</table>
<table>
  <tr>
    <th></th> 
    <th>Completed</th>
    <th></th>
  </tr>
<?php foreach ($todofinished as $todo) : ?>
<html>
<body>
  <tr>
    <td><?php echo $todo['message']; ?></td>
    <td></td>
    <td><button type="button" onclick="location.href = 'delete.php';" id="delete_btn" class="delete_btn">Delete</button></td>
  </tr>
  <?php endforeach; ?>

