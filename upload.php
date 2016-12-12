<?php
 
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
if(isset($_FILES) && (bool) $_FILES) {
  
	$allowedExtensions = array("pdf","doc","docx","gif","jpeg","jpg","png","rtf","txt");
	
	$files = array();
	foreach($_FILES as $name=>$file) {
		$file_name = $file['name']; 
		$temp_name = $file['tmp_name'];
		$file_type = $file['type'];
		$path_parts = pathinfo($file_name);
		$ext = $path_parts['extension'];
		if(!in_array($ext,$allowedExtensions)) {
			die("File $file_name has the extensions $ext which is not allowed");
		}
		array_push($files,$file);
	}
	
	 // validation expected data exists
    if(!isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['phone'])||
        !isset($_POST['email'])){
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    //new code end
	// email fields: to, from, subject, and so on
	$to = "AnnMarieTorres@outlook.com";
	$from = $_POST['email'];//required
	$fname = $_POST['fname'];//required
	$lname = $_POST['lname']; //required
	$phone = $_POST['phone'];//required
	$subject ="picture cake attachment"; 
	$error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z\s.'-]+$/";
  if(!preg_match($string_exp,$fname)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  } 
  if(!preg_match($string_exp,$lname)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
     $phone_exp ="/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
  if(!preg_match($phone_exp, $phone)){
    $error_message .= 'The Phone Number you entered does not appear to be valid.<br />';
  }
  
  if(strlen($error_message) > 0) {
    die($error_message);
  }
	$message = "Form details below.\n\n";
 	
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    } 
    $message .= "First Name: ".clean_string($fname)."\n";
    $message .= "Last Name: ".clean_string($lname)."\n";
    $message .= "Phone Number: ".clean_string($phone)."\n";
    $message .= "Email: ".clean_string($from)."\n";  
	
	$headers = "From: $from";
	
	// boundary 
	$semi_rand = md5(time()); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	 
	// headers for attachment 
	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
	 
	// multipart boundary 
	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
	$message .= "--{$mime_boundary}\n";
	 
	// preparing attachments
	for($x=0;$x<count($files);$x++){
		$file = fopen($files[$x]['tmp_name'],"rb");
		$data = fread($file,filesize($files[$x]['tmp_name']));
		fclose($file);
		$data = chunk_split(base64_encode($data));
		$name = $files[$x]['name'];
		$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" . 
		"Content-Disposition: attachment;\n" . " filename=\"$name\"\n" . 
		"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
		$message .= "--{$mime_boundary}\n";
	}
	// send
	 
	$ok = mail($to, $subject, $message, $headers); 
	if ($ok) { 
		echo "<p>mail sent to $to!</p>"; 
	} else { 
		echo "<p>mail could not be sent!</p>"; 
	} 
}	
 
?>