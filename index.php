<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>IF Net</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/jquery.xdomainajax.js"></script>
        <script src="js/js.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
            IF NET
        </a>
        </div>

        <!--<form class="navbar-form navbar-left" role="search">
            <div class="input-group">
                <span class="input-group-btn">
                    <button id="mainSearchBtn" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
                <input id="mainSearchBar" type="text" class="form-control" placeholder="Search" onfocus="this.placeholder=''" onblur="this.placeholder='Search'">
            </div>
        </form>-->

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> Username <span class="caret"></span></a>
                <ul class="dropdown-menu" id="mainUserDropdown">
                    <li class="black"><a href="#"><i class="fa fa-home"></i> Profile</a></li>
                    <li class="black"><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                    <li class="divider black"></li>
                    <li class="black"><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
            
        </ul>
        
    </div>
    </nav>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic);

        window.onresize = () => {
            drawBasic();
        }

    function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Dogs');

      data.addRows([
        [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18]
      ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        },
        chartArea: {top: 20, width: '300px', height: '75%'},
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
    </script>
    
    

<?php

    function _var($name, $val)
    {
        echo "<script> var $name = '$val'</script>";
    }

    function js($text)
    {
        echo "<script>" . $text . "</script>";
    }

    if(!isset($_COOKIE['username']))
    {
        header('location: login.php');
        die();
    }

    setcookie("username", $_COOKIE['username'], time()+1*60*10); //10 min

    $conn = mysqli_connect("localhost", "root", "pauloqueiroz", "ifnet");

    $username = $_COOKIE['username'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(!$query)
    {
        echo "Error: " . mysqli_error();
    }
    $rows = mysqli_fetch_assoc($query);
    $name = $rows['name'];

    // echo "<script>var name = '$name';</script>";
    _var("name", $name);

    js("apply();");


    if(is_dir("users/" . $username . "/profile_pic.png"))
    _var("profPicPath", "users/" . $username . "/profile_pic.png");
    else
    _var("profPicPath", "images/default-user.png");

    /*
        check GETs and POSTs here
    */

    include ("layouts/main.html");
?>

    </body>
</html>