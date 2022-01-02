<?php
    $server = "localhost";
    $serverUser = "root";
    $serverPswd = "";
    $dbname = "q2onlinemcqtest";
    $con = new mysqli($server,$serverUser,"");
    $db = mysqli_select_db($con,$dbname);
?>