<? 
session_start();


foreach($_SESSION as $a => $v){
    unset($_SESSION[$a]);
}

?>
