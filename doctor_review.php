<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Define the getDoctorId function
function getDoctorId($con, $doctor_name) {
    $query = "SELECT doctor_id FROM doctors WHERE name = '$doctor_name'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['doctor_id'];
    }
    return null; // Return null if doctor_id not found
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve ratings submitted by the user
    $doctor = mysqli_real_escape_string($con, $_POST['doctor']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    
    // Get doctor_id using the function getDoctorId
    $doctor_id = getDoctorId($con, $doctor);

    // Check if doctor_id is null
    if ($doctor_id === null) {
        // Handle the case where doctor_id is not found (e.g., display an error message)
        echo "Error: Doctor not found.";
    } else {
        // Get user_id from $user_data array
        $user_id = $user_data['user_id'];

        // Insert rating into the database
        $insert_query = "INSERT INTO ratings (doctor_id, user_id, ratings) VALUES ('$doctor_id', '$user_id', '$rating')";
        mysqli_query($con, $insert_query);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>RATINGS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            width: 450px;
            margin: 0 auto;
            border: 3px solid #ccc;
            padding: 40px;
            border-radius: 25px;
            font-size: 20px;
            font-family: serif;
        }

        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box; /* Include padding in width calculation */
            font-size:17px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            font-size: 17px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>RATINGS</h2><br><br><br><br>
    <form id="review" method="post">
        <label for="doctor">Select Doctor:</label>
        <select id="doctor" name="doctor" onchange="showRatingInput()">
            <option value="">Select a Doctor</option>
            <?php
            $query = "SELECT name, speciality FROM doctors";
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['name'] . '">' . $row['name'] . ' - ' . $row['speciality'] . '</option>';
                }
            }
            ?>
        </select><br><br>

        <div id="div" style="display: none;">
            <label id="label"></label>
            <input type="text" id="rating" name="rating" placeholder="1-5"><br><br>
        </div>
        
        <button type="submit">SUBMIT</button>
    </form>

    <button onclick="window.location.href = 'home.php';">Home</button>

    <script>
        function showRatingInput() {
            var doctor = document.getElementById("doctor").value;
            var rating = document.getElementById("div");
            var label = document.getElementById("label");

            if (doctor !== "") {
                rating.style.display = "block";
                label.innerHTML = doctor + " Rating:";
            } else {
                rating.style.display = "none";
            }
        }
    </script>
</body>
</html>