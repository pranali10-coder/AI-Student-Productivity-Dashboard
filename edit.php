<!-- Pranali R More -->
<?php
include 'db.php';
$id = $_GET['id'];
$data = mysqli_query($conn,
"SELECT * FROM tasks WHERE id=$id");
$row = mysqli_fetch_assoc($data);
if(isset($_POST['update']))
{
    $name = $_POST['student_name'];
    $task = $_POST['task_title'];
    $attendance = $_POST['attendance'];
    $priority = $_POST['priority_level'];
    $date = $_POST['submission_date'];
    $query = "UPDATE tasks SET
    student_name='$name',
    task_title='$task',
    attendance='$attendance',
    priority_level='$priority',
    submission_date='$date'
    WHERE id=$id";
    mysqli_query($conn,$query);
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Task</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Edit Task</h1>
<form method="POST">
<input type="text"
name="student_name"
value="<?php echo $row['student_name']; ?>">
<input type="text"
name="task_title"
value="<?php echo $row['task_title']; ?>">
<select name="attendance">
<option>Present</option>
<option>Absent</option>
</select>
<select name="priority_level">
<option>High</option>
<option>Medium</option>
<option>Low</option>
</select>
<input type="date"
name="submission_date"
value="<?php echo $row['submission_date']; ?>">
<button name="update">
Update Task
</button>
</form>
</div>
</body>
</html>