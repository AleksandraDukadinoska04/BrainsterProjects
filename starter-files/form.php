<?php
// ...
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "staff";

// Create a connection
$conn =  mysqli_connect($servername, $username, $password, $dbname);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $company = $_POST["company"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $student_type = $_POST["student-type"];

    // Insert the data into the database
    $sql = "INSERT INTO crud (id, name, company, email, phone, student_type) VALUES ('$name', '$company', '$email', '$phone', '$student_type')";

    if ($conn->query($sql) === true) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
