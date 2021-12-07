<?php 

$db = mysqli_connect("localhost","Tracy","basic--spirit","test");

/// begin getRealIpUser functions ///

function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
    
}

// / finish getRealIpUser functions ///

// / begin add_cart functions ///

function add_cart(){
    
    global $db;
    // if(isset($_POST['add_cart'])){
        
    //     $ip_add = getRealIpUser();
        
    //     $p_id = $_POST['add_cart'];
        
    //     $product_qty = $_POST['product_qty'];
        
    //     $product_size = $_POST['product_size'];
        
    //     $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        
    //     $run_check = mysqli_query($db,$check_product);
        
    //     if(mysqli_num_rows($run_check)>0){
            
    //         echo "<script>alert('This product has already added in cart')</script>";
    //         echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
    //     }else{

    //         $get_price ="select * from products where product_id='$p_id'";

    //         $run_price = mysqli_query($db,$get_price);

    //         $row_price = mysqli_fetch_array($run_price);

    //         $pro_price = $row_price['product_price'];

    //         $pro_sale = $row_price['product_sale'];

    //         $pro_label = $row_price['product_label'];

    //         if($pro_label == "sale"){

    //             $product_price = $pro_sale;

    //         }else{

    //             $product_price = $pro_price;

    //         }
            
    //         $query = "insert into cart (p_id,ip_add,qty,p_price,size) values ('$p_id','$ip_add','$product_qty','$product_price','$product_size')";
            
    //         $run_query = mysqli_query($db,$query);
            
    //         echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            
    //     }
        
    // }
    
}

/// finish add_cart functions ///

/// begin getPro functions ///

function getPro(){
    
    global $db;
    
    $get_products = "select * from products order by 1 DESC LIMIT 0,8";
    
    $run_products = mysqli_query($db,$get_products);
    
    while($row_products=mysqli_fetch_array($run_products)){
        
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = $row_products['product_price'];

        // $pro_sale_price = $row_products['product_sale'];
        
        $pro_img1 = $row_products['product_img1'];
        
        // $pro_label = $row_products['product_label'];
        
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);

        $row_manufacturer = mysqli_fetch_array($run_manufacturer);

        $manufacturer_title = $row_manufacturer['manufacturer_title'];

        // if($pro_label == "sale"){

        //     $product_price = " <del> $ $pro_price </del> ";

        //     $product_sale_price = "/ $ $pro_sale_price ";

        // }else{

            $product_price = "  $ $pro_price  ";

            $product_sale_price = "";

        // }

        // if($pro_label == ""){

        // }else{

        //     $product_label = "
            
        //         <a href='#' class='label $pro_label'>
                
        //             <div class='theLabel'> $pro_label </div>
        //             <div class='labelBackground'>  </div>
                
        //         </a>
            
        //     ";

        // }
        
        echo "
        
        <div class='col-md-4 col-sm-6 single'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>

                <center>
                
                    <p class='btn btn-primary'> $manufacturer_title </p>
                
                </center>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                    $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>


            
            </div>
        
        </div>
        
        ";
        
    }
    
}

/// finish getPro functions ///

/// begin getPCats functions ///

function getPCats(){
    
    global $db;
    
    $get_p_cats = "select * from product_categories";
    
    $run_p_cats = mysqli_query($db,$get_p_cats);
    
    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
        
        $p_cat_id = $row_p_cats['p_cat_id'];
        
        $p_cat_title = $row_p_cats['p_cat_title'];
        
        echo "
        
            <li>
            
                <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getPCats functions ///

/// begin getCats functions ///

function getCats(){
    
    global $db;
    
    $get_cats = "select * from categories";
    
    $run_cats = mysqli_query($db,$get_cats);
    
    while($row_cats=mysqli_fetch_array($run_cats)){
        
        $cat_id = $row_cats['cat_id'];
        
        $cat_title = $row_cats['cat_title'];
        
        echo "
        
            <li>
            
                <a href='shop.php?cat=$cat_id'> $cat_title </a>
            
            </li>
        
        ";
        
    }
    
}
    
/// finish getCats functions ///

/// finish getRealIpUser functions ///

function items(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from cart where ip_add='$ip_add'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $total = 0;
    
    $select_cart = "select * from cart where ip_add='$ip_add'";
    
    $run_cart = mysqli_query($db,$select_cart);
    
    while($record=mysqli_fetch_array($run_cart)){
        
        $pro_id = $record['p_id'];
        
        $pro_qty = $record['qty'];
            
        $sub_total = (float)$record['p_price']*(int)$pro_qty;
            
        $total += $sub_total;
        
    }
    
    echo "$" . number_format((float)$total, 2, '.', '');
    
}

/// finish total_price functions ///

/// Begin getProducts(); functions ///

function getProducts(){

    global $db;
    $aWhere = array();

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;

            }

        }

    }    

    /// Finish for Categories /// 

    $per_page=6;

    if(isset($_GET['page'])){

        $page = $_GET['page'];

    }else{
        $page=1;
    }

    $start_from = ($page-1) * $per_page;
    $sLimit = " order by 1 DESC LIMIT $start_from,$per_page";
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'').$sLimit;
    $get_products = "select * from products ".$sWhere;
    $run_products = mysqli_query($db,$get_products);
    $itemIndex = 0;
    echo "
    <div class='row'>
    ";
    while($row_products=mysqli_fetch_array($run_products)){
        if ($itemIndex%3 == 0 && $itemIndex != 0)
        {
            echo "
            <div class='row'>
            ";
        }
        $pro_id = $row_products['product_id'];
        
        $pro_title = $row_products['product_title'];
        
        $pro_price = number_format((float)$row_products['product_price'], 2, '.', '');
        
        $pro_img1 = $row_products['product_img1'];
        
        $manufacturer_id = $row_products['manufacturer_id'];

        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

        $run_manufacturer = mysqli_query($db,$get_manufacturer);

        $row_manufacturer = mysqli_fetch_array($run_manufacturer);

            $product_price = "  $ $pro_price  ";

            $product_sale_price = "";
        
        echo "
        <div class='col-md-4 col-sm-6 center-responsive'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                    $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>

            
            </div>
        
        </div>
        
        ";

        if ($itemIndex%3 == 2)
        {
            echo "
            </div>
            ";
        }

        $itemIndex++;
        
    }
    echo "
    </div>
    ";

}

