<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $otherGender = isset($_POST['otherGender']) ? mysqli_real_escape_string($conn, $_POST['otherGender']) : null;
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;
    $agreedToTerms = isset($_POST['regulamin']) ? 1 : 0;

    // Insert data into the database
    $sql = "INSERT INTO user_data (name, surname, email, password, birthdate, phone, province, gender, other_gender, comments, subscribe, agreed_to_terms)
            VALUES ('$name', '$surname', '$email', '$password', '$birthdate', '$phone', '$province', '$gender', '$otherGender', '$comments', $subscribe, $agreedToTerms)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>