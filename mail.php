<?php
session_start();
include("connection.php");
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die("Failed to connect to database");
}

// Fetch list of doctors
$doctorQuery = "SELECT * FROM doctors";
$doctorResult = mysqli_query($con, $doctorQuery);
$doctors = mysqli_fetch_all($doctorResult, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['username'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $doctor = $_POST['doctor'];

    // Send email to doctor
    $to = "asifareh8@gmail.com"; // Replace with the actual email address of the doctor
    $subject = "New Appointment";
    $message = "Dear Dr. $doctor,\n\n";
    $message .= "A new appointment has been scheduled by $user_name for the following details:\n";
    $message .= "Date: $date\n";
    $message .= "Time: $time\n\n";
    $message .= "Please confirm the appointment at your earliest convenience.\n\n";
    $message .= "Regards,\n";
    $message .= "Your Clinic";

    $headers = "From: asifareh8@gmail.com"; // Replace with your clinic's email address

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<p>Email sent successfully to $to</p>";
    } else {
        // Error handling and debugging
        echo "<p>Failed to send email to $to</p>";
        echo "<p>Error: " . error_get_last()['message'] . "</p>";
    }
}
?>
