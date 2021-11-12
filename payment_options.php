
<div class="box"><!-- box Begin -->

   <?php 
    
    $session_email = $_SESSION['customer_email'];
    
    $select_customer = "select * from customers where customer_email='$session_email'";
    
    $run_customer = mysqli_query($conn,$select_customer);
    
    $row_customer = mysqli_fetch_array($run_customer);
    
    $customer_id = $row_customer['customer_id'];
    
    ?>
    
    <h1 class="text-center">Payment Options For You</h1>  
    
     <p class="lead text-center"><!-- lead text-center Begin -->
         
         <a href="order.php?c_id=<?php echo $customer_id ?>"> Offline Payment </a>
         
     </p><!-- lead text-center Finish -->
     
     <center><!-- center Begin -->
         
        <p class="lead"><!-- lead Begin -->
            
            <!-- <script src="https://www.paypal.com/sdk/js?client-id=AfG7_1Eej9w_LfaacLw7Fjo8r9vwEZrAbSzJrL4U4S1HOZcKlgIfqj8yoh5sL1U8LOc6y61ncpBKLDTw"></script>

            <div id="paypal-button-container"></div>

            <script>
            paypal.Buttons().render('#paypal-button-container')
            </script> -->

            
        </p> <!-- lead Finish -->
         
     </center><!-- center Finish -->
    
</div><!-- box Finish -->