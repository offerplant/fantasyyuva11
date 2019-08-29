<?php
$dir = "flag";

// Sort in ascending order - this is default
$a = scandir($dir);


foreach( $a as $f)
{
	$new_name = 'flag1/'.strtolower(substr($f,8));
	rename( 'flag/'.$f, $new_name) ; 
}

// print_r($a);
// print_r($b);
?>

