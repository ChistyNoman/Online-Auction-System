  <?php
  session_start();
   unset($_SESSION['uname']);
   unset($_SESSION['uName']);
   
   header("Location:Home.php");
    ?>