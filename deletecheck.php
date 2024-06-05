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
    if(isset($_POST['appid'])) {
        $appid = mysqli_real_escape_string($con, $_POST['appid']);
        $deleteQuery = "DELETE FROM appointments WHERE appointment_id = '$appid'";
        if (mysqli_query($con, $deleteQuery)) {
            echo '<p class="success">Appointment deleted successfully!</p>';
        } else {
            echo '<p class="error">Error deleting appointment.</p>' . mysqli_error($con);
        }
    } else {
        echo "Please provide the appointment ID.";
    }
}
?>

<form>
    <button type="button"> <a href="home.php">HOME</a></button>
</form>
</body>
</html>