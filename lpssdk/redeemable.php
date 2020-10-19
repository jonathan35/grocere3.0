<?php 
session_start();


//LPS
$api = 'http://ihosting360.com/lps/api/redeemable.php';
$api_key = 'jbdsai129dpias';


//------------------- Retail Outlet Site only - Start -------------------------
//Capture LPS Token - 
if(!empty($_POST['lps_token'])){
    $_SESSION['lps_token'] = $_POST['lps_token'];
}
//wphp.hopto.org can't get $_POST['lps_token']
$_SESSION['lps_token'] = '5f8651144d518';

if(!empty($_SESSION['lps_token'])){
    $lps_token = $_SESSION['lps_token'];
}


class lps_tool{

    function lps_curl($api_fields, $echo = false){

        global $api;

        $api_params = http_build_query($api_fields);
        $gapi = curl_init();
        curl_setopt($gapi, CURLOPT_URL, $api);
        curl_setopt($gapi, CURLOPT_POST, count($api_fields));
        curl_setopt($gapi, CURLOPT_POSTFIELDS, $api_params);
        if($echo == false){
            curl_setopt($gapi, CURLOPT_RETURNTRANSFER, 1);
            return curl_exec($gapi);
        }else{
            curl_exec($gapi);
        }
        curl_close($gapi);
    }    


    function decrypt($str, $skey) {
        $output = false;
        $encrypt_method = "AES-256-CBC";    
        $secret_iv = '82396243ads89124hjw8951w4890e75143';
        $key = hash('sha256', $skey);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($str), $encrypt_method, $key, 0, $iv);
        return $output;
    }    

    function encrypt($str, $skey) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = '82396243ads89124hjw8951w4890e75143';
        $key = hash('sha256', $skey);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($str, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

}
$lps_tool = new lps_tool;


class lps_retail{


    function point_spent($order_ref){
                
        $lps_tool = new lps_tool;
        global $email, $skey, $mid, $api_key;
        
        if(empty($order_ref)){
            return false;
        }
        
        $api_fields = array(
            'm' => $lps_tool->encrypt($mid, $api_key),
            'e' => $lps_tool->encrypt($email, $skey),
            'u' => $lps_tool->encrypt($order_ref, $skey),
            'a' => 'point_spent'
        );
        return $lps_tool->lps_curl($api_fields);
    }

    function ro_connect(){
        
        $lps_tool = new lps_tool;
        global $lps_token, $api_key;

        if(empty($lps_token)){
            return false;
        }
        $api_fields = array(
            'token' => $lps_tool->encrypt($lps_token, $api_key),
            'a' => 'ro_connect'
        );
        return $lps_tool->lps_curl($api_fields);
    }
}
$lps_retail = new lps_retail;


$ro_connect = $lps_retail->ro_connect();

if(!empty($ro_connect)){
    $ro_data = json_decode($lps_tool->decrypt($ro_connect, $api_key), true);
    $mid = $ro_data['mid'];
    $skey = $ro_data['skey'];    
    $email = $ro_data['email'];
    $retail_id = $ro_data['retail_id'];
}
//------------------- Retail Outlet Site only - End -------------------------


class lps_merchant{
    

    function refund_points($refund_percent, $order){
        
        $lps_tool = new lps_tool;
        global $email, $skey, $mid, $api_key;

        $api_fields = array(
            'm' => $lps_tool->encrypt($mid, $api_key),
            'e' => $lps_tool->encrypt($email, $skey),
            'r' => $lps_tool->encrypt($refund_percent, $skey),
            'u' => $lps_tool->encrypt($order, $skey),
            'a' => 'refund_points'
        );
        return $lps_tool->lps_curl($api_fields);
    }
    

    function inoutCoins($total = null, $reference = null){
        
        $lps_tool = new lps_tool;
        global $email, $skey, $mid, $api_key, $retail_id;

        $api_fields = array(
            'm' => $lps_tool->encrypt($mid, $api_key),
            'e' => $lps_tool->encrypt($email, $skey),
            't' => $lps_tool->encrypt($total, $skey),
            'u' => $lps_tool->encrypt($reference, $skey),
            'ro' => $lps_tool->encrypt($retail_id, $skey),
            'a' => 'inoutCoins'
        );
        return $lps_tool->lps_curl($api_fields);
    }



    function switch_check(){
        
        $lps_tool = new lps_tool;
        global $email, $skey, $mid, $api_key;

        $api_fields = array(   
            'm' => $lps_tool->encrypt($mid, $api_key),
            'e' => $lps_tool->encrypt($email, $skey),
            'a' => 'switch_check'
        );
        return $lps_tool->lps_curl($api_fields);
    }



