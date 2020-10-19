<style>
.xs-font-size {
    font-size:14px !important;
}

</style>


<div class="row footer mt-3 pt-5 pb-5 text-left">
    <div class="col-12">
        <div class="row no-gutters">
            <div class="footerDescription col-12 col-md-1 col-lg-1 mb-3 text-center">
                <img class="logo" src="images/footer-logo.png" alt="footer logo" />                
            </div>
            <div class="d-block d-sm-none col-12"><br><br></div>
            <div
                class="footerDescription footer-links text-left col-10 offset-1 offset-sm-0 col-md-1 col-lg-1 mb-3 xs-font-size">
                <p class="footer-header"><span class="xs-font-size">GROCERE</span></p>
                <a href="About-Us"><span class="xs-font-size">About Us</span></a><br />
                <a href="Blog"><span class="xs-font-size">Blog</span></a><br />
                <a href="Terms-of-Use"><span class="xs-font-size">Terms of Use</span></a><br />
                <a href="Privacy-Policy"><span class="xs-font-size">Privacy Policy</span></a><br />
            </div>
            <div class="d-block d-sm-none col-12"><br><br></div>
            <div
                class="footerDescription footer-links text-left col-10 offset-1 offset-sm-0 col-md-1 col-lg-1 mb-3">
                <p class="footer-header">Customer Service</p>
                <a href="Contact-Us">Contact Us</a><br />
                <a href="Help">Help</a><br />
                <? //echo $defender->encrypt('encrypt', 6);?>
            </div>
            <div class="d-block d-sm-none col-12"><br><br></div>
            <div
                class="footerDescription footer-subscribe text-left col-10 offset-1 offset-sm-0 col-md-3 mb-3">
                <p class="footer-header">Newsletter</p>
                <?php
                if($_POST['SUBSCRIBE'] && !empty($_POST['email'])){

                    $subscriber = array();
                    $subscriber['email'] = $_POST['email'];

                    $validate = sql_read('select email from subscribers where email =? limit 1', 's', $subscriber['email']);
                    
                    if($validate['email']){
                        $subscribe_msg = '<div style="color:red;">Email not available..</div>';
                    }elseif(sql_save('subscribers', $subscriber)){
                        $subscribe_msg = '<div style="color:green;">Thank you for your subscription.</div>';
                    }
                }

                ?>
                <form class="search-wrapper" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group has-search">
                        <span class="fas fa-envelope form-control-feedback"></span>
                        <input name="email" type="email" class="form-control subscribe-input" placeholder="Enter your email address" required>
                    </div>
                    <input type="submit" name="SUBSCRIBE" value="SUBSCRIBE" class="btn text-white subscribe-btn">

                    <?php if($subscribe_msg) echo $subscribe_msg;?>
                </form>
            </div>
            <div class="d-block d-sm-none col-12"><br><br></div>
            <div
                class="footerDescription footer-links text-left col-10 offset-1 offset-sm-0 col-md-1 col-lg-1 mb-3">
                <p class="footer-header">Follow Us</p>
                <a href="https://www.facebook.com/GrocereMY" target="_blank">FACEBOOK</a><br />
                <a href="https://www.instagram.com/grocere_my/" target="_blank">INSTAGRAM</a><br />
                <a href="https://www.linkedin.com/company/grocere/" target="_blank">LINKEDIN</a><br />
            </div>
            <div class="d-block d-sm-none col-12"><br><br></div>
            <div
                class="footerDescription text-center col-12 col-md-3 mb-3">
                <p class="footer-header">Payment Method</p>
                <img class="logo img-fluid" src="images/payment.png" alt="payment logo" />
                

            </div>

            

        </div>



        <div class="row text-center" style="opacity:0.3; position:relative; top:22px; font-size:12px;">
            <div class="col-12">
                2020. Orient Biogreen Sdn. Bhd. All rights reserved. Powered by Quest Marketing.
            </div>
        </div>
    </div>
</div>


<?php /*
<!-- bottom navigation bar -->
<nav class="mobile-bottom-nav d-block d-md-none">
    <div class="row pt-2 no-gutters">
        <div class="col-3 mobile-bottom-nav__item mobile-bottom-nav__item--active">
            <a href="home">
                <div class="mobile-bottom-nav__item-content">
                    <i class="fas fa-home bottom-nav-icon"></i>
                    Home
                </div>
            </a>
        </div>
        <div class="col-3 mobile-bottom-nav__item">
            <a href="shopping">
                <div class="mobile-bottom-nav__item-content">
                    <i class="fas fa-shopping-cart bottom-nav-icon"></i>
                    Cart
                </div>
            </a>
        </div>
        <div class="col-3 mobile-bottom-nav__item">
            <a data-toggle="modal" data-target="#loginModal" href=#>
                <div class="mobile-bottom-nav__item-content">
                    <i class="fas fa-user bottom-nav-icon"></i>
                    Login
                </div>
            </a>
        </div>

        <div class="col-3 mobile-bottom-nav__item">
            <a data-toggle="modal" data-target="#categoryModal" href=#>
                <div class="mobile-bottom-nav__item-content">
                    <i class="fas fa-list bottom-nav-icon"></i>
                    Category
                </div>
            </a>
        </div>
</nav>
*/?>


<?php include 'modal/category_panel_modal.php';?>
<?php include 'modal/edit_delivery_address.php';?>
<?php include 'modal/edit_delivery_address2.php';?>
<?php include 'modal/no_points_alert.php';?>
<?php include 'modal/alert_modal.php'; ?>
<?php include_once 'config/session_msg.php';?>

<script src="js/custom.js"></script>
<script src="js/fewlines.js"></script>
<script src="js/functions.jquery.js"></script>
<script src="js/add_to_cart_button.js"></script>
