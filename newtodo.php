<!DOCTYPE html>
<html>
<head>
<title>New Task</title>
<link href="css/login.css" rel="stylesheet">
</head>
<form class="form-signin" method="post" action="login.php">
        <h2 class="form-signin-heading">Create a new task</h2>
        <label id="labelMessage" for="message"><b>Task description</b></label>
        <input type="text" id="inputMessage" class="form-control" placeholder="Enter message" name="message" required />
        
        <label id="labelDueDate" for="dueDate"><b>Due Date</b></label>
        <input type="date" id="inputDueDate" class="form-control" name="dueDate" required />
        <br />
        <button type="submit" id="submitButton">Add Task</button>
      </form>