<?php
include 'login_form.php';

$conn = oci_connect("work","work", "localhost/XE");
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$var=$_SESSION['animal'];
session_destroy();

if(isset($_POST['accept'])) {
    
	
    $query = oci_parse($conn, "UPDATE user_account SET flag=1 where  user_email = '$var'" );
    $result = oci_execute($query, OCI_DEFAULT); 
	
	if($result)  
	{  
		oci_commit($conn);
		echo "Data added Successfully !";
	}
	else{
		echo "Error.";
	}
}
if(isset($_POST['ignore'])) {
    $query = oci_parse($conn, "delete from user_account  where  user_email = '$var'" );
    $result = oci_execute($query, OCI_DEFAULT); 
	
	if($result)  
	{  
		oci_commit($conn);
		echo "Data deleted Successfully !";
	}
	else{
		echo "Error.";
	}
}

?>