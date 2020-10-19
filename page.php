<?php 

require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';


if($_GET['i']){
    $id = $defender->encrypt('decrypt', $_GET['i']);
    $page = sql_read('select page from pages where id=? limit 1', 's', $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/item-numbering.css" rel="stylesheet" />
<style>
    body{ color:#333; overflow-x:hidden; font-family: 'MontserratRegular';}
    h1 {font-family: 'MontserratRegular'; color:#F32758;}
    h2{padding-top:30px; font-size:22px !important; font-family: 'MontserratRegular';}
    .page-menu-contain {background-color:#DDD; padding:40px 0;}
    .page-menu {border:1px solid #CCC; border-top:none; border-left:none; border-right:none; padding:10px 18px 10px 28px;}
    a > .page-menu {background-color:#DDD; transition:background-color .4s;}
    a > .page-menu:hover { background-color:#F32758;}
    .page-menu-contain h4 {padding-top:10px !important;}
</style>

<body class="container-fluid ">

    <?php include 'nav.php';?>

    <div class="row">
        <div class="col-12" style="padding-top:62px; min-height: calc(100vh - 199px);">

            <div class="row flex">
                <?php /*
                <div class="col-12 col-md-2 page-menu-contain">
                    <a href="home"><div class="page-menu"><h4>HOME</h4></div></a>
                    <div class="page-menu"><h4>GROCERE</h4></div>           
                    <a href="page?i=YjNPTlNwMStMV0s4ZGV5QmFQY3Qrdz09"><div class="page-menu">About Us</div></a>
                    <a href="page?i=YzU4YUQyV1JDNkFweEpqS0RJUUNaQT09"><div class="page-menu">Blog</div></a>
                    <a href="page?i=eEdKY0RXYW8zR3pUZCt4OUVvVi9vUT09"><div class="page-menu">Terms of Use</div></a>
                    <a href="page?i=NG1NYnNKckw4QzRhOGhkT0M5NXNMUT09"><div class="page-menu">Privacy Policy</div></a>

                    <div class="page-menu"><h4>CUSTOMER SERVICE</h4></div>                    
                    <a href="page?i=Znc1TktyblRWZHk4VVFUZFZJQzhwdz09"><div class="page-menu">Contact Us</div></a>
                    <a href="page?i=SExqeDlCMnlXZFkrcU96aW5kMUpxZz09"><div class="page-menu">Help</div></a>

                </div>*/?>

                <div class="col-12 col-lg-10 offset-lg-1" style="padding:50px; min-height:400px;">
                    <!-- col-md-10" style=" min-height:400px;"-->
                    <?php 
                    $page['page'] = str_replace('../../', '', $page['page']);
                    
                    echo $page['page'];?>
                </div>                
            </div>


        </div>
    </div>

    <?php include 'footer.php';?>

</body>
</html>