    function redeemable_switch($total = null){

        $lps_tool = new lps_tool;

        if(empty($total)){
            echo '0';
        }else{

            $checked = $this->switch_check();
            if($checked){
                $checker = 'checked';
            }else{
                $checker = '';
            }

            $_SESSION['lps_total_'.session_id()] = $total;

            echo '
            <span class="lpssdk">
                <label class="switch">
                    <input type="checkbox" id="redeemChecker" '.$checker.'>
                    <span class="slider round" onclick="redeemChecker()">
                        <span>
                            -RM';

                            global $email, $skey, $mid, $api, $api_key, $retail_id;
                            $redeemableRM = '';
                            
                            $getRMFields = array(
                            'm' => $lps_tool->encrypt($mid, $api_key),
                            'e' => $lps_tool->encrypt($email, $skey),
                            't' => $lps_tool->encrypt($total, $skey),
                            'ro' => $lps_tool->encrypt($retail_id, $skey),
                            'a' => 'getRM'
                            );
                            $api_params = http_build_query($getRMFields);
                            $getRM = curl_init();
                            curl_setopt($getRM, CURLOPT_URL, $api);
                            curl_setopt($getRM, CURLOPT_POST, count($getRMFields));
                            curl_setopt($getRM, CURLOPT_POSTFIELDS, $api_params);
                            $redeemableRM = curl_exec($getRM);
                            curl_close($getRM);
                            echo'
                        </span>
                    </span>
                </label>
            </span>';
        }
    }

    function get_redeemable_point($total = null){

        $lps_tool = new lps_tool;

        if(empty($total)){
            echo '0';
        }else{
            
            global $email, $skey, $mid, $api_key, $retail_id;
            $redeemableCoins = '';
            
            $api_fields = array(
            'm' => $lps_tool->encrypt($mid, $api_key),
            'e' => $lps_tool->encrypt($email, $skey),
            't' => $lps_tool->encrypt($total, $skey),
            'ro' => $lps_tool->encrypt($retail_id, $skey),
            'a' => 'getCoins'
            );
            return $lps_tool->lps_curl($api_fields);
        }

    }


    function encrypted_email() {
        $lps_tool = new lps_tool;
        global $email, $skey;
        return $lps_tool->encrypt($email, $skey);
    }
    
}
$lps_merchant = new lps_merchant;
?>

<style>    
.lpssdk .switch {
position: relative;
display: inline-block;
width: 50px;
height: 16px;
margin:0 auto;
}
.lpssdk .switch input { opacity: 0;width: 0;height: 0;}
.lpssdk .slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}
.lpssdk .slider:before {
position: absolute;
content: "";
height: 24px;
width: 24px;
left: 4px;
box-shadow:1px 1px 3px rgba(0,0,0,.4);
bottom: -4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;}
.lpssdk input + .slider > span {   position:relative; top:24px; display:none;}
.lpssdk input:checked + .slider {background-color: rgb(0, 184, 153);}
.lpssdk input:checked + .slider > span {    color:#00b899;}
.lpssdk input:checked + .slider + .redeemAmt {    color:#00b899;}
.redeemAmt { top:-20px;}
.lpssdk input:focus + .slider {box-shadow: 0 0 1px rgb(0, 184, 153);}
.lpssdk input:checked + .slider:before {
-webkit-transform: translateX(20px);
-ms-transform: translateX(20px);
transform: translateX(20px);
}
/* Rounded sliders */
.lpssdk .slider.round {border-radius: 34px;}
.lpssdk .slider.round:before {border-radius: 50%;}

</style><?php


$action = $_GET['action'];


if($action == 'onRedeem' || $action == 'offRedeem'){

    $total = $_SESSION['lps_total_'.session_id()];
    $session_id = session_id();
    
    $api_fields = array(
        'm' => $lps_tool->encrypt($mid, $api_key),
        'e' => $lps_tool->encrypt($email, $skey),
        't' => $lps_tool->encrypt($total, $skey),
        's' => $lps_tool->encrypt($session_id, $skey),
        'a' => $action
    );
    $lps_tool->lps_curl($api_fields, true);

}elseif($action == 'getReducedTotal'){//get redeemed amount

    $api_fields = array(
        'm' => $lps_tool->encrypt($mid, $api_key),
        'e' => $lps_tool->encrypt($email, $skey), 
        's' => $lps_tool->encrypt($session_id, $skey),       
        'a' => 'getReducedTotal'
    );
    $lps_tool->lps_curl($api_fields, true);

}
?>
  