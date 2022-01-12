<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>


<?php 

// session_start();
   $active='Invoice';
    include("includes/db.php");
    include("functions/functions.php");
    
    $select_invoice = "select invoice_no FROM pending_orders ORDER BY order_id DESC LIMIT 1;";
    $run_pendingOrder = mysqli_query($conn,$select_invoice);
    while($invoice = mysqli_fetch_assoc($run_pendingOrder)){
      $invoice_no = $invoice['invoice_no'];
    }

    $ip_add = getRealIpUser();
    $select_cart = "select * from cart where ip_add='$ip_add'";

    $run_cart = mysqli_query($conn,$select_cart);
    while($record=mysqli_fetch_array($run_cart)){
      $pid = $record['p_id'];
      $select_products = "select * from products where product_id='$pid'";
      $run_products = mysqli_query($db,$select_products);
      
      while($row_products = mysqli_fetch_array($run_products)){
        $product_title = $row_products['product_title'];
        $product_code = $row_products['code'];
      }
    }
?>
<style>
body {
  background-color: white;
}
</style>
<div class="invoiceWidth">
<div class="container" style="font-family: Maiandra GD; text-align: center; margin: auto">

<h1 style="font-size: 30px">INVOICE from:</h1>

<div class="invoiceBox">
<p style="font-size: 80px; margin: 5px">Basic Spirit</p> 
</div>
<h2><i>Website: https://www.basicspirit.nz<br> 
Email: mail@basicspirit.nz</i></h2>

</div>
<h1>Date: <?php echo date("jS \of F Y");?></h1> 
<h1>Invoice No: <?php echo $invoice_no?> </h1>

</div>

<div class="col-md-4 text-center"> 
    <button id="invoiceBack" name="back button" class="btn btn-primary">Back to Main Page</button> 
</div>

<script type="text/javascript">
    document.getElementById("invoiceBack").onclick = function () {
      window.open('customer/my_account.php?my_orders','_self');
    };
</script>
   
<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

</body>
</html>