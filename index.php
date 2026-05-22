<?php include 'db.php'; ?>

<?php

$total =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks"));

$present =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE attendance='Present'"));

$absent =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE attendance='Absent'"));

?>
<?php

// TOTAL TASKS

$total =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks"));

// PRESENT

$present =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE attendance='Present'"));

// ABSENT

$absent =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE attendance='Absent'"));

// COMPLETED TASKS

$completed =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE task_status='Completed'"));

// PENDING TASKS

$pending =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM tasks
WHERE task_status='Pending'"));

// PRODUCTIVITY %

$productivity = 0;

if($total > 0)
{
    $productivity =
    ($completed / $total) * 100;
}

// PENDING %

$pendingPercent = 0;

if($total > 0)
{
    $pendingPercent =
    ($pending / $total) * 100;
}

// MOST ACTIVE STUDENT

$activeQuery =
mysqli_query($conn,

"SELECT student_name,
COUNT(*) as totalTasks

FROM tasks

GROUP BY student_name

ORDER BY totalTasks DESC

LIMIT 1");

$activeStudent =
mysqli_fetch_assoc($activeQuery);

?>

<!DOCTYPE html>
<html>
<head>

<title>Smart Productivity Dashboard</title>

<link rel="stylesheet"
href="style.css">

<script src="script.js"></script>

</head>

<body>

<div class="container">

<h1 class="title">
Smart Student Productivity Dashboard
</h1>

<!-- DASHBOARD -->

<div class="dashboard">

<div class="card">

<h2><?php echo $total; ?></h2>

<p>Total Tasks</p>

</div>

<div class="card">

<h2><?php echo $present; ?></h2>

<p>Present Students</p>

</div>

<div class="card">

<h2><?php echo $absent; ?></h2>

<p>Absent Students</p>

</div>

<div class="card">

<h2><?php echo round($productivity); ?>%</h2>

<p>AI Productivity Score</p>

</div>

<div class="card">

<h2><?php echo round($pendingPercent); ?>%</h2>

<p>Pending Task Rate</p>

</div>

<div class="card">

<h2>

<?php

echo $activeStudent['student_name'];

?>

</h2>

<p>Most Active Student</p>

</div>

</div>

<!-- Ai -->

<div class="form-box">

<h2>🤖 AI Insights & Recommendations</h2>

<br>

<?php

if($productivity >= 80)
{
    echo "

    <p style='color:lime;font-size:18px;'>

    Excellent productivity detected.
    Students are consistently completing tasks.

    </p>

    ";
}

elseif($productivity >= 50)
{
    echo "

    <p style='color:orange;font-size:18px;'>

    Moderate productivity observed.
    Focus on reducing pending tasks.

    </p>

    ";
}

else
{
    echo "

    <p style='color:red;font-size:18px;'>

    Low productivity detected.
    Improve attendance and task completion.

    </p>

    ";
}

?>

<br>

<p>

📌 Pending Tasks:
<?php echo $pending; ?>

</p>

<p>

📌 Completed Tasks:
<?php echo $completed; ?>

</p>

<p>

📌 Attendance Ratio:
<?php echo $present; ?> Present /
<?php echo $absent; ?> Absent

</p>

</div>
<!-- FORM -->

<div class="form-box">

<form action="add.php" method="POST">

<input type="text"
name="student_name"
placeholder="Student Name"
required>

<input type="text"
name="task_title"
placeholder="Task Title"
required>

<select name="attendance">

<option>Present</option>
<option>Absent</option>

</select>

<select name="priority_level">

<option>High</option>
<option>Medium</option>
<option>Low</option>

</select>

<select name="task_status">

<option>Completed</option>
<option>Pending</option>

</select>

<input type="date"
name="submission_date">

<button name="submit">

Add Task

</button>

</form>

</div>

<!-- SEARCH -->

<input type="text"
id="search"
class="search"
placeholder="Search Student or Task"
onkeyup="searchTask()">

<!-- TABLE -->

<table>

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Task</th>
<th>Attendance</th>
<th>Priority</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$data =
mysqli_query($conn,
"SELECT * FROM tasks");

while($row =
mysqli_fetch_assoc($data))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['student_name']; ?></td>

<td><?php echo $row['task_title']; ?></td>

<td class="<?php echo strtolower($row['attendance']); ?>">

<?php echo $row['attendance']; ?>

</td>

<td class="<?php echo strtolower($row['priority_level']); ?>">

<?php echo $row['priority_level']; ?>

</td>

<td class="<?php echo strtolower($row['task_status']); ?>">

<?php echo $row['task_status']; ?>

</td>

<td><?php echo $row['submission_date']; ?></td>

<td>

<a class="edit-btn"
href="edit.php?id=<?php echo $row['id']; ?>">

Edit

</a>

<a class="delete-btn"
href="delete.php?id=<?php echo $row['id']; ?>">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>