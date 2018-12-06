













<?php
// define variables and set to empty values
$name_error = $email_error = $message_error = "";
$name = $email = $message = $sucess= "";

//form is submitted with POst method

if ($_SERVER["REQUEST_METHOD"] == "POST"){
   if (empty($_POST["name"])){
     $name_error = "Name is required";
   }else {
     $name = test_input($_POST["name"]);
     //check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/" ,$name)){
       $name_error = 'Only letters and white space allowed';
     }
   }
  if (empty($_POST["email"])){
    $email_error = "Email is required";
  }else {
    $email = test_input($_POST["email"]);
    //check if email is well formed
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email_error = "Invalid email format";
    }
  }
  if (empty($_POST["message"])){
     $message_error = "Please type a text to send";
  }else{
    $message = test_input($_POST["email"]);
  }

  if ($name_error == '' && $email_error == '' && $message_error == ''){
    $message_body = '';
    unset($_POST['Send']);
    foreach ($_POST as $key => $value){
      $message_body .= "$key: $value\n";
    }

       $name = $_POST['name'];
       $email = $_POST['email'];
       $message = $_POST['message'];
       $mailTo ="david.j@codeur.online";
       $txt = "You have a received an email from " .$name.".\n\n".$message;

     if(mail($mailTo, 'formulaire de contact', $txt)){
       $sucess = "Congratulations your mail has been send";
       $name=$email=$message='';
      //header("Location: index.php?mailsend");
     }


  }
}

function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



 ?>





<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mail me right here</title>
</head>

<body>

<div>
    <?php
  echo '<ul>';

      echo nl2br($name_error. "\n");
      echo nl2br($email_error. "\n");
      echo nl2br($message_error. "\n");



echo '</ul>';
 ?>
</div>

<form action="index.php" method="post">
  <label>
    Your Name *
    <input type="text" name="name" autofocus >

  </label>

  <label>
    Your email adress *
    <input type="text" name="email" >

  </label>

  <label>
    Your message *
    <textarea  name="message" rows="8"></textarea>

  </label>

  <input type="submit" value="Send" name="Send">

  <p > * means a required field </p>
</form>
<div><?php echo $sucess ?></div>

</body>
</html>
