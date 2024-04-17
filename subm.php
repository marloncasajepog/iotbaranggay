<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$database = "registration_db";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to save registration data to the database
function saveRegistration($conn, $fullName, $address, $picture) {
    $sql = "INSERT INTO registrations (fullName, address, picture) VALUES ('$fullName', '$address', '$picture')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Registration saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Function to retrieve registrations from the database
function getRegistrations($conn) {
    $sql = "SELECT * FROM registrations";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "ID: " . $row["id"]. " - Name: " . $row["fullName"]. " - Address: " . $row["address"]. "<br>";
            echo '<img src="' . $row["picture"] . '" width="100" height="100"><br>';
        }
    } else {
        echo "0 results";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];
    $picture = $_POST['picture']; // Assuming you store the image path in the database

    saveRegistration($conn, $fullName, $address, $picture);
}

// Close connection
mysqli_close($conn);
?>