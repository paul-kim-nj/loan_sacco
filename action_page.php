<?php
include "connect.php";

// create a variable
$Name=mysqli_real_escape_string($conn, $_POST['Name']);
$ID_No=mysqli_real_escape_string($conn, $_POST['ID_No']);
$Mobile_no=mysqli_real_escape_string($conn, $_POST['Mobile_no']); 
$Email=mysqli_real_escape_string($conn, $_POST['Email']);
$password=mysqli_real_escape_string($conn, $_POST['password']);
$psw_repeat=mysqli_real_escape_string($conn, $_POST['psw_repeat']);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$Name = test_input($_POST["Name"]);
if (!preg_match("/^[a-zA-Z ]*$/",$Name)) {
  $nameErr = "Only letters and white space allowed"; 
}

$sql="INSERT INTO customer_details(Name,ID_No,Mobile_no,Email,password,psw_repeat)VALUES('$Name','$ID_No','$Mobile_no','$Email','$password','$psw_repeat')";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>