
<html>
    <head>
        <style>
body {
            font-family: 'Poppins';
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 95vh;
            margin: 0;
            background-image: url('docloginn.png');
            background-size: cover;
        }
        input {
            width: 300px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 20px;
        }
h2{
    justify:center;
    display:flex;
    font-size:30px;
}
button {
            width: 150px;
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
            justify:center;
        }
.class1{
    justify:center;
    font weight:bold;
    color:red;
    font-size:30px;
    font-family:serif;
}
        </style>
        </head>
        <h2><u> Log-in</u></h2><br><br><br>
        <form id="dl" method="post">
            <label for="name"></label>
            <input type="text" id="name" name="name" placeholder="Username">
            <label for="password"></label><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br><br>
            <button type="submit">Login</button>
</form>

    </body>
    </html>
    <?php
session_start();

include("connection.php");
include("functiond.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST['name'];
    $password=$_POST['password'];
    if(!empty($name)&& !empty($password)){
       
        $query="select * from doctors where name= '$name' limit 1";
        $result= mysqli_query($con,$query);
        if($result){
            if($result && mysqli_num_rows($result)>0){
                $doctor_data=mysqli_fetch_assoc($result);
                if($doctor_data['password']===$password){
                    $_SESSION['doctor_id']=$doctor_data['doctor_id'];
                    header("Location: dochome.php");
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