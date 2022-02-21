<?php
  //Het is mij niet gelukt om dit allemaal in classes te zetten dus heb ik het zo gedaan wat ik kwam er niet uit
  
  session_start();  
  $connect = mysqli_connect("localhost", "root", "", "casuswebshop");  //connectie maken met de database
  if(isset($_POST["add_to_cart"]))  //isset maken voor de button
  {  
       if(isset($_SESSION["shopping_cart"]))  
       {  
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  //item ID in een array zetten
            if(!in_array($_GET["id"], $item_array_id))   
            {  
                 $count = count($_SESSION["shopping_cart"]);  //tellen van het aantal ID's in de array
                 $item_array = array(  
                      'item_id'=>$_GET["id"],  
                      'item_name'=>$_POST["hidden_name"], 
                      'item_price'=>$_POST["hidden_price"],  
                      'item_quantity'=>$_POST["quantity"]  
                 );  
                 $_SESSION["shopping_cart"][$count] = $item_array;  
                
            }  
            else  
            {  
              echo '<script>alert("Item Already Added")</script>';  //Als het item al in de array zit word er een melding gegeven dat hij er al in zit
              echo '<script>window.location="index.php"</script>';  
            }  
       }  
       else  
       {  
            $item_array = array(  
             'item_id'=>$_GET["id"],  
             'item_name'=>$_POST["hidden_name"], 
             'item_price'=>$_POST["hidden_price"],  
             'item_quantity'=>$_POST["quantity"]  
            );  
            $_SESSION["shopping_cart"][0] = $item_array;  
       }  
  }  
  if(isset($_GET["action"]))  
  {  
       if($_GET["action"] == "delete")  
       {  
            foreach($_SESSION["shopping_cart"] as $keys => $values)  
            {  
                 if($values["item_id"] == $_GET["id"])  
                 {  
                      unset($_SESSION["shopping_cart"][$keys]);  
                      echo '<script>alert("Item Removed")</script>';  //melding geven als er gedelete word 
                      echo '<script>window.location="index.php"</script>';  
                 }  
            }  
       }  
  }  
  ?>  
  <!DOCTYPE html>  
  <html>  
       <head>  
            <title>Webshop</title>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
            <link rel="stylesheet" href="header.css">
       </head>  
       <body>  
  <ul>
    <li><a href="/Webshop/index.php">Home</a></li>
    <li><a href="/Webshop/producttoevoegen.php">product Toevoegen</a></li>
    <li><a href="/Webshop/klanttoevoegen.php">klant toevoegen</a></li>
  </ul>
  <div class="Welcome">

    <div style="clear:both"></div>  
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
                           if(!empty($_SESSION["shopping_cart"]))  //als de shoppingcart een item in zich heeft word dat zichbaar op het scherm
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
                                <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                           </tr>  
                           <?php  //De prijs berekenen
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
            <br />  
            <div class="container" style="width:700px;">  
                 <h3 align="center">Welkom</h3><br />  
                 <?php  
                 $query = "SELECT * FROM product ORDER BY id ASC";  
                 $result = mysqli_query($connect, $query);  
                 if(mysqli_num_rows($result) > 0)  
                 {  
                      while($row = mysqli_fetch_array($result))  
                      {  
                 ?>  // Hier onder haal ik de data uit mijn database op en ik laat ze zien in een container
                 <div class="col-md-4">  
                      <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
                           <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">   
                                <h4 class="text-info"><?php echo $row["artikelnaam"]; ?></h4>  
                                <h4 class="text-danger">$ <?php echo $row["prijs"]; ?></h4>  
                                <input type="text" name="quantity" class="form-control" value="1" />  
                                <input type="hidden" name="hidden_name" value="<?php echo $row["artikelnaam"]; ?>" />  
                                <input type="hidden" name="hidden_price" value="<?php echo $row["prijs"]; ?>" />  
                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                           </div>  
                      </form>  
                 </div>  
                 <?php  
                      }  
                 }  
                 ?>  
                
            <br />  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html> 