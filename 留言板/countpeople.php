<?php
	session_start();
	$file = fopen("countpeople.txt","r");
	$num = fgets($file);
	fclose($file);

	if($_SESSION['come'] !== "v") {
		$num ++;
		$file = fopen("countpeople.txt","w");
		fwrite($file, $num);
		fclose($file);
		$_SESSION['come'] = "v";
	}
	
?>