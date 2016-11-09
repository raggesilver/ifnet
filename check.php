<?php
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $conn = mysqli_connect("localhost", "root", "pauloqueiroz", "ifnet");
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        echo mysqli_num_rows($query);
    } else {
        header('location: index.php');
        die();
    }
?>