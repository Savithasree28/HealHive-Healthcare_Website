<!DOCTYPE html>
<html>
<head>
    <title>interface</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh;
            margin: 0;
            background-image: url('mainpage1.png');
            background-size: cover;
        }
        #interface {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        button {
            margin: 20px;
            padding: 15px 30px; /* Adjusted padding */
            font-size: 20px; /* Adjusted font size */
            border: none;
            font-weight:bold;
            background-color: #1e5b82;
            color: #5888a9;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #5888a9;
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body><br><br><br>
    <form id="interface">
        <button><a href="doctor.php">DOCTOR</a></button>
        <button><a href="signup.php">PATIENT</a></button>
    </form>
</body>
</html>
