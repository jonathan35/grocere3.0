<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>
<html lang="en">

<body class="container-fluid">
    <!-- Navigation row start-->
    <?php include 'nav.php';?>
    <!-- Navigation row end-->
    <div class="row mt-5"></div>

    <div class="row mt-5 pl-md-4 pr-md-4 pl-lg-4 pr-lg-4">
 
        <?php include 'category_panel.php';?>
        <div class="col-lg-10 content mt-5 mt-sm-5 mt-md-0 mt-lg-0" id="product_list">
            
            <?php             
            
            if($_POST['k'] || $_POST['i'] || $_POST['s']){                
                include 'product_listing.php';
            }else{?>

            <div class="row mb-4">
            <?php include 'banner.php';?>
            </div>

            <!-- best deals row start -->
            <div class="row best-deals mb-2">
                <div class="col-12">
                    <div class="row-header">
                        Best Deals
                        <div class="pink-line"></div>
                    </div>
                </div>
            </div>
            <div class="row product-item best-deals mb-4">
                <?php include 'homepage_product_rows/best_deals.php';?>
            </div>
            <!-- best deals row end -->

            <!-- best sellers row start -->
            <div class="row best-sellers mb-2">
                <div class="col-12">
                    <div class="row-header">
                        Best Sellers
                        <div class="pink-line"></div>
                    </div>
                </div>
            </div>
            <div class="row product-item best-sellers mb-4">
                <?php include 'homepage_product_rows/best_sellers.php';?>
            </div>
            <!-- best sellers row end -->

            <!-- recommended row start -->
            <div class="row recommended mb-2">
                <div class="col-12">
                    <div class="row-header">
                        Recommended
                        <div class="pink-line"></div>
                    </div>
                </div>
            </div>
            <div class="row product-item recommended mb-5">

                <?php include 'homepage_product_rows/recommended.php';?>
               

            </div>
            <!-- recommended row end -->
            <?php }?>



        </div>
    </div>
    <!--////////////////////////////////////////// category ////////////////////////////////////////////// -->

    
    <?php include 'footer.php';?>


</body>

</html>



