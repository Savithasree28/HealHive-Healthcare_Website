<html>
    <head>
        <style>
body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh;
            margin: 0;
            background-image: url('page.png');
            background-size: cover;
        }
        #interface {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        button {
            margin: 20px;
            padding: 30px 30px; 
            font-size: 25px; 
            border: none;
            font-weight:bold;
            background-color: white;
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
        </style>
        </head>
    <body>
        <form id="doc">
            <button type="button"><a href="docsignup.php">NEW DOCTOR?</a></button><br>
            <button type="button"><a href="doclogin.php">DOCTOR LOGIN</a></button>
</form>
    </body>
    </html>