<?php


function dbConnect()
{
    $servername = "localhost";
    $username = "nkrumah2_db";
    $password = "Dog321Cat";
    $database = "nkrumah2_smarttax";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else
        echo "connected successfully\n";

    return $conn;
}
