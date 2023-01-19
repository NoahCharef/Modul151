<?php
    $servername = "localhost";
    $username = "db";
    $password = "dbpass";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully\n";

    $result = mysqli_query($conn, "SELECT * FROM schuldb.tbl_musikrichtung;");

    foreach($result as $row)
    {
        echo $row["musikrichtung"];
        echo "\n";
    }
?>