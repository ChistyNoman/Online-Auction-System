


<?php
if(isset($_GET['Delete']))
{
     $name=$_GET['Delete'];



   $Server="localhost";
     $username="root";
     $psrd="";
     $dbname = "Bidding";
     $connection= mysqli_connect($Server,$username,$psrd,$dbname); 

   $query="delete from User where UserId='$name'";

//delete from User where UserName='$name'
   //delete from User where UserID='$id'

    mysqli_query($connection,$query);
    header('Location:ADeleteUser.php');
}
?>