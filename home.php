<?php
session_start();
include("connection.php");
include("functions.php");
$user_data=check_login($con);
?>
<!DOCTYPE html>
<html>
<head>
    <title>HealHive</title>
    <style>
        /* General Styles */
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

        /* Navbar Styles */
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

        /* Hero Section Styles */
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

        /* About Section Styles */
        #about {
            height: 800px;
            background-color: #c7e3fa;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #020309;
        }

        #about h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        #about p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Services Section Styles */
        #services {
            height: 800px;
            
            
            background-color: #b0d4ee;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
        }

        #services h2 {
            font-size: 36px;
            margin-bottom: 40px;
        }

        .services-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .services-buttons button {
            padding: 15px 30px;
            font-size: 20px;
            font-weight: bold;
            background-color: #0baded;
            color: #fff;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .services-buttons button:hover {
            background-color: #3b8fce;
        }

        /* Contact Section Styles */
        #contact {
            height: 800px;
            background-color: #5a87b2;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fbfcfd;
        }

        #contact h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        #contact p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        #doctors-info{
            height: 800px;
            background-color: #82b0d6;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fbfcfd;
        }

        #doctors-info h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        #doctors-info p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
   
    <nav>
        <div class="container">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#doctors-info">Doctors</a><li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
                
                
            </ul>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home">
        <div class="container">
            <h1>Welcome  <?php echo $user_data['user_name']; ?>, to HealHive</h1>
            <p>Your Trusted Healthcare Companion</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <h2>About HealHive</h2>
            <p>HealHive revolutionizes healthcare management, offering a suite of convenient features tailored to your needs. Seamlessly schedule appointments, manage prescriptions, and discover nearby healthcare facilities with ease. Our advanced recommendation system ensures personalized care, matching you with the perfect healthcare providers. Trust in our stringent security measures and commitment to industry standards for peace of mind. Join HealHive today and embark on a journey to better health, supported by innovation and reliability.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <h2 style="font-family:serif;"><u> Our Services</u></h2>
            <div class="services-buttons" style="font-family:serif;">
                <button type="button" onclick="toggleAppointments()">APPOINTMENTS</button><br>
                <div id="appointmentButtons" style="display:none;">
                    <button type="button" class="horizontal-button"><a href="appointments.php" >Schedule</a></button><br>
                    <button type="button" class="horizontal-button"><a href="delete.php">Delete</a></button><br>
                </div>
                <button type="button"><a href="map.html">PHARMACY/HOSPITALS</a></button><br>
                <button type="button"><a href="doctor_review.php">DOCTOR RATING</a></button><br> 
                <button type="button" onclick="call()" >VIRTUAL DOCTOR</button><br>
                <div id="call" style="display:none;">
                    <button type="button" class="horizontal-button"><a href="https://meet.google.com/zoc-docx-kpv">VIDEO CONSULTATION</a></button>
                </div>

            </div>
        </div>
    </section>

   <!-- Doctors Section -->
<section id="doctors-info">
    <div class="container">
        <h2 style="font-family: serif;"><p style="color:black;font-size:35px;"><u>Doctors</u></p></h2>
        <div class="doctors-list">
            <?php
            $query = "SELECT d.name, d.speciality, AVG(r.ratings) AS avg_ratings
                      FROM doctors d
                      LEFT JOIN ratings r ON d.doctor_id = r.doctor_id
                      GROUP BY d.doctor_id";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='doctor'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p><strong>Speciality:</strong> " . $row['speciality'] . "</p>";
                    echo "<p><strong>Average Rating:</strong> ";
                    if ($row['avg_ratings'] !== null) {
                        echo number_format($row['avg_ratings'], 1);
                    } else {
                        echo "N/A"; // Or any other message indicating no ratings available
                    }
                    echo "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No doctors available.</p>";
            }
            ?>
        </div>
    </div>
</section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>If you have any questions or inquiries, feel free to contact us at <strong>info@healhive.com</strong>.</p>
        </div>
    </section>

   

    

   
    <footer>
        <div class="container">
            &copy; 2024 HealHive. All rights reserved.
        </div>
    </footer>

    <!-- JavaScript for Toggle Appointments -->
    <script>
        function toggleAppointments() {
            var appointmentButtons = document.getElementById("appointmentButtons");
            if (appointmentButtons.style.display === "none") {
                appointmentButtons.style.display = "block";
            } else {
                appointmentButtons.style.display = "none";
            }
        }

        function call(){
            var call= document.getElementById("call");
            if(call.style.display==="none"){
                call.style.display="block";}
                else{
                    call.style.display="none";}
                
        }
    </script>

</body>


</html>