<?php
    include('connect.php');
    $query = "SELECT * FROM lgutb";
    $query_run = mysqli_query($conn, $query);
    echo $query_run;
?>