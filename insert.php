// create  a tablel in a database and create the required columns

<?php
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($password)) {
 $host = "localhost";
    $dbUsername = "saireddy";//Use your details
    $dbPassword = "********";//password for the database user
    $dbname = "record";//database name

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From users Where email = ? Limit 1";
     $INSERT = "INSERT Into users (firstname, lastname,email, password) values(?, ?, ?, ?)";//table name is users
     
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
