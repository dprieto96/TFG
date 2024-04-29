<?php
	if(session_start()){
		session_destroy();
		session_unset();
		header("Location: ../../index.php");
	}
	
	header("Location: ../../index.php");
