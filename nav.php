<!-- Navigation row start-->
<nav class="navbar navbar-expand-md navbar-inverse fixed-top pl-md-5 mb-5">


    <div class="col-12 col-md-2 p-0">
        <img class="logo" src="images/logo.png" alt="logo" style="margin-left:-6px;">
        <a class="navbar-brand ml-lg-2" href="<?php echo ROOT?>home">
            <div class="logo_text">GROCERe</div>
        </a>
        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#toggleMenu" aria-controls="toggleMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon pt-2">
                <i class="fas fa-bars text-white"></i>
            </span>
        </button>
    </div>

    <!--<div class="form-group has-search">
                    <input type="text" class="form-control" placeholder="Search">
                </div>-->
    <!-- Product searchbox -->

    
    <div class="col-12 col-md-10 p-2  p-md-0" style="color:white;">
        <div class="row">
            <form action="home" method="post" enctype="multipart/form-data" class="input-group col-12 col-sm-12 col-md-4 col-lg-4 mt-2 mb-2 pr-1 pl-2">              
                
                <input name="k" type="text" class="form-control nav-search" placeholder="Search for products" id="search_gro" value="">
                <div class="input-group-append">
                    <button class="btn btn-secondary nav-search-btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            
            <script>
            $("#search_gro").on('keyup', function(e){
                var v = $(this).val();
                var v_length = v.length;
                if(v_length%2 == 0){
                    $( "#product_list" ).load( "<?php echo ROOT?>product_listing.php", {k:v});
                }
            });
            </script>

            <div class="text-center col-12 col-sm-12 col-md-4 col-lg-4 mt-2 mb-2 pl-1 pr-1 pl-md-5 pl-lg-5 d-block d-md-none">
                <div class="nav-item px-2 ml-lg-5 mt-xs-md">
                    <a class="nav-link text-white location-select" data-toggle="modal" data-target="#locationModal" href=#><i class="fas fa-map-marker-alt nav-icon"></i> <?php echo $region['region'];?></a>
                </div>
            </div>

            <div class="collapse navbar-collapse pr-md-5" id="toggleMenu">

                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item px-2 ml-lg-5 mt-xs-md d-none d-sm-block">
                        <a class="nav-link location-select" data-toggle="modal" data-target="#locationModal" href=#><i
                                class="fas fa-map-marker-alt nav-icon"></i> <?php echo $region['region'];?></a>
                    </li>
                    <li class="nav-item px-2 ml-lg-5 mt-xs-md">
                        <a class="nav-link nav-shop-cart-icon" href="shopping"><i
                                class="fas fa-shopping-cart nav-icon"></i> RM 
                                <span id="cart_summary"><?php include 'cart_summary.php';?></span>
                        </a>
                    </li>
                    <li class="nav-item px-2 ml-lg-5 mt-xs-md">
                        <?php 
                        if(!empty($_SESSION['auth_user']['name'])){
                            $name = $_SESSION['auth_user']['name'];
                            if(strlen($_SESSION['auth_user']['name'])>10){
                                $name = substr($_SESSION['auth_user']['name'],0,10).'..';
                            }?>

                            <div class="nav-link account-menu-trigger">
                                <i class="fas fa-user nav-icon"></i>&nbsp;&nbsp;
                                <?php echo $name?>
                                <div id="account-menu">
                                    <div class="account-menu-block">
                                        <div><a href="dashboard" style="color:black !important; font-size: 16px;">My Account</a></div>
                                        <div class="pt-4">
                                            <a href="signout" class="btn-pink-sm">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? }else{?>
                            <a class="nav-link" data-toggle="modal" data-target="#loginModal" href=#><i class="fas fa-user nav-icon"></i> Login/Sign Up</a>
                        <?php }?>
                    </li>
                    <li class="nav-item px-2 ml-lg-5 mt-xs-md d-block d-md-none">
                        <?php include 'category_panel_mobile.php';?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
$('.account-menu-trigger').click(function(){
    $('#account-menu').fadeIn();
})
$('.account-menu-trigger').mouseenter(function(){
    $('#account-menu').fadeIn();
})
window.addEventListener('click', function(e){
    if (!document.getElementById('account-menu').contains(e.target)){
        $('#account-menu').fadeOut();
    }
});

</script>


<!-- Navigation row end -->

<?php include("modal/login.php");?>

<?php //include("modal/signup.php");?>

<?php include("modal/forget_password.php");?>

<?php include("modal/location_modal.php");?>