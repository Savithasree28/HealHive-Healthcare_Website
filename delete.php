<!DOCTYPE html>
<html>

<head>
    <title>Deleting Appointments</title>
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

        label {
            display: block;
            margin-bottom: 30px;
            font-weight: bold;
        }

        input[type="text"] {
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
    <h2 style="font-size: 35px; font-family: serif;"><u>Deleting Appointments</u></h2><br><br><br><br>
    <form id="delete" method="post" action="deletecheck.php">
        <label for="appid">Appointment ID:</label>
        <input type="text" id="appid" name="appid" required>
        <input type="submit" value="Delete Appointment">
    </form>
    
</body>

</html>