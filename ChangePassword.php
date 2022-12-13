<?php 
session_start();
include('connect.php');

$oldpassword="";
$confirm=false;

if(isset($_SESSION['CustomerID']))
{
	$CustomerID=$_SESSION['CustomerID'];
	$select=mysqli_query($connection,"SELECT * FROM Customers WHERE CustomerID='$CustomerID'");
	$row=mysqli_fetch_array($select);
	$oldpassword=$row['Password'];
}

if(isset($_POST['btnConfirm']))
{
	$cfmPassword=$_POST['txtOldPassword'];

	if($oldpassword==$cfmPassword)
	{
		$confirm=true;
	}
	else
	{
		$confirm=false;
		echo "<script>alert('Password does not match. Please Try again!')</script>";
		echo "<script>location='ChangePassword.php'</script>";
	}
}

if(isset($_POST['btnChange']))
{
	$newpsw=$_POST['txtNewPassword'];
	$confirmpsw=$_POST['txtConfirmPassword'];
	if($newpsw!=$confirmpsw)
	{
		echo "<script>alert('New and Confirm Password does not match. Please Try again!')</script>";
		echo "<script>location='ChangePassword.php'</script>";
	}
	else
	{
		$cid=$_SESSION['CustomerID'];
		$update=mysqli_query($connection,"UPDATE Customers SET Password='$newpsw' WHERE CustomerID='$cid'");
		echo "<script>alert('New Password is setup! Please Login again')</script>";
		echo "<script>location='Login.php'</script>";
	}

}

 ?>

<?php 
if($confirm==false)
{
	echo '<form action="ChangePassword.php" method="post">
	<table>
		<tr>
			<td>Enter Old Password</td>
			<td>
				<input type="password" name="txtOldPassword">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="btnConfirm" value="Confirm">
			</td>
		</tr>
	</table>
</form>';
}
else if($confirm==true)
{
	?>
	<form action="ChangePassword.php" method="post">
	<table>
		<tr>
			<td>New Password</td>
			<td>
				<input type="password" name="txtNewPassword">
			</td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td>
				<input type="password" name="txtConfirmPassword">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="btnChange" value="Change">
			</td>
		</tr>
	</table>
</form>
	<?php
}

 ?>




