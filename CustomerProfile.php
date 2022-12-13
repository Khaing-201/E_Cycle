<?php 
session_start();
include('connect.php');

if(isset($_SESSION['CustomerID']))
{
	$CustomerID=$_SESSION['CustomerID'];
	$select=mysqli_query($connection,"SELECT * FROM Customers WHERE CustomerID='$CustomerID'");
	$row=mysqli_fetch_array($select);
}
 ?>

 <table border="1">
 	<tr>
 		<td>UserName</td>
 		<td><?php echo $row['UserName'] ?></td>
 	</tr>
 	<tr>
 		<td>Email</td>
 		<td><?php echo $row['Email'] ?></td>
 	</tr>
 	<tr>
 		<td>Date of Birth</td>
 		<td><?php echo $row['DateofBirth'] ?></td>
 	</tr>
 	<tr>
 		<td>Postal Address</td>
 		<td><?php echo $row['PostalAddress'] ?></td>
 	</tr>
 	<tr>
 		<td>Post Code</td>
 		<td><?php echo $row['PostCode'] ?></td>
 	</tr>
 </table>
 <a href="">Update Profile</a>

 <a href="ChangePassword.php">Change Password</a>