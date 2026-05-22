<!-- Pranali R More -->
<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $name = $_POST['student_name'];

    $task = $_POST['task_title'];

    $attendance = $_POST['attendance'];

    $priority = $_POST['priority_level'];

    $status = $_POST['task_status'];

    $date = $_POST['submission_date'];

    if($name != "" && $task != "")
    {

        $query = "INSERT INTO tasks
        (student_name,task_title,attendance,priority_level,submission_date, task_status)

        VALUES
        ('$name','$task','$attendance','$priority','$date', '$status')";

        mysqli_query($conn,$query);

        header("Location:index.php");
    }
    else
    {
        echo "Please Fill All Fields";
    }
}
?>