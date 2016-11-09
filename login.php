<!DOCTYPE html>
<html lang="en">
    <head>
        <title>IF Net</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/login.css" rel="stylesheet">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/login.js"></script>
    </head>
    <body>
        <div class="outer">
            <div class="auth-form">
                <form action="login.php" method="POST">
                    <div class="user-icon">
                        <h1>IF Net</h1><h3>Welcome</h3>
                    </div>

                    <input id="nameField" type="text" name="name" placeholder="Full Name" onblur="this.placeholder='Full Name'" onfocus="this.placeholder=''" autocomplete="off">
                    <input id="usernameField" type="text" name="username" placeholder="Username" onblur="this.placeholder='Username'" onfocus="this.placeholder=''" class="top" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" onblur="this.placeholder='Password'" onfocus="this.placeholder=''" autocomplete="off"><br>

                    <label id="errorLabel"></label><br>

                    <input type="submit" name="login" value="Login"><br/><br/>
                    <a href="#" id="alternateAuth">Not registered? Sign up!</a>
                </form>
            </div>
        </div>
    </body>
</html>

<?php

    function alert($text)
    {
        echo "<script>alert('" . $text . "')</script>";
    }

    if ($_POST)
    {
        $conn = mysqli_connect("localhost", "root", "pauloqueiroz", "ifnet");

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $name = $_POST['name'];

        if(isset($_POST['login']))
        {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            if(mysqli_num_rows($query) <= 0)
            {
                header("location: login.php?error=1");
                die();
            } else {
                setcookie("username", $username, time()+1*60*10); // 10 min
                header("location: index.php");
                die();
            }
        }
        else if (isset($_POST['register']))
        {
            if(!mysqli_query($conn, "INSERT INTO users (name, username, password) VALUES('$name', '$username', '$password')"))
            {
                header('location: login.php?error=2');
            } else {

                $usrObj = (object) [
                    'username' => [
                        'name' => $name
                    ]
                ];


                setcookie("username", $username, time()+1*60*10);
                header('location: index.php');
            }
        }
    }

    if (isset($_COOKIE['username']))
    {
        alert('uname');
        echo "<script>setUsername('" . $_COOKIE['username'] . "');</script>";
        /* Try fetching the user profile pic ;) */
    }