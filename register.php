<?php

if (!empty($_POST["register_ss"])){
    if($_POST['password'] != $_POST ['psw_repeat']){
        $error_message = "*Passwords do not match<br>";
    }
}

if (empty($error_message)) {
    require ("connect.php");
     if (isset($_POST['Name'], $_POST['ID_No'], $_POST['Mobile_no'], $_POST['Email'], $_POST['password'], $_POST['psw_repeat'])){

       # code...
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
    }

}
?>

<html>

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
.Login{
    float: right;
    width: 20%
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
<body>
<h2>Sign Up Form  <span><button type  = "button" class="Login">Log In</button></span></h2> 
<form name="registration_form" action="" method = "post" style="border:1px solid #ccc">
  <div class="container">
    <div style="color:red;"><?php if (isset($error_message)) echo $error_message;?></div>

	<label><b>Name</b></label>
	<input type="text" placeholder="Enter Name as it Appears on ID" name="Name" required pattern = "[ |a-zA-Z]+" title=" Only letters and white spaces allowed">
	
	<label><b>National ID number</b></label>
	<input type="text" placeholder="Enter National ID number" name="ID_No" maxlength="8" required pattern="[0-9]+" title = "Write a valid Id Number">
	
	<label><b>Mobile Number</b></label>
	<input type="text" placeholder="Mobile Number" name="Mobile_no" maxlength="13" required pattern="[0-9]+" title = "Enter your mobile number">
	
    <label><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="Email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <label><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw_repeat" required>


    <input type="checkbox" checked="checked"> Remember me
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button><span><input type="submit" name="register_ss" class="submit"></span>
    </div>
  </div>
</form>

</body>
</html>