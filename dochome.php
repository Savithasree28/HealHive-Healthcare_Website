<?php
session_start();
include("connection.php");
include("functiond.php");
$doctor_data=check_doctor_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        nav {
            background-color: #0b32a9;
            color: #fff;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(87, 124, 227, 0.308);
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            text-align: center;
            font-family: serif;
            font-size:25px;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        nav ul li a {
            display: block;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #a2afea88;
        }
        #home {
            height: 800px;
            background-color: rgb(219, 229, 237);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #2518a2;
        }

        #home h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        #home p {
            font-size: 24px;
            margin-bottom: 40px;
        }
        .class2{
            font-size:30px;
            font-weight:bold;
            color:red;
            display:flex;
            justify:center;
        }


        #patients {
            height: 800px;
            background-color: #c7e3fa;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #020309;
        }

        #patients h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        #patients p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }
        h3{
            font-family:serif;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#appointments">Appointments</a></li>
                <li><a href="#patients">Patients</a></li>
                <li><a href="interface.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <section id="home">
        <div class="container">
            <h1>Welcome Dr. <?php echo $doctor_data['name']; ?>, to HealHive</h1>
            <p>Your Trusted Healthcare Companion</p>
        </div>
    </section>

    <section id="appointments">
        <div class="container">
            <h2 style="font-family: serif;"><p style="color:black;font-size:35px;"><u>Appointments</u></p></h2>
            <div class="appointments-list">
                <?php
                //appointments table
                $query = "SELECT appointment_id, time,date, username
                          FROM appointments 
                          WHERE doctor_id = '{$doctor_data['doctor_id']}' 
                          AND date>CURDATE() OR (date= CURDATE() AND time>CURTIME())";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='appointment'>";
                        echo "<h3>Appointment ID: " . $row['appointment_id'] . "</h3>";
                        echo "<p><strong>Time:</strong> " . $row['time'] . "</p>";
                        echo "<p><strong>Patient:</strong> " . $row['username'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p class='class2'>No appointments available.</p>";
                }
                ?>
            </div>
        </div>
      <section id="patients">
        <div class="container">
            <h2>Patients</h2>
            <div class="patients-list">
                <?php
                $query= "SELECT DISTINCT username FROM appointments WHERE doctor_id = '{$doctor_data['doctor_id']}'";
                $result=mysqli_query($con, $query);

                if(mysqli_num_rows($result)>0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='patient'>";
                        echo "<p><strong>Patient Username:</strong> " . $row['username'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No patients assigned.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>
