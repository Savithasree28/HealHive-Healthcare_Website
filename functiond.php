<?php
function check_doctor_login($con)
{
    if (isset($_SESSION['doctor_id'])) {
        $id = $_SESSION['doctor_id'];
        $query = "SELECT * FROM doctors WHERE doctor_id='$id' LIMIT 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $doctor_data = mysqli_fetch_assoc($result);
            return $doctor_data;
        }
    }
    // If doctor is not logged in, redirect to the login page
    header("Location: doclogin.php");
    die;
}

function generate_unique_doctor_id($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}
?>