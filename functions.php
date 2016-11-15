<?php
  function getProfPic($username) {

    $pic = "";

    if (file_exists('users/'.$username.'/profile_pic.png')) {
        $pic = base64_encode(file_get_contents('users/'.$username.'/profile_pic.png'));
    } elseif (file_exists('users/'.$username.'/profile_pic.jpg')) {
        $pic = base64_encode(file_get_contents('users/'.$username.'/profile_pic.jpg'));
    } else {
        $pic = 'images/default-user.png';
    }

    echo $pic;
  }

  if($_POST)
  {
    if(isset($_POST['func']))
    {
      switch ($_POST['func']) {
        case 'getprofpic':
          if(isset($_POST['username']))
          {
            getProfPic($_POST['username']);
          } else {
            echo "Fail";
          }
          break;

        default:
          # code...
          break;
      }
    }
  }
?>
