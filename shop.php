<?php 

    $active='Shop';
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
                       Shop
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   <?php 
    
    include("includes/sidebar.php");
    
    ?> 
               
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->

                <div class='box'><!-- box Begin -->
                    <h1>Shop</h1>
                    <p>
                    The Inspiration Coin series is designed
                    to touch the heart and delight the
                    spirit. Collections of Inspiration Coins
                    on your coffee table, bookcase or
                    mantelpiece provide you with a wide
                    range of positive thoughts and feelings
                    and are a talking point with friends and
                    family. Carry a finely handcrafted
                    pewter coin in your pocket or bag and
                    you will have a positive affirmation
                    with you always. <br><br><br>
                    Heart Warmers are pre-made-up bagged
                    sets, each with three Inspiration Coins
                    that have related and meaningful
                    themes. 


                    </p>
                </div><!-- box Finish -->
               
               <div id="products" class="row"><!-- row Begin -->

                    <?php getProducts(); ?>
               
               </div><!-- row Finish -->
               
               <center>
                   <ul class="pagination"><!-- pagination Begin -->

                        <?php getPaginator(); ?>

                   </ul><!-- pagination Finish -->
               </center>
               
           </div><!-- col-md-9 Finish -->

           <div id="wait" style="position:absolute;top:40%;left:45%;padding: 200px 100px 100px 100px;"></div>
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    <script>
    
        $(document).ready(function(){

            // Hide & Show Sidebar Toggle //

            $('.nav-toggle').click(function(){
                
                $('.panel-collapse,.collapse-data').slideToggle(700,function(){

                    if($(this).css('display')=='none'){

                        $(".hide-show").html('Show');

                    }else{

                        $(".hide-show").html('Hide');

                    }

                });

            });

            // Finish Hide & Show Sidebar Toggle //

        });
    
    </script>

    <script>
    
        $(document).ready(function(){

            // getProducts Function Begin //

            function getProducts(){

                // Code For Product Categories Begin //

                var aInputs = Array();
                var aInputs = $('li').find('.get_p_cat');
                var aKeys = Array();
                var aValues = Array();

                iKey = 0;

                $.each(aInputs, function(key, oInput){

                    if(oInput.checked){

                        aKeys[iKey] = oInput.value

                    };

                    iKey++;

                });

                if(aKeys.length>0){

                    var sPath = '';

                    for(var i = 0; i < aKeys.length; i++){

                        sPath = sPath + 'p_cat[]=' + aKeys[i]+'&';

                    }

                }

                // Code For Product Categories Finish //

                // Code For Categories Begin //

                var aInputs = Array();
                var aInputs = $('li').find('.get_cat');
                var aKeys = Array();
                var aValues = Array();

                iKey = 0;

                $.each(aInputs, function(key, oInput){

                    if(oInput.checked){

                        aKeys[iKey] = oInput.value

                    };

                    iKey++;

                });

                if(aKeys.length>0){

                    var sPath = '';

                    for(var i = 0; i < aKeys.length; i++){

                        sPath = sPath + 'cat[]=' + aKeys[i]+'&';

                    }

                }

                // Code For Categories Finish //

                // Loader When Loading Begin //    

                $('#wait').html('<img src="images/load.gif"');

                // Loader When Loading Finish //  

                $.ajax({

                    url:"load.php",
                    method:"POST",

                    data: sPath+'sAction=getProducts',

                    success:function(data){

                        $('#products').html('');
                        $('#products').html(data);
                        $('#wait').empty();

                    }

                });

                $.ajax({

                    url:"load.php",
                    method:"POST",

                    data: sPath+'sAction=getPaginator',

                    success:function(data){

                        $('.pagination').html('');
                        $('.pagination').html(data);

                    }

                });

            }

            // getProducts Function Finish //

            $('.get_manufacturer').click(function(){
                getProducts();
            });

            $('.get_p_cat').click(function(){
                getProducts();
            });

            $('.get_cat').click(function(){
                getProducts();
            });

        });
    
    </script>
    
    
</body>
</html>