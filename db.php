<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"tracker_db"
);

if(!$conn)
{
    die("Database Connection Failed");
}

?>