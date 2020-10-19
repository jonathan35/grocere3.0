<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


</div>

<div class="banner-section">
<?php 

$banners = sql_read('select * from banner where status=1 order by position asc, id desc');

$cb = @count($banners);

if($cb>0){
?>


    <div class="card form-rounded card-banner">
        <div id="CarouselBanner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for($n=0; $n<$cb; $n++){?>
                <li data-target="#CarouselBanner" data-slide-to="<?php echo $n?>" class="<?php if($c==0) echo 'active'; ?>"></li>                
                <?php }?>
            </ol>
            <div class="carousel-inner">
                <?php 
                $c = 1;
                foreach($banners as $banner){?>
                <div class="carousel-item <?php if($c==1) echo 'active'; ?> ">
                    <img class="d-block img-fluid" src="<?php echo ROOT.$banner['banner'];?>" alt="">
                </div>
                <?php 
                $c++;
                }
                
                if($cb>1){?>             
                <a class="carousel-control-prev" href="#CarouselBanner" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#CarouselBanner" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php }?>
            </div>
        </div>
    </div>


<script>

$('.carousel').carousel();
</script>


<?php }?>


<?php
$latest_prod = array();
$valid_stock = sql_read('select * from stock_promo where stock > 0 AND location=?', 's', $_SESSION['location']);

if(@count($valid_stock)>0){

    $stock_list = '(';
    $c =1;
    $max_c = count($valid_stock);
    foreach($valid_stock as $s){
        $stock_list .= $s['uom'];
        if($c<$max_c) $stock_list .= ',';
        $c++;
    }
    $stock_list .= ')';

    $valid_uom = sql_read("select * from uom where status=1 AND price >0 AND region=? AND id IN $stock_list", 's', $_SESSION['region']);

    if(@count($valid_uom)>0){
        

        $uom_list = '(';
        $c =1;
        $max_c = count($valid_uom);
        foreach($valid_uom as $u){
            $uom_list .= $u['product'];
            if($c<$max_c) $uom_list .= ',';
            $c++;
        }
        $uom_list .= ')';

        $stocks = $uoms = array();

        foreach($valid_uom as $vu){
            $uoms[$vu['product']] = $vu;
        }
        foreach($valid_stock as $vs){
            $stocks[$vs['uom']] = $vs;
        }


        $prod = sql_read("select * from product where status=1 AND region=? AND id IN $uom_list order by id desc  limit 1", 's', $_SESSION['region']);
        $the_uom = $uoms[$prod['id']];
        $the_stock = $stocks[$the_uom['id']];
        $photos = sql_read('select * from photos where status=1 AND product =? order by position asc, id asc', 's', $prod['id']);
        $the_cat = sql_read('select * from category where id =? limit 1', 's', $prod['category']);
        
        if(@count($prod)){
            $latest_prod = array_merge(
                $prod, 
                array(
                    'uom'=>$the_uom['id'], 
                    'uom_name'=>$the_uom['uom'], 
                    'price'=>$the_uom['price'], 
                    'stock'=>$the_stock['stock'], 
                    'promo'=>$the_stock['promo'], 
                    'was'=>$the_stock['was'],
                    'photo'=>$photos[0]['photo'],
                    'category_id'=>$the_cat['id'],
                    'category'=>$the_cat['category']
                )
            );
        }
      
    }
}?>


<?php
if($latest_prod['stock']>0){?>

    <div class="card form-rounded px-0 card-new-arrival">
        <!-- if there is promotion, echo out promotion class to colour the label and echo out the label name, maintain the div to ensure the spacing is preserved-->
        
            <div class="row no-gutters new-arrival">
                <div class="col-6 p-3 ">
                    <p class="new-arrival-title">New Arrival!</p>
                    
                    <small class="new-arrival-category font-italic"><?php echo $latest_prod['category']?></small>
                    <p>
                    <span class="new-arrival-name truancate-new-arrival na-title">
                        <?php echo $latest_prod['product_name']?>
                    </span>
                    </p>
                    
                    <small class="new-arrival-uom"><?php echo $latest_prod['uom_name']?></small>
                    <p class="new-arrival-title">RM <?php echo $latest_prod['price']?></p>

                    <div class="scale-btn">
                    <?php 
                    $pid = $defender->encrypt('encrypt', $latest_prod['uom']);
                    $uid = uniqid().$pid;
                    $max = $latest_prod['stock'];
                    include 'add_to_cart_button.php';
                    ?>
                    </div>
                </div>
                <div class="col-6 text-center new-arrival-thumbnail pt-4 pr-2 p-lg-1 pt-lg-4 p-md-1">
                    <img class="img-fluid new-arrival-product-img" alt="cart item" src="<?php echo ROOT.$latest_prod['photo']?>" onerror="this.onerror=null; this.src='images/photo-gray.svg'" />
                    <div class="overlay text-center overlay<?php echo $uid;?> pt-4">
                        <img class="img-fluid" alt="tick" src="images/tick.png" />
                        <p>Item added<br />to cart!</p>
                    </div>
                </div>

            </div>
            
      
    </div>

<?php }?>
</div>