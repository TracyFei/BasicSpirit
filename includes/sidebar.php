<?php 

$aMan = array();
$aCat = array();
$aPcat = array();

if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

    foreach($_REQUEST['cat'] as $sKey=>$sVal){

        if((int)$sVal!=0){

            $aCat[(int)$sVal] = (int)$sVal;

        }

    }

}

// This is for categories Finisih //

// This is for products_categories Begin //

if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

    foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

        if((int)$sVal!=0){

            $aPcat[(int)$sVal] = (int)$sVal;

        }

    }

}

// This is for products_categories Finisih //

?>



<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu Begin -->
    <div class="panel-heading"><!-- panel-heading Begin -->
        <h3 class="panel-title">
            Categories

            <div class="pull-right"><!-- pull-right Begin -->
            
                <a href="JavaScript:Void(0);" style="color:black;">
                
                    <span class="nav-toggle hide-show"><!-- nav-toggle hide-show Begin -->
                    
                        Hide
                    
                    </span><!-- nav-toggle hide-show Finish -->
                
                </a>
            
            </div><!-- pull-right finish -->

        </h3>
    </div><!-- panel-heading Finish -->

    <div class="panel-collapse collapse-data"><!-- panel-collapse collapse-data Begin -->
    
        <div class="panel-body"><!-- panel-body 1 Begin -->
            </div><!-- panel-body 1 Finish -->
        <div class="panel-body scroll-menu"><!-- panel-body 2 Begin -->
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-cat"><!-- nav nav-pills nav-stacked category-menu Begin -->
                
                <?php 
                
                $get_cat = "select * from categories where cat_top='yes'";
                $run_cat = mysqli_query($conn,$get_cat);

                while($row_cat=mysqli_fetch_array($run_cat)){

                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $cat_image = $row_cat['cat_image'];

                    if($cat_image == ""){

                    }else{

                        $cat_image = "<img src='admin_area/other_images/$cat_image' width='20px'>&nbsp;";

                    }

                    echo "
                    <li style='background:#dddddd' class='checkbox checkbox-primary'>

                        <a>

                        <label>

                            <input ";
                            
                            if(isset($aCat[$cat_id])){
                                echo "checked='checked'";
                            }
                            
                            echo " value='$cat_id' type='checkbox' class='get_cat' name='cat'>

                            <span>
                            $cat_image
                            $cat_title
                            </span>

                        </label>

                        </a>
                    
                    </li>
                    ";

                }
                
                $get_cat = "select * from categories where cat_top='no'";
                $run_cat = mysqli_query($conn,$get_cat);

                while($row_cat=mysqli_fetch_array($run_cat)){

                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $cat_image = $row_cat['cat_image'];

                    if($cat_image == ""){

                    }else{

                        $cat_image = "<img src='admin_area/other_images/$cat_image' width='20px'>&nbsp;";

                    }

                    echo "
                    <li class='checkbox checkbox-primary'>

                        <a>

                            <label>

                                <input ";
                                
                                if(isset($aCat[$cat_id])){
                                    echo "checked='checked'";
                                }
                                
                                echo " value='$cat_id' type='checkbox' class='get_cat' name='cat'>

                                <span>
                                $cat_image
                                $cat_title
                                </span>

                            </label>

                        </a>
                    
                    </li>
                    ";

                }
                
                ?>
                
            </ul><!-- nav nav-pills nav-stacked category-menu Finish -->
        </div><!-- panel-body 2 Finish -->

    </div><!-- panel-collapse collapse-data Finish -->
    
</div><!-- panel panel-default sidebar-menu Finish -->

