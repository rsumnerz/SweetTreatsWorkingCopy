<?php

if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "annmarietorres@outlook.com";
    $email_subject = "ATTENTION: You have a order";
    $email_subject2 = "Your cake order confermation-do not reply to this email address";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();

    }
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['phone'])||
        !isset($_POST['email'])||
        !isset($_POST['pickUpDate'])){
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $phone = $_POST['phone'];//required
    $email_from = $_POST['email']; // required
    $pickUpDate= $_POST['pickUpDate']; // required
    
    $comments = $_POST['comments']; 
    $numPeople = $_POST['numPeople'];
    $cakeSize = $_POST['cakeSize'];
    $cakeFav = $_POST['cakeFav'];
    $cakeFil = $_POST['cakeFil'];
    $cakeIce = $_POST['cakeIce'];
    $cupCake = $_POST['cupCake'];
    $cupFav = $_POST['cupFav'];
    $cupIce = $_POST['cupIce'];
    $pic = $_POST['pic'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z\s.'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  } 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
     $phone_exp ="/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
  if(!preg_match($phone_exp, $phone)){
    $error_message .= 'The Phone Number you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Phone Number: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n"; 
    $email_message .= "Pick up date: ".$pickUpDate."\n\n";
    

    $email_message .= "Cake Size: ".$cakeSize."\n"; 
    $email_message .= "Number of people: ".$numPeople."\n";  
    $email_message .= "Cake Flavor: ".$cakeFav."\n";   
    $email_message .= "Cake Fill: ".$cakeFil."\n";   
    $email_message .= "Cake Icing: ".$cakeIce."\n\n";
    
    $email_message .= "Cup Cakes: ".$cupCake."\n";
    $email_message .= "Cup Cake Flavor: ".$cupFav."\n";
    $email_message .= "Cup Cake Icing: ".$cupIce."\n\n";   
    $email_message .= "Image on Cake: ".$pic."\n\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

//header for confermation email
$headers2 = 'From: '.$email_to."\r\n".
'Reply-To: '.$email_to."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_from, $email_subject2, $email_message, $headers2);
sleep(2);
echo "<meta http-equiv='refresh' content=\"0; url=http://nameincode.com/ThankYou.html\">";
?>
 
<?php
}
?>