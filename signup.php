<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_name=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($user_name)&& !empty($password)&& !is_numeric($user_name)){
       $user_id=random_num(20);
        $query="insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
        mysqli_query($con, $query);
        header("Location:login.php");
        die;
    }
    else{
        echo "Please enter some valid information";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Poppins';
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh;
            margin: 0;
            background-size: cover;

        }
        
        form {
            text-align: left;
            width: 300px;
            padding: 0 20px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        label {
            margin-bottom: 5px;
            display: block;
            font-weight: bold;
            font-size: 16px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="radio"] {
            margin-bottom: 10px;
            width: calc(100% - 20px);
            padding: 7px;
            box-sizing: border-box;
        }
        input{
        width:50%;
        background:transparent;
        border:0;
        outline:0;
        padding:18px 15px;
     }
     .input-field{
        background: #eaeaea;
        margin:20px 0;
        border-radius:3px;
        display:flex;
        align-items:center;
     }
     .input-field i{
        margin-left:15px;
        color:#999;
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
        
        button:hover {
            background-color: #45a049;
        }
        
        .error {
            color: red;
            font-weight: bold;
            margin-top: 5px;
        }

        .radio-group label {
            display: inline-block;
            font-weight: normal;
            margin-right: 15px;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group input[type="radio"] + label:before {
            content: '';
            display: inline-block;
            width: 15px;
            height: 15px;
            margin-right: 5px;
            background-color: #ccc;
            border-radius: 50%;
            vertical-align: middle;
            cursor: pointer;
        }

        .radio-group input[type="radio"]:checked + label:before {
            background-color: #4CAF50;
        }
    </style>
</head>

<body style= "background-image: url('signupd.png');">
    <div>
        <h2><u>Sign Up</u></h2>
        <br>
        <form id="fid" onsubmit="return validate()" method="post">
            <div class="input-group">
                <div class="input-field">
           <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="UserName"><br></div></div>
            <div id="fnameError" class="error"></div>
            
        
            
            <div class="input-group">
                <div class="input-field">
            <div class="radio-group">
            <label for="male"><b>Gender:</b></label>
            <input type="radio" id="male" name="gender" required>
            <label for="male"><b>Male</b></label>
                
            <input type="radio" id="female" name="gender" required>
            <label for="female"><b>Female</b></label></div></div>
            </div>
            
            <div class="input-group">
                <div class="input-field">
            <label for="age"></label>
            <input type="text" id="age" placeholder="Age" required></div></div>
            <div id="ageError" class="error"></div>

            <div class="input-group">
                <div class="input-field">
            <label for="phone"></label>
            <input type="text" id="phone" placeholder="Contact no:"><br></div></div>
            <div id="phoneError" class="error"></div>
            
            <div class="input-group">
                <div class="input-field">
            <label for="mail"></label>
            <input type="email" id="mail" placeholder="Email:" required><br></div></div>
            <div id="emailError" class="error"></div>
            
            <div class="input-group">
                <div class="input-field">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password" required></div></div>
            <div id="passError" class="error"></div>
            
            <br>
            <button type="submit">SUBMIT</button>
        </form><br>
        <a href="login.php">Do you already have an account?</a>

    </div>
    <script>
        function validate() {
            var fname= document.getElementById('username').value.trim();
           
            var phone= document.getElementById('phone').value.trim();
            var email= document.getElementById('mail').value.trim();
            var age= document.getElementById('age').value.trim();
            var pass= document.getElementById('password').value.trim();
            var isValid= true;

            if (fname==''){
                displayErrorMessage('fnameError','Please enter your first name.');
                isValid = false;
            } else if(!validateName(fname)) {
                displayErrorMessage('fnameError','First name cannot contain numbers.');
                isValid = false;
            } else{
                clearErrorMessage('fnameError');
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