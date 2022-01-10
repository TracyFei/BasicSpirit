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
    <button id="singlebutton" name="Go Back to Main Page" class="btn btn-primary">Next Step!</button> 
</div>
   
<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

</body>
</html>