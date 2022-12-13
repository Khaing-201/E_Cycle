<?php 
session_start();
include('connect.php');

if(!isset($_SESSION['CustomerID']))
{
 echo "<script>alert('Please Login First')</script>";
 echo "<script>location='Login.php'</script>";
}

if(isset($_REQUEST['action']))
{
	$cid=$_SESSION['CustomerID'];
	if($_REQUEST['action']=="buy")
	{
		echo "<script>alert('Thanks!Order Successful')</script>";
		$update=mysqli_query($connection,"UPDATE Customers SET Status='old' WHERE CustomerID='$cid'");
		$_SESSION['Status']="old";

 		echo "<script>location='shop.php'</script>";
	}
}


if(isset($_POST['btnSearch']))
{
	$input=$_POST['txtSearchValue'];
	$query="SELECT * FROM Products WHERE ModelNumber LIKE ('%$input%') OR Brand LIKE ('%$input%') OR Price='$input'";
	$select=mysqli_query($connection,$query);
	$count=mysqli_num_rows($select);

}
else
{
	$select=mysqli_query($connection,"SELECT * FROM Products");
	$count=mysqli_num_rows($select);
}


 ?>

 <form action="shop.php" method="post">
 	<input type="text" name="txtSearchValue" placeholder="search..">
 	<input type="submit" name="btnSearch" value="Search">
 	<?php 
 	for ($i=0; $i < $count; $i++) { 
 		$row=mysqli_fetch_array($select);
 		$Image=$row['Image'];
 		$Model=$row['ModelNumber'];
 		$Brand=$row['Brand'];
 		$Price=$row['Price'];
 		$PID=$row['ProductID'];


 		echo "<div>";
 			echo "<img src='$Image' width='400px'><br>";
 			echo "<b>$Model</b><br>";
 			echo "<b>$Brand</b><br>";
 			if($_SESSION['Status']=="new")
 			{
 				echo "<b><del>$Price US$</del></b><br>";
 				$promo=$Price-((15/100)* $Price);
 				echo "<b>$promo US$</b> 15% off for new customer<br>";
 			}
 			else
 			{
 				echo "<b>$Price US$</b><br>";
 			}
 			echo "<a href='ProductDetail.php?ProductID=$PID'>View Detail</a>";
 			echo "<a href='shop.php?action=buy'>Buy</a>";
 		echo "</div>";
 	}
 	 ?>
 </form>