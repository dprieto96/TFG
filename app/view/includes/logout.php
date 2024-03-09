<?php
	if(session_start()){
		session_destroy();
		session_unset();
		header("Location: /TFG/index.php");
	}
	
	header("Location: /TFG/index.php");
