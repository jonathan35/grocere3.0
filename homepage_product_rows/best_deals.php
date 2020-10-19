
<?php 

$prods = get_products('best_deals');
$products = array();

$count_prods = 0 + count($prods);

if($count_prods>0){

    $numbers = range(0, $count_prods-1);
    shuffle($numbers);
    $c = 1;
    foreach ($numbers as $value){
        if($c<=5) $products[] = $prods[$value];
        $c++;
    }


    foreach($products as $product){
        
        $pid = $defender->encrypt('encrypt', $product['uom']);
        $uid = uniqid().$pid;
        $max = $product['stock'];
        ?>
    <!-- product card start -->
    <div class="col-6 col-sm-4 col-md-2 col-lg-2 p-2 p-sm-3">
        <div class="card form-rounded">                
            <div class="label <?php if(!empty($product['promo'])) echo 'promotion';?> text-center">
                
                <?php 
                if(!empty($product['promo'])){
                    if($product['promo'] == 'new'){
                        echo 'NEW ARRIVAL';
                    }elseif($product['promo'] == 'low'){
                        echo 'LOW PRICE ALWAYS';
                    }elseif($product['promo'] == 'drop'){
                        echo 'PRICE DROPPED';
                    }
                }
                ?>
            </div>
            <div class="card-body pl-3 pr-3 pt-1 product-listing-product">
                <a href="detail?i=<?php echo $pid?>">
                    <div class="row">
                        <div class="col-12 mb-3 product-thumbnail">
                            <img class="img-fluid product-img" alt="cart item"
                                src="<?php echo ROOT.$product['photos'][0]['photo'];?>" onerror="this.onerror=null; this.src='images/photo-gray.svg'"/>
                            <div class="overlay text-center overlay<?php echo $uid;?>">
                                <img class="img-fluid" alt="tick" src="images/tick.png" />
                                <p>Item added<br />to cart!</p>
                            </div>
                        </div>
                        <div class="col-12 product-detail text-left">
                            <div class="product-description">
                                <span class="truancate"><?php echo $product['product_name']; ?>
                            </span>
                            </div>
                            <p>
                                <small class="UOM form-text text-muted text-left"><?php echo $product['uom_name']?></small>
                                <span class="price">RM <?php echo $product['price']?></span><br />
                                <?php if($product['was']>0){?>
                                <span class="price-was"><del>RM <?php echo $product['was']?></del></span>
                                <?php }?>
                            </p>

                        </div>
                    </div>
                </a>
                <div class="row">
                    <div class="col-12 text-center">
                    <?php 

                    include 'add_to_cart_button.php';
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product card end -->




    <?php }?>

    
    <?php if($count_prods>5){?>

    <!-- view more start -->
    <div class="col-6 col-sm-4 col-md-2 col-lg-2 p-2 p-sm-3">

        <span class="navigator" nav-target="#product_list" nav-link="product_listing.php" nav-post='{"i":"best_deals"}'>
            <div class="card form-rounded view-more view-more-height pt-5">
                <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
                <div class="label text-center">

                </div>
                <div class="card-body pl-3 pr-3 pt-4 pb-4">

                    <div class="row pt-5 pb-5">
                        <div class="col-12 text-center mb-3 pt-5 pl-1 pr-1">
                            <i class="fas view-more-icon fa-search text-black fa-2x"></i>
                            <p class="view-more-link">VIEW MORE</p>
                        </div>
                    </div>

                </div>
            </div>
        </span>
    </div>
    <!-- view more end -->
    <?php }?>



<?php 
    
}else{ echo '<div class="col-12 text-muted" style="padding-left:32px;"><h2>...</h2></div>';}?>
           
        
