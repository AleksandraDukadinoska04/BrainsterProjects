<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "staff";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO staff (id, company, email, phone, student)
VALUES ('John Doe', 'apple' 'john@example.com', '+389-8484848' ,'tupe-student')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
  ?>
