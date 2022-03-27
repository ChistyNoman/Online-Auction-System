<?php session_start() ?>

<?php 

     $Server="localhost";
     $username="root";
     $psrd="";
     $dbname = "Bidding";
     $connection= mysqli_connect($Server,$username,$psrd,$dbname);

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Bidding System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

  <style>

 body {
  
    background-color: lightgray;
font-family: Agency FB;
}

form { margin: 0px 10px; }

h2 {
  margin-top: 2px;
  margin-bottom: 2px;
}

.container { max-width: 360px; }

.divider {
  text-align: center;
  margin-top: 20px;
  margin-bottom: 5px;
}

.divider hr {
  margin: 7px 0px;
  width: 35%;
}

.left { float: left; }

.right { float: right; }

#catagory
{
 width:310px;

 padding:2px;
 height:40px;
 border-radius:5px;
 box-shadow:0px 0px 10px 0px grey;
}

</style>


<script>

function ValidateBidForm()
{

    
    var name        =BidForm.name;
    var price       =BidForm.price;
    var description =BidForm.description;
    var Quantity    =BidForm.qty;
    var sdate       =BidForm.sdate;
    var edate       =BidForm.edate;


    if (name.value == "")
    {
        window.alert("Please Enter Product Name.");
        name.focus();
        return false;
    }
    
   

if(document.getElementById("catagory").value == "Select Catagory")
   {
      alert("Please select Catagory"); // prompt user
      document.getElementById("catagory").focus(); //set focus back to control
      return false;
   }
   

    if (price.value == "")
    {
        window.alert("Need Product Base Price.");
        price.focus();
        return false;
    }


    if (description.value=="")
    {
        window.alert("Please Give Pruduct Description");
        description.focus();
        return false;
    }

    if (Quantity.value=="")
    {
        window.alert("Please Enter Product Quantity");
        Quantity.focus();
        return false;
    }
     if (sdate.value=="")
    {
        window.alert("Please Enter Start Date For Bid");
        Quantity.focus();
        return false;
    }

    if (edate.value=="")
    {
        window.alert("Please Enter End Date For Bid");
        Quantity.focus();
        return false;
    }
$datenow = date("Y-m-d");

if(sdate<datenow)
{
      window.alert("wrong date format");
        Quantity.focus();
        return false;
}
if(edate<datenow||edate<sdate)
{
      window.alert("wrong date format");
        Quantity.focus();
        return false;
}
  
    return true;
}



       function checkPname() {
            if (document.getElementById("productN").value == "") {
                document.getElementById("pnErr").innerHTML = "Product Name can't be blank";
                document.getElementById("productN").style.borderColor = "red";
            }else{
                document.getElementById("pnErr").innerHTML = "";
                document.getElementById("productN").style.borderColor = "green";

            }
            
        }


        function checkPr() {
            if (document.getElementById("productP").value == "") {
                document.getElementById("prErr").innerHTML = "Product price can't be blank";
                document.getElementById("productP").style.borderColor = "red";
            }else{
                document.getElementById("prErr").innerHTML = "";
                document.getElementById("productP").style.borderColor = "green";


}

}
        
        function checkQ() {
            if (document.getElementById("productQ").value == "") {
                document.getElementById("QuErr").innerHTML = "Quantity can't be blank";
                document.getElementById("productQ").style.borderColor = "red";
            }else{
                document.getElementById("QuErr").innerHTML = "";
                document.getElementById("productQ").style.borderColor = "green";


}

}



</script>

</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  

     $uname=$_SESSION['uname'];
     //echo $uname;
     $name=$_POST['name'];
     //echo $name;
     $catagory=$_POST['catagory'];
    // echo $catagory;
     $price=$_POST['price'];
     //echo $price;
     $description=$_POST['description'];
    // echo $description;
     $Quantity=$_POST['qty'];
     //echo $Quantity;
     $sdate=$_POST['sdate'];
     $edate=$_POST['edate'];
     $ProductStatus='No';

     $destination = "ProductPhoto/".$_FILES['Cpicture']['name'];
     $filename    = $_FILES['Cpicture']['tmp_name'];  
     move_uploaded_file($filename, $destination);

     $query="insert into Product(ProductName,CatagoryName,UserName,Price,Description,ProductStatus,Quantity,StartDate,EndDate,Buyer,Image)      values('$name','$catagory','$uname','$price','$description','$ProductStatus','$Quantity','$sdate','$edate','Null','$destination')";
     $exe= mysqli_query($connection,$query);
     if (!$exe) {
        echo '<script language="javascript">';
        echo 'alert("insertion Problem")';
        echo '</script>';
        echo "Error creating database: " . mysqli_error($connection);
      
     }
     else
     {
        echo '<script language="javascript">';
        echo 'alert("successfull")';
        echo '</script>';
     }
     
}

?>

  <?php include('header_user.php'); ?>


<div class="container">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-body">
      <form action="" method="POST" enctype="multipart/form-data" role="form" name="BidForm">
            <div class="form-group">
              <h2>Add New Product</h2>
            </div>
             <div class="form-group">
              <label class="control-label" for="signupName">Product Name</label>
              <input type="text" name="name" maxlength="50" id="productN" class="form-control" required onblur="checkPname()" onkeyup="checkPname()"/>
                                   <p id="pnErr"></p>
                                    <span style="color: red;"></span>
                               

              <div class="form-group">
              <label class="control-label" for="signupName">Product Catagory</label>
              <select name="catagory" id="catagory" onchange="fetch_select(this.value);">
                <option>Select Catagory</option>
                <option>Mobile</option>
                <option>Computer</option>
                <option>Car</option>
                <option>Television</option>
              </select>
            </div>
          
            <div class="form-group">
              <label class="control-label" for="signupEmail">Priduct Price</label>
              <input  type="text" name="price" maxlength="50" id="productP" class="form-control" required onblur="checkPr()" onkeyup="checkPr()"/>
                                   <p id="prErr"></p>
                                    <span style="color: red;"></span>
                                </div>
            </div>
              <div class="form-group">
              <label class="control-label">Product Description</label>
              <textarea rows="2" cols="62" name="description" required> </textarea>
            </div>
            
             <div class="form-group">
              <label class="control-label">Priduct Quantity</label>
              <input  type="text" name="qty" maxlength="50" id="productQ" class="form-control" required onblur="checkQ()" onkeyup="checkQ()"/>
                                   <p id="QuErr"></p>
                                    <span style="color: red;"></span>
                                
            </div>
              <div class="form-group">
              <label class="control-label">Start Date</label>
              <input  type="date" name="sdate" maxlength="50" class="form-control" required >
            </div>
           

              <div class="form-group">
              <label class="control-label">End Date</label>
              <input  type="date" name="edate" maxlength="50" class="form-control" required>
            </div>
             <div class="form-group">
             <label class="control-label">Product Picture</label>
              <input  type="file" name="Cpicture">
            </div>

            

            <div class="form-group">

              <button id="signupSubmit" type="submit" class="btn btn-info btn-block"  onclick ="return ValidateBidForm();">Add Now</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>

