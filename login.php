<?php
session_start();

include("connection.php");
include("functions.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $user_name=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($user_name)&& !empty($password)){
       
        $query="select * from users where user_name= '$user_name' limit 1";
        $result= mysqli_query($con,$query);
        if($result){
            if($result && mysqli_num_rows($result)>0){
                $user_data=mysqli_fetch_assoc($result);
                if($user_data['password']===$password){
                    $_SESSION['user_id']=$user_data['user_id'];
                    header("Location: home.php");
                    die;
                }
            }
        }
        echo ' <p class="class1">Wrong Username or Password</p>';
        
    }
    else{
        echo '<p class="class1"> Please enter some valid information</p>';
    }
}
?>
<!DOCTYPE html>
<html>
<head> 
<style>
    html,body{
        height:100%;
        margin:0;
        padding:0;
        background-image: url('loginn.png');
        background-size: cover;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        font-weight:bold;

    }
    
    .class1{
        color: green;
    font-family: 'Poppins';
    font-weight: bold;
    text-align: center;
    font-size: 20px;
    margin-top: 20px; /* Adjust margin as needed */
    padding: 10px; /* Adjust padding as needed */
    position: absolute;
    width: 100%;
    bottom: 300px;

    }
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    * {
    font-family: 'Poppins', sans-serif;
}
     
     h2 {
        text-align: center;
            margin-bottom: 20px;
            font-size: 35px;
            font-family: 'Poppins';
            font-weight: bold;
        }
        form {
            text-align: left;
            width: 400px;
            padding: 0 20px;
        }
     .fo{
width:90%;
max-width:400px;
position:absolute;
top:0%;
left:50%;
transform:translate(-50%,50%);
padding:50px 50px 50px;
text-align:center;
     }  
     .fo h1{
        font-size: 30px;
            margin-bottom: 60px;
            color: #2f5aa4;
            position: relative;
     }
     input{
        width:100%;
        background:transparent;
        border:0;
        outline:0;
        padding:20px 15px;
     }
     .input-field{
        background: #eaeaea;
        margin:20px 0;
        border-radius:3px;
        display:flex;
        align-items:center;
     }
     .input-field i{
        margin-left:20px;
        color:#999;
     }
     button {
            margin-top: 15px;
            padding: 15px 25px;
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
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body> <br>
<br><br>
    <h2 style="font-family:'Poppins'; font-weight:bold;"><u><b> Log-in</b> </u></h2>
<div class="container">
        <div class="fo">
                <form method="post">
                    <div class="input-group">
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <label for="username"></label>
                             <input type="text" id="username" name="username" placeholder="UserName
                             " required><br><br>
                             <p id="nam" style="color:red;"></p>
                            </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <i class="fas fa-lock"></i>        

<label for="password"></label>
<input type="password" id="password" name="password" placeholder="Password">

<p id="password" style="color:red;"></p>
</div>
</div>
<br><br>
<button type="submit" >Log In</button>
        </div>
</div>


</form>

</body>
</html>
