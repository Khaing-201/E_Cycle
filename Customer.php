<?php 
session_start();
include('connect.php');

if(isset($_POST['btnRegister']))
{
	$name=$_POST['txtcname'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpswd'];
	$postaddress=$_POST['txtaddress'];
	$postcode=$_POST['txtpostcode'];
	$dob=$_POST['txtdob'];



		$insert= mysqli_query($connection,"INSERT INTO
		 Customers(UserName,Email,Password,DateOfBirth,Postcode,PostalAddress,Status)
		 values ( '$name','$email','$password','$dob','$postcode','$postaddress','new')");
		if ($insert) {

			echo "<script> alert(' Register Success!')</script>";
			echo "<script> location='Customer.php'</script>";
		}
		else
		{
			echo mysqli_error ($connection);
		}
}


 ?>




<html>
<head>
	<title></title>
</head>
<body>

	<form action="Customer.php" method="post">
<table>
<tr>
	<td>User Name</td>
	<td><input type="text" name="txtcname" placeholder="Eg: John"></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="email" name="txtemail" placeholder="Enter Email"></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="txtpswd" placeholder="Enter Password"></td>
</tr>
<tr>
	<td>Postal Address</td>
	<td><input type="text" name="txtaddress" placeholder="Enter Address No"></td>
</tr>
<tr>
	<td>Post Code</td>
	<td><input type="text" name="txtpostcode" placeholder="Enter PostCode"></td>
</tr>
<tr>
	<td>Date of Birth</td>
	<td><input type="date" name="txtdob" placeholder="Enter date"></td>
</tr>



</table>

		<input type="submit" name="btnRegister" value="Register">
		<input type="reset" name="btnCancel" value="Cancel">


		</form>
		<a href="CustomerProfile.php">View My Profile</a>


</body>
</html>
