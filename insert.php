<?php
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$tname = $firstname+$lastname;

if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($password)) {
 $host = "localhost";
    $dbUsername = "saireddy";
    $dbPassword = "saireddy@12";
    $dbname = "record";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From users Where email = ? Limit 1";
     $INSERT = "INSERT Into users (firstname, lastname,email, password) values(?, ?, ?, ?)";
     
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $firstname, $lastname,$email,$password );
      $stmt->execute();
      echo "<h1>Welcome $firstname $lastname</h1>";
      $name=$_POST['tname']
      header('Location: greeting.html');
     } else {
      echo "<h2>you already have an account try SignIn</h2>";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>