<?php
	session_start();

function loggedin(){
	if (empty($_SESSION['admin'])){
		return false;
	}
	else if($_SESSION['admin'] == 'True'){
		return true;
	}
	return false;
}

function check_for_error(){
	if (empty($_SESSION['error'])){
            return;
            }
    else if ($_SESSION['error'] == 'error'){
    	echo '<p>The username and password you entered do not match the records in our database';
    	$_SESSION['error'] = '';
    }
}

?>