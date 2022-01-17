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
  //  $active='Invoice';

use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

session_start();
    include("includes/db.php");
    include("functions/functions.php");
    
    $select_invoice = "select invoice_no FROM pending_orders ORDER BY order_id DESC LIMIT 1;";
    $run_pendingOrder = mysqli_query($conn,$select_invoice);
    $invoiceNo = 0;
    while($invoice = mysqli_fetch_assoc($run_pendingOrder)){
      $invoiceNo = $invoice['invoice_no'];
      // $invoice_no = $invoiceNo +1;
    }


    $select_customer = "select customer_id FROM pending_orders WHERE invoice_no='$invoiceNo';";
    $run_customer = mysqli_query($conn, $select_customer);
    $customerId;
    while($cus_id = mysqli_fetch_assoc($run_customer)){
      $customerId = $cus_id['customer_id'];
    }

    $select_name = "select * FROM customers WHERE customer_id = '$customerId';";
    $run_name = mysqli_query($conn, $select_name);
    $customer_email = "";
    $customer_name = "";
    while($cus_row = mysqli_fetch_array($run_name)){
      $customer_name = $cus_row['customer_name'];
      $customer_email = $cus_row['customer_email'];
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
<h1>Date: <?php 
$date = new DateTime("now", new DateTimeZone('Pacific/Auckland') );
echo $date->format('d/m/Y');
// echo date("jS \of F Y");?>
</h1> 

<h1>Invoice No: 00<?php echo $invoiceNo?> </h1>
<h1>To: <?php echo $customer_name ?> <br> <?php echo $customer_email ?></h1>
<h1>Particulars: </h1>
<div class="table-responsive"><!--  table-responsive Begin  -->
    
    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->
        
        <thead><!--  thead Begin  -->
            
            <tr><!--  tr Begin  -->
                <th>Product Code:</th>
                <th> Product Name: </th>
                <th> Qty: </th>
                <th> Price: </th>
                
            </tr><!--  tr Finish  -->
            
        </thead><!--  thead Finish  -->
        
        <tbody><!--  tbody Begin  -->
        <?php 
        $i = 0;
        $total = 0;
        $get_orders = "select * from customer_orders where invoice_no='$invoiceNo'";
        $run_orders = mysqli_query($conn, $get_orders);
        // $product_code = "";
        // $product_title = "";
        // $qty = 0;
        // $price = 0;
        
        while ($orders = mysqli_fetch_array($run_orders)){
          // $new_array[] = $orders;
          $orderId = $orders['order_id'];
          // $customer_Id = $orders['customer_id'];
          $price = $orders['due_amount'];
          $invoice_number = $orders['invoice_no'];
          $qty = $orders['qty'];
          $size = $orders['size'];
          $order_date = $orders['order_date'];
          $order_status = $orders['order_status'];
          $product_code = $orders['pro_code'];
          
          $get_product_name = "select product_title from products where code='$product_code';";
          $run_pro_name = mysqli_query($conn, $get_product_name);
          $name = mysqli_fetch_assoc($run_pro_name);
          $product_title = $name['product_title'];
          $total += $price;
          $i++;
        
        ?>
            <tr><!--  tr Begin  -->
                
                <td> <?php echo $product_code; ?> </td>
                <td> <?php echo $product_title; ?> </td>
                <td> <?php echo $qty; ?> </td>
                <td> $<?php echo number_format((float)$price, 2, '.', ''); ?> </td>
                
            </tr><!--  tr Finish  -->

            
          <?php } ?>


            
        </tbody><!--  tbody Finish  -->
        
    </table><!--  table table-bordered table-hover Finish  -->
    
</div><!--  table-responsive Finish  -->
<!-- <?php 

?> -->
<h1 style="text-align: right;">Total: $<?php echo number_format((float)$total, 2, '.', '');?></h1>
<div class="inovoiceLine"></div>
<h3>Terms: Payment within 7 days of invoice <br>
Pay by: Internet transfer to account: 38-9011-0325995-02 <br><br><br>
<i>Thank you and have a nice day</i> 
</h3>
</div>

<!-- <div class="col-md-4 text-center"> 
    <button style="align-items: center;" id="invoiceBack" name="back button" class="btn btn-primary">Back to Main Page</button> 
</div>

<script type="text/javascript">
    document.getElementById("invoiceBack").onclick = function () {
      window.open('customer/my_account.php?my_orders','_self');
    }; -->
<!-- </script> -->
<!-- <?php

// require_once __DIR__ . '/vendor/autoload.php';
// $mpdf = new \Mpdf\Mpdf();

// $a = file_get_contents("http://localhost/BasicSpirit/invoice.php");
// $mpdf->allow_charset_conversion=true;
// $mpdf->charset_in='UTF-8';
// $mpdf->WriteHTML($a);

// $mpdf->Output();

?> -->

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

</body>
</html>
