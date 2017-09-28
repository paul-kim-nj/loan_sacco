<?php
session_start();
require("connect.php");
   
$message="";
if(!empty($_POST["login"])) {
   if (isset ($_POST['Email'], $_POST ['password'] )){
            $Email=mysqli_real_escape_string($conn, $_POST['Email']);
            $password=mysqli_real_escape_string($conn, $_POST['password']); 
      $result = mysqli_query($conn,"SELECT * FROM customer_details WHERE Email='$Email' and Password = '$password'");
      $row  = mysqli_fetch_array($result);
      if(is_array($row)) {
      $_SESSION["Name"] = $row['Name'];
      header("location:homepage.php?success");
      
      } else {
      $message = "Invalid Username or Password!";
      }
   }
}
if(!empty($_POST["logout"])) {
   $_SESSION["Name"] = "";
   session_destroy();
}
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
<div>
<div style="display:block;margin:0px auto;">
<?php if(empty($_SESSION["Name"])) { ?>
<form action="" method="post" id="frmLogin">
   <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div> 
   
      <label>Email</label>
      <input name="Email" type="text" class="">

      <label>Password</label>
      <input name="password" type="password" class=""> 
   
      <input type="submit" name="login" value="Login" class="">         
</form>
<?php 
} else { 
   $result = mysqli_query($conn,"SELECT * FROM customer_details WHERE Name='" . $_SESSION["Name"] . "'");
   $row  = mysqli_fetch_array($result);
   ?>
   <form action="/homepage.php?success" method="post" id="frmLogout">
   <div class="member-dashboard">Welcome <?php echo ucwords($row['Name']); ?>, You have successfully logged in!<br>
   Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
   </form>
   </div>
   </div>
<?php  }  ?>
</body>
</html>
<style>
/* Full-width input fields */
input[type=text], input[type=email], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type=submit] {
        background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.submit {
    float: left;
    width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .submit {
       width: 100%;
    }
}
</style>
