<?php
session_start();

include("connection.php");
include("functiond.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password']; 
    $speciality = $_POST['speciality'];
    $query = "INSERT INTO doctors(speciality, name, password) values ('$speciality', '$name', '$password')";
    mysqli_query($con, $query);
        header("Location:doclogin.php");
        die;
    }
?>


<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 95vh;
            margin: 0;
            background-image: url('docs.png');

            background-size: cover;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 300px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 20px;
        }

        button {
            width: 300px;
            padding: 15px 0;
            font-size: 16px;
            border: none;
            font-weight: bold;
            background-color: #4CAF50;
            color: black;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5888a9;
        }

        button a {
            color: black;
            text-decoration: none;
        }

        a {
            margin-top: 20px;
            font-size: 18px;
            color: black;
            text-decoration: none;
        }
        h2{
            font-size:30px;
            display:flex;
        }
        message{
            font-weight:bold;
            color:red;
        }
        #ds {
            font-weight: bold;
            color: red;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <h2><u>Sign-up</u></h2>
    <form onsubmit="return validate1()" method="post">
    <label for="name"></label>
    <input type="text" id="name" placeholder="Username" name="name"required>

    <label for="speciality"></label>
    <input type="text" id="special" placeholder="Speciality" name="speciality" required>

    <label for="ph"></label>
    <input type="text" id="ph" placeholder="Contact"  name="phone" required>

    <label for="email"></label>
    <input type="email" id="email" placeholder="E-mail" required>

    <label for="password"></label>
    <input type="password" id="password" placeholder="Password" name="password" required>
<br><br>
    <button type="submit">Submit</button>
    </form>
    <a href="doclogin.php"><u>Do you already have an account?</u></a>
    <div id="ds"></div>
    <script>
        function validate1(){
            var name= document.getElementById('name').value.trim();
           
            var phone= document.getElementById('phone').value.trim();
            var email= document.getElementById('email').value.trim();
            var age= document.getElementById('age').value.trim();
            var pass= document.getElementById('password').value.trim();
            var isValid= true;

            if (name==''){
                displayErrorMessage('nameError','Please enter your name.');
                isValid = false;
            } else if(!validateName(name)) {
                displayErrorMessage('nameError','name cannot contain numbers.');
                isValid = false;
            } else{
                clearErrorMessage('nameError');
            }
        
            if (age=='') {
                displayErrorMessage('ageError','Please enter your age.');
                isValid=false;
            } else if(!validateAge(age)) {
                displayErrorMessage('ageError','Invalid age.');
                isValid=false;
            } else {
                clearErrorMessage('ageError');
            }

            if (phone=='') {
                displayErrorMessage('phoneError','Please enter your contact number.');
                isValid=false;
            } else if(!phone.match(/^[1-9]\d{9}$/)){
                displayErrorMessage('phoneError','Invalid phone number.');
                isValid=false;
            } else {
                clearErrorMessage('phoneError');
            }

            if (email ==='') {
                displayErrorMessage('emailError','Please enter your email address.');
                isValid=false;
            } else if(!validateEmail(email)) {
                displayErrorMessage('emailError','Invalid email address.');
                isValid=false;
            } else {
                clearErrorMessage('emailError');
            }

            if (password=='') {
                displayErrorMessage('passError','Please enter your password.');
                isValid = false;
            } else {
                clearErrorMessage('passError');
            }

            return isValid;
        }

        function displayErrorMessage(elementId, message) {
            var errorElement =document.getElementById(elementId);
            errorElement.textContent=message;
        }

        function clearErrorMessage(elementId) {
            var errorElement=document.getElementById(elementId);
            errorElement.textContent='';
        }

        function validateName(name){
            return /^[a-zA-Z]*$/.test(name);
        }

        function validateEmail(email){
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function validateAge(age){
            var re = /^(0?[1-9]|[1-9][0-9])$/;
            return re.test(age);
        }
           </script> 
        

</body>
</html>