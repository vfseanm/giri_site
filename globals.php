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
    	echo '<div class="alert alert-danger fade in"><p>The username and password you entered do not match any records in our database.</p></div>';
    	$_SESSION['error'] = '';
    }
    else if ($_SESSION['error'] == 'exists'){
    	echo '<div class="alert alert-danger fade in"><p>The username that you have entered already exists.</p></div>';
    	$_SESSION['error'] = '';
    }
}

?>