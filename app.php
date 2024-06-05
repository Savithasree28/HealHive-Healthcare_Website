<html>
    <head>
        <style>
            .success{
                color: #2518a2;
                font-family:Arial;
                text-align: center;
                font-weight:bold;
                font-size:30px;
                font-family:'serif';
                justify-content: center;
                padding: 20px;
                background-color:white;
                display: inline-block;



                
                
            }
            .error{
                color: red;
                font-family:Arial;
                text-align: center;
                font-weight:bold;
                font-size:30px;
                font-family:'serif';
                justify-content: center;
                padding: 20px;
                background-color:white;
                display: inline-block;

            }
            body{
                background-color: rgb(219, 229, 237);
                text-align: center;
                overflow: hidden;
                

background-image: url('app.png');
            }
            .h1{
                color: #2518a2;
                font-family:Arial;
                text-align: center;
                font-weight:bold;

                
            }
            button {
            margin-top: 15px;
            padding: 10px 25px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
            </style>
            </head>
            <body>
            <?php
session_start();
include("connection.php");
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die("Failed to connect to database");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $doctorname = mysqli_real_escape_string($con, trim($_POST['doctor']));
    $user_name = mysqli_real_escape_string($con, $_POST['username']);

 
    $endTime = date('H:i', strtotime($time . ' +30 minutes'));

    $checkAvailabilityQuery = "SELECT * FROM appointments 
                                INNER JOIN doctors ON appointments.doctor_id = doctors.doctor_id 
                                WHERE LOWER(doctors.name) = LOWER('$doctorname') 
                                AND date = '$date' 
                                AND (time >= '$time' AND time <= '$endTime')";
    $availabilityResult = mysqli_query($con, $checkAvailabilityQuery);
    if (!$availabilityResult) {
        die("Error checking doctor availability: " . mysqli_error($con));
    }

    if (mysqli_num_rows($availabilityResult) == 0) {
        
        $getDoctorIdQuery = "SELECT doctor_id FROM doctors WHERE name = '$doctorname'";
        $doctorIdResult = mysqli_query($con, $getDoctorIdQuery);
        if (!$doctorIdResult) {
            die("Error getting doctor ID: " . mysqli_error($con));
        }
        $row = mysqli_fetch_assoc($doctorIdResult);
        $doctorId = $row['doctor_id'];

        
        $insertQuery = "INSERT INTO appointments (username, doctor_id, date, time) VALUES ('$user_name', '$doctorId', '$date', '$time')";
        if (mysqli_query($con, $insertQuery)) {
            $lastInsertedId = mysqli_insert_id($con);
            echo '<p class="success" >Appointment scheduled successfully! Appointment ID: ' . $lastInsertedId . '</p>';
        } else {
            echo "Error scheduling appointment: " . mysqli_error($con);
        }
    } else {
        echo '<p class="error">Doctor not available within the scheduled time and 30 minutes after.</p>';
    }
}
?>


<form>
    <button type="button"> <a href="home.php">HOME</a></button>
</form>
        </body>
        </html>