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

//

?>

<!DOCTYPE html>
<html>

<head>
    <title>Scheduling Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 450px;
            margin: 0 auto;
            background-color: #aec6e4;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 25px;
        }

        label,select{
            display: block;
            margin-bottom: 30px;
            font-weight: bold;
        }

#doctor{
    width: calc(100% - 22px);
            padding: 5px;
            margin-bottom: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 20px;
}
        input[type="date"],
        input[type="text"],
        input [type="time"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        
        }
    </style>
</head>

<body>
    <h2 style="font-size: 35px; font-family: serif;"><u>Scheduling Appointments</u></h2>
    <form id="schedule" method="post" action="app.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" placeholder="Enter your username" required>
    
        <label for="date">DATE:</label>
        <input type="date" name="date" id="date" required>
        <label for="time">TIME:</label>
        <input type="time" id="time" name="time" placeholder=" eg 10:00 AM" required>
        <label for="doctor">Doctor:</label>
        <select id="doctor" name="doctor" required>
            <?php foreach ($doctors as $doctor) : ?>
                <option value="<?php echo $doctor['name']?>"><?php echo $doctor['name']."-".$doctor['speciality']?></option>
            <?php endforeach; ?>
        </select>
       
        <input type="submit" value="Schedule Appointment">
    </form>
    <script>
        document.getElementById('schedule').addEventListener('submit', function(event) {
            var dateInput = document.getElementById('date').value;
            var existingDate = localStorage.getItem('scheduled_date');

            if (dateInput === existingDate) {
                var confirmBooking = confirm("You have already scheduled an appointment for this date. Are you sure you want to schedule another appointment?");
                if (!confirmBooking) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            } else {
                localStorage.setItem('scheduled_date', dateInput);
            }
        });

    </script>
   
</body>

</html>