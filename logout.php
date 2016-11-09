<?php
    setcookie("username", "", time()-1-3600);
    header("location:index.php");
?>