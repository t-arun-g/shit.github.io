<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="style.css" rel="stylesheet" type="text/css">  -->
	<title>Email's Experiment</title>
	<link href='https://fonts.googleapis.com/css?family=Lato:100italic' rel='stylesheet' type='text/css'> 

<style>
  .malss {
  overflow: hidden;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 200px;
  font-size: 15px;
  font-family: Courier New;
  font-weight: bold;
}
body {
background-image: url(hello.jpg);
background-size:1600px ;
}

.topnav {
  overflow: hidden;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  padding-left: 200px;

}

.topnav a {
  font-weight: bold;
  float: left;
  display:block;
  color: white;
  text-align: center;
  font-family: Lato;
  font-size: 25px;

  padding: 14px 16px;
  text-decoration: none;
}

.topnav a:hover{
   text-decoration:underline ;
}
</style>

</head>


<body>

<h1 style="text-align: center; font-family:Aileron,Verdana, Arial, Helvetica, sans-serif; color: white; padding-top: 30px;
  padding-right: 30px;
  padding-bottom: 30px;
  padding-left: 20px;">EMAIL TO GO </h1>


<div class="topnav">
  <a href="https://www.iitk.ac.in/counsel/index.php" style="font-family:Calibri;font-weight: bold;" >CS-IITK</a>
  <a href="https://www.iitk.ac.in/counsel/team.php">Team</a>
  <a href="#">Services</a>
  <a href="#">Appointments</a>
  <a href="#">Support</a>
  <a href="#">Info for Students</a>
  <a href="#">Selfhelp</a>
  <a href="#">Emergency</a>
</div>

<div>
  
</div>


<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Subject: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>




<?php


  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
$mail = new PHPMailer(true);


$mail = new PHPMailer(true);

try {
 
                  
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'gtarung1234@gmail.com';                    
    $mail->Password   = 'zsuwxuspmkziuyhy';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('gtarung1234@gmail.com', 'RUNGO');

    $mail->addAddress($email);             


    $mail->isHTML(true);                                 
    $mail->Subject = $website;
    $mail->Body    = $comment;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>











</body>
</html>
