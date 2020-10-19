<?php 
session_start();

foreach($_POST as $k => $v){
	$_SESSION[$k]=$v;	
}

?>