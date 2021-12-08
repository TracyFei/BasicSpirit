<?php
    include("includes/db.php");
    include("functions/functions.php");
    if(isset($_POST['add_cart'])){

        $ip_add = getRealIpUser();
        
        $p_id = $_POST['add_cart'];
        
        $product_qty = $_POST['product_qty'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in cart')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }else{

            $get_price ="select * from products where product_id='$p_id'";

            $run_price = mysqli_query($db,$get_price);

            $row_price = mysqli_fetch_array($run_price);

            $pro_price = $row_price['product_price'];

            $pro_sale = $row_price['product_sale'];

            $pro_label = $row_price['product_label'];

            if($pro_label == "sale"){

                $product_price = $pro_sale;

            }else{

                $product_price = $pro_price;

            }
            
            $query = "insert into cart (p_id,ip_add,qty,p_price) values ('$p_id','$ip_add','$product_qty','$product_price')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
        }
        
    }
?>