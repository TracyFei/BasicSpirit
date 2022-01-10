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

    
   $active='Invoice';
    include("includes/db.php");
    include("functions/functions.php");
    // global $db;
    // addOrder($ip_add, $run_cart);
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