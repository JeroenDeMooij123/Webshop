<?php
session_start();
//data ophalen uit de sessie
if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
  }
  
?>
<html>
<head>
    
    <link rel="stylesheet" type="text/css" href="pay.css" media="screen"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
            <link rel="stylesheet" href="header.css">
            
    </head>
    <body>
    <div style="clear:both"></div>  //weer de totaal prijs en producten laten zien
                 <br />  
                 <h3>Order Details</h3>  
                 <div class="table-responsive">  
                      <table class="table table-bordered">  
                           <tr>  
                                <th width="40%">Item Name</th>  
                                <th width="10%">Quantity</th>  
                                <th width="20%">Price</th>  
                                <th width="15%">Total</th>  
                                <th width="5%">Action</th>  
                           </tr>  
                           <?php   
                           if(!empty($_SESSION["shopping_cart"]))  
                           {  
                                $total = 0;  
                                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                {  
                           ?>  
                           <tr>  
                                <td><?php echo $values["item_name"]; ?></td>  
                                <td><?php echo $values["item_quantity"]; ?></td>  
                                <td>$ <?php echo $values["item_price"]; ?></td>  
                                <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                           </tr>  
                           <?php  
                                     $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                                }  
                           ?>  
                           <tr>  
                                <td colspan="3" align="right">Total</td>  
                                <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                                <td> <a href="pay.php" name="btnPay"> Pay</a>  </td>  
                           </tr>  
                           <?php  
                           }  
                           ?>  
                      </table>  
                 </div>  
            </div>  
            <br /> //data klaar zetten om te sturen naar de Database
<div class="container">  
  <form id="contact" action="" method="post">
      <label for="txtvoornaam">naam</label>                   
      <input name="txtName" placeholder="Name" type="text" tabindex="1" required autofocus> </br>
      <label for="txtvoornaam">Email</label>
      <input name="txtEmail" placeholder="E-mail" type="email" tabindex="2" required></br>
      <label for="txtvoornaam">Straat + huisnummer</label>
      <input name="txtAdres" placeholder="Street and house number" type="text" tabindex="3" required></br>
      <label for="txtvoornaam">Apartement</label>
      <input name="txtApart" placeholder="Apartment, suite, ect. (optional)" type="text" tabindex="4" ></br>
      <label for="txtvoornaam">Post code</label>
      <input  name="txtPost" placeholder="Postal code" type="text" tabindex="5" required></br>
      <label for="txtvoornaam">Stad</label>
      <input name="txtCity" placeholder="City" type="text" tabindex="6" required></br>
      <label for="txtvoornaam">Land</label>
      <input name="Country" placeholder="Country" type="text" tabindex="6" required></br>

      <button name="submit" type="submit" id="Paying" >Pay</button></br>

  </form>
</div>
</body>
</html>
<?php

$host = "localhost";
$dbname = "casuswebshop";
$user = "root";
$password = "";
try{

    $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

} catch(PDOException $ex){

    echo "Verbinding mislukt: $ex";
}


if(isset($_POST['submit'])){
    $Name = $_POST['txtName'];
    $Email = $_POST['txtEmail'];
    $Adres = $_POST['txtAdres'];
    $Apart = $_POST['txtApart'];
    $Postc = $_POST['txtPost'];
    $City = $_POST['txtCity'];
    $Country = $_POST ['Country'];

    $query ="INSERT INTO bestelling(naam, email, adres, apart, post, city, country) 
    VALUES"."('$Name',' $Email', '$Adres', '$Apart', '$Postc', '$City',' $Country')";
    
    $saus = $con->prepare($query);

    if($saus->execute()){
        echo '<script>alert("Bedankt voor uw bestelling")</script>';  
        echo '<script>window.location="index.php"</script>'; 
        session_destroy();

    } else {
        echo "Iets ging fout!";   
    } 
    }
?>