/// finish getProducts(); functions ///

/// begin getPaginator(); functions ///

function getPaginator(){

    global $db;

    $per_page=6;
    $aWhere = array();
    $aPath = '';

    /// Begin for Product Categories /// 

    if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

        foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'p_cat_id='.(int)$sVal;
                $aPath .= 'p_cat[]='.(int)$sVal.'&';

            }

        }

    }    

    /// Finish for Product Categories /// 

    /// Begin for Categories /// 

    if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

        foreach($_REQUEST['cat'] as $sKey=>$sVal){

            if((int)$sVal!=0){

                $aWhere[] = 'cat_id='.(int)$sVal;
                $aPath .= 'cat[]='.(int)$sVal.'&';

            }

        }

    }    

    /// Finish for Categories ///   
    
    $sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'');
    $query = "select * from products".$sWhere;
    $result = mysqli_query($db,$query);
    $total_records = mysqli_num_rows($result);
    $total_pages = ceil($total_records / $per_page);

    echo "<li> <a href='shop.php?page=1";
    if(!empty($aPath)){

        echo "&".$aPath;

    }

    echo "'>".'First Page'."</a></li>";

    for($i=1; $i<=$total_pages; $i++){

        echo "<li> <a href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."'>".$i."</a></li>";

    };

    echo "<li> <a href='shop.php?page=$total_pages";

    if(!empty($aPath)){

        echo "&".$aPath;

    }

    echo "'>".'Last Page'."</a></li>";

}

/// finish getPaginator(); functions ///

function verifyTransaction($data) {
	global $paypalUrl;

	$req = 'cmd=_notify-validate';
	foreach ($data as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
		$req .= "&$key=$value";
	}

	$ch = curl_init($paypalUrl);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	$res = curl_exec($ch);

	if (!$res) {
		$errno = curl_errno($ch);
		$errstr = curl_error($ch);
		curl_close($ch);
		throw new Exception("cURL error: [$errno] $errstr");
	}

	$info = curl_getinfo($ch);

	// Check the http response
	$httpCode = $info['http_code'];
	if ($httpCode != 200) {
		throw new Exception("PayPal responded with http code $httpCode");
	}

	curl_close($ch);

	return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid) {
	global $db;

	$txnid = $db->real_escape_string($txnid);
	$results = $db->query('SELECT * FROM `payment` WHERE txnid = \'' . $txnid . '\'');

	return ! $results->num_rows;
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment() {
	global $db;

	$data = [
		// 'item_name' => $_POST['item_name'],
		'item_id' => '332',
		'payment_status' => '2443',
		'payment_amount' => 4.5,
		// 'payment_currency' => $_POST['mc_currency'],
		'txn_id' => '5556',
		// 'receiver_email' => $_POST['receiver_email'],
		// 'payer_email' => $_POST['payer_email'],
		// 'custom' => $_POST['custom'],
	];
		$stmt = $db->prepare('INSERT INTO `payment` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
		$stmt->bind_param(
			'sdsss',
			$data['txn_id'],
			$data['payment_amount'],
			$data['payment_status'],
			$data['item_id'],
			date('Y-m-d H:i:s')
		);
		$stmt->execute();
		$stmt->close();

		return $db->insert_id;

	return false;
}

?>