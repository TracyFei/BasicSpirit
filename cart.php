<?php
    $active='Cart';
    include("includes/header.php"); 
?>
   
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Cart
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div id="cart" class="col-md-9"><!-- col-md-9 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form Begin -->
                       
                       <h1>Shopping Cart</h1>
                       
                       <?php 
                       
                       $ip_add = getRealIpUser();
                       
                       $select_cart = "select * from cart where ip_add='$ip_add'";
                       
                       $run_cart = mysqli_query($conn,$select_cart);
                       
                       $count = mysqli_num_rows($run_cart);
                       
                       ?>
                       
                       <p class="text-muted">You currently have <?php echo $count; ?> item(s) in your cart</p>
                       
                       <div class="table-responsive"><!-- table-responsive Begin -->
                           
                           <table class="table"><!-- table Begin -->
                               
                               <thead><!-- thead Begin -->
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <th colspan="2">Product</th>
                                       <th>Quantity</th>
                                       <th>Unit Price</th>
                                       <th>Size</th>
                                       <th colspan="1">Delete</th>
                                       <th colspan="2">Sub-Total</th>
                                       
                                   </tr><!-- tr Finish -->
                                   
                               </thead><!-- thead Finish -->
                               
                               <tbody><!-- tbody Begin -->
                                  
                                  <?php 
                                   
                                   $total = 0;
                                   
                                   while($row_cart = mysqli_fetch_array($run_cart)){
                                       
                                     $pro_id = $row_cart['p_id'];
                                       
                                     $pro_size = $row_cart['size'];
                                       
                                     $pro_qty = $row_cart['qty'];

                                     $pro_sale = $row_cart['p_price'];
                                       
                                       $get_products = "select * from products where product_id='$pro_id'";
                                       
                                       $run_products = mysqli_query($conn,$get_products);
                                       
                                       while($row_products = mysqli_fetch_array($run_products)){
                                           
                                           $product_title = $row_products['product_title'];
                                           
                                           $product_img1 = $row_products['product_img1'];
                                           
                                           $only_price = $row_products['product_price'];
                                           
                                           $sub_total = $pro_sale*$pro_qty;

                                           $_SESSION['pro_qty'] = $pro_qty;
                                           
                                           $total += $sub_total;
                                           
                                   ?>
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <td>
                                           
                                           <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="Product 3a">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"> <?php echo $product_title; ?> </a>
                                           
                                       </td>
                                       
                                       <td>
                                          
                                           <input type="text" name="quantity" data-product_id="<?php echo $pro_id; ?>" value="<?php echo $_SESSION['pro_qty']; ?>" class="quantity form-control">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $pro_sale; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $pro_size; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           $<?php echo number_format((float)$sub_total, 2, '.', ''); ?>
                                           
                                       </td>
                                       
                                   </tr><!-- tr Finish -->
                                   
                                   <?php } } ?>
                                   
                               </tbody><!-- tbody Finish -->
                               
                               <tfoot><!-- tfoot Begin -->
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <th colspan="5">Total</th>
                                       <th colspan="2">$<?php echo number_format((float)$total, 2, '.', ''); ?></th>
                                       
                                   </tr><!-- tr Finish -->
                                   
                               </tfoot><!-- tfoot Finish -->
                               
                           </table><!-- table Finish -->
                           
                       </div><!-- table-responsive Finish -->
                       
                       <div class="box-footer"><!-- box-footer Begin -->
                           
                           <div class="pull-left"><!-- pull-left Begin -->
                               
                               <a href="index.php" class="btn btn-default"><!-- btn btn-default Begin -->
                                   
                                   <i class="fa fa-chevron-left"></i> Continue Shopping
                                   
                               </a><!-- btn btn-default Finish -->
                               
                           </div><!-- pull-left Finish -->
                           
                           <div class="pull-right"><!-- pull-right Begin -->
                               
                               <button type="submit" name="update" value="Update Cart" class="btn btn-default"><!-- btn btn-default Begin -->
                                   
                                   <i class="fa fa-refresh"></i> Update Cart
                                   
                               </button><!-- btn btn-default Finish -->
                               
                               <!-- <a href="checkout.php" class="btn btn-primary">
                                   
                                   Proceed Checkout <i class="fa fa-chevron-right"></i>
                                   
                               </a> -->
                               
                           </div><!-- pull-right Finish -->
                           
                       </div><!-- box-footer Finish -->
                       
                   </form><!-- form Finish -->
                   <form class="paypal" action="send_invoice.php" method="post" id="paypal_form">
                        <input type="hidden" name="cmd" value="_xclick" />
                        <input type="hidden" name="no_note" value="1" />
                        <input type="hidden" name="lc" value="UK" />
                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                        <input type="hidden" name="first_name" value="Customer's First Name" />
                        <input type="hidden" name="last_name" value="Customer's Last Name" />
                        <input type="hidden" name="payer_email" value="customer@example.com" />
                        <input type="hidden" name="item_number" value="123456" />
                        <input type="submit" name="submit" value="proceed to payment"/>
                    </form>

                    <?php 
    
                        // $session_email = $_SESSION['customer_email'];
                        
                        // $select_customer = "select * from customers where customer_email='$session_email'";
                        
                        // $run_customer = mysqli_query($conn,$select_customer);
                        
                        // $row_customer = mysqli_fetch_array($run_customer);
                        
                        // $customer_id = $row_customer['customer_id'];
                        
                    ?>
                        
                    <!-- <h1 class="text-center">Payment Options For You</h1>   -->
                    
                    <!-- <p class="lead text-center">lead text-center Begin -->
                        
                        <!-- <a href="order.php?c_id=<?php //echo $customer_id ?>"> Offline Payment </a> -->
                    
                   
               </div><!-- box Finish -->

               <?php 
               
                    if(isset($_POST['apply_coupon'])){

                        $code = $_POST['code'];

                        if($code == ""){

                        }else{

                            $get_coupons = "select * from coupons where coupon_code='$code'";
                            $run_coupons = mysqli_query($con,$get_coupons);
                            $check_coupons = mysqli_num_rows($run_coupons);

                            if($check_coupons == "1"){

                                $row_coupons = mysqli_fetch_array($run_coupons);

                                $coupon_pro_id = $row_coupons['product_id'];
                                $coupon_price = $row_coupons['coupon_price'];
                                $coupon_limit = $row_coupons['coupon_limit'];
                                $coupon_used = $row_coupons['coupon_used'];

                                if($coupon_limit == $coupon_used){

                                    echo "<script>alert('Your Coupon Already Expired')</script>";

                                }else{

                                    $get_cart = "select * from cart where p_id='$coupon_pro_id' AND ip_add='$ip_add'";
                                    $run_cart = mysqli_query($con,$get_cart);
                                    $check_cart = mysqli_num_rows($run_cart);

                                    if($check_cart == "1"){

                                        $add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code'";
                                        $run_used = mysqli_query($con,$add_used);
                                        $update_cart = "update cart set p_price='$coupon_price' where p_id='$coupon_pro_id' AND ip_add='$ip_add'";
                                        $run_update_cart = mysqli_query($con,$update_cart);

                                        echo "<script>alert('Your Coupon Has Been Applied')</script>";
                                        echo "<script>window.open('cart.php','_self')</script>";

                                    }else{

                                        echo "<script>alert('Your Coupon Didnt Match With Your Product On Your Cart')</script>";

                                    }

                                }

                            }else{

                                echo "<script>alert('You Coupon Is Not Valid')</script>";

                            }

                        }

                    }
               
               ?>
               
               <?php 
               
                function update_cart(){
                    
                    global $conn;
                    
                    if(isset($_POST['update'])){
                        
                        foreach($_POST['remove'] as $remove_id){
                            
                            $delete_product = "delete from cart where p_id='$remove_id'";
                            
                            $run_delete = mysqli_query($conn,$delete_product);
                            
                            if($run_delete){
                                
                                echo "<script>window.open('cart.php','_self')</script>";
                                
                            }
                            
                        }
                        
                    }
                    
                }
               
               echo @$up_cart = update_cart();
               
               ?>
               
           </div><!-- col-md-9 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
               
               <div id="order-summary" class="box"><!-- box Begin -->
                   
                   <div class="box-header"><!-- box-header Begin -->
                       
                       <h3>Order Summary</h3>
                       
                   </div><!-- box-header Finish -->
                   
                   <p class="text-muted"><!-- text-muted Begin -->
                       
                       Shipping and additional costs are calculated based on value you have entered
                       
                   </p><!-- text-muted Finish -->
                   
                   <div class="table-responsive"><!-- table-responsive Begin -->
                       
                       <table class="table"><!-- table Begin -->
                           
                           <tbody><!-- tbody Begin -->
                               
                               <tr><!-- tr Begin -->
                                   
                                   <td> Order All Sub-Total </td>
                                   <th> $<?php echo $total; ?> </th>
                                   
                               </tr><!-- tr Finish -->
                               
                               <tr><!-- tr Begin -->
                                   
                                   <td> Shipping and Handling </td>
                                   <td> $0 </td>
                                   
                               </tr><!-- tr Finish -->
                               
                               <tr><!-- tr Begin -->
                                   
                                   <td> Tax </td>
                                   <th> $0 </th>
                                   
                               </tr><!-- tr Finish -->
                               
                               <tr class="total"><!-- tr Begin -->
                                   
                                   <td> Total </td>
                                   <th> $<?php echo number_format((float)$total, 2, '.', ''); ?> </th>
                                   
                               </tr><!-- tr Finish -->
                               
                           </tbody><!-- tbody Finish -->
                           
                       </table><!-- table Finish -->
                       
                   </div><!-- table-responsive Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-3 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>

    <script>
    
       $(document).ready(function(data){

           $(document).on('keyup','.quantity',function(){

                var id = $ (this).data("product_id");
                var quantity = $(this).val();

                if(quantity !=''){

                    $.ajax({

                        url: "change.php",
                        method: "POST",
                        data:{id:id, quantity:quantity},

                        success:function(){
                            $("body").load("cart_body.php");
                        }

                    });

                }

           });

       });
    
    </script>
    
    
</body>
</html>