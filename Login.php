<?php 
session_start();
include('connect.php');

if(isset($_SESSION['loginCount']))
{
   
   if ($_SESSION['loginCount'] >= 3)
   {
     echo "<script>window.alert('PLease Try again in 1 Minute')</script>";
     echo "<script>window.location='LoginTimer.php'</script>";
   }

}
else if(!isset($_SESSION['loginCount']))
{
	$_SESSION['loginCount']=0;
}





if (isset($_POST['btnlogin'])) 
{
	$UserName=$_POST['txtUserName'];
	$Password=$_POST['txtpassword'];


	$sql="SELECT * FROM Customers WHERE UserName='$UserName' AND Password='$Password'";
	$query=mysqli_query($connection,$sql); 
	$count=mysqli_num_rows($query);


	if($count>0)
	{
		$row=mysqli_fetch_array($query);
		$_SESSION['CustomerID']=$row['CustomerID'];
		$_SESSION['UserName']=$row['UserName'];
		$_SESSION['Status']=$row['Status'];

		echo "<script>window.alert('Successfully Login')</script>";
		unset($_SESSION['loginCount']);
     	echo "<script>window.location='Customer.php'</script>";
	}
	else
	{
		$_SESSION['loginCount']++;
		echo "<script>window.alert('Invalid! Login Attempt:".$_SESSION['loginCount']."')</script>";
		echo "<script>window.location='Login.php'</script>";
		
	}

	
}
?>
<html>
<head>
	<title>Customer Login</title>
</head>
<?php 
if($_SESSION['loginCount']==2)
{
	echo "<script>window.alert('Next Time Login Failed will block you for 1 minute!')</script>"; 
	?>
<style type="text/css">
body {

  animation: ab 1.5s infinite;  /* IE 10+, Fx 29+ */

}

@-webkit-keyframes ab {
  0%, 49% {
    background: radial-gradient(circle, white, rgba(255,0,0,0.4));

  }
  50%, 100% {
    background-color: #fff;

  }
}


</style>
	<?php
}
 ?>

<body>
<form action="Login.php" method="post">
<table align="center">
	<tr>
		<td colspan="3"><h2>User Login</h2></td>
	</tr>
	<tr>
		<td>User Name</td>
		<td>::</td>
		<td><input type="text" name="txtUserName" required></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>::</td>
		<td><input type="password" name="txtpassword" required></td>
	</tr>
	<tr>
		<td><input type="submit" name="btnlogin" value="Login"></td>
		<td></td>
		<td><input type="reset" name="btncancel" value="Cancel"></td>
	</tr>
</table>
</form>
</body>
</html>