<?php 
session_start();
include('connect.php');

if(isset($_POST['btnRegister']))
{
	$model=$_POST['txtmodel'];
	$brand=$_POST['txtBrand'];
	$battery=$_POST['txtBattery'];
	$color=$_POST['txtColor'];
	$price=$_POST['txtPrice'];
	$quantity=$_POST['txtQuantity'];

	$Image=$_FILES['filImage']['name'];
	if($Image)
	{
		$folder="Images/";
		$path=$folder.$Image;
		$copied=copy($_FILES['filImage']['tmp_name'], $path);
		if(!$copied)
		{
			echo "Error";
		}
		else
		{
			$insert=mysqli_query($connection,"INSERT INTO Products(ModelNumber,Brand,Battery,Color,Price,Quantity,Image) VALUES('$model','$brand','$battery','$color','$price','$quantity','$path')");
			if($insert)
			{
				echo "<script>alert('Save Product!')</script>";
				echo "<script>location='Product.php'</script>";
			}
		}
	}


}

 ?>

 <form action="Product.php" method="post" enctype="multipart/form-data">
 	<table>
 		<tr>
 			<td>Model Number</td>
 			<td>
 				<input type="text" name="txtmodel" required="">
 			</td>
 		</tr>
 		<tr>
 			<td>Brand</td>
 			<td>
 				<input type="text" name="txtBrand" required="">
 			</td>
 		</tr>
 		<tr>
 			<td>Battery Type</td>
 			<td>
 				<input type="text" name="txtBattery" required="">
 			</td>
 		</tr>
 		<tr>
 			<td>Color</td>
 			<td>
 				<input type="text" name="txtColor" required="">
 			</td>
 		</tr>
 		<tr>
 			<td>Price</td>
 			<td>
 				<input type="number" name="txtPrice" required=""> US$
 			</td>
 		</tr>
 		<tr>
 			<td>Quantity</td>
 			<td>
 				<input type="number" name="txtQuantity" required="">
 			</td>
 		</tr>
 		<tr>
 			<td>Image</td>
 			<td>
 				<input type="file" name="filImage" required="">
 			</td>
 		</tr>
 		<tr>
 			<td></td>
 			<td>
 				<input type="submit" name="btnRegister" value="Register">
 			</td>
 		</tr>

 	</table>
 </form>


 <table border="1" width="100%">
 	<tr>
 		<th>Image</th>
 		<th>Model</th>
 		<th>Brand</th>
 		<th>Battery</th>
 		<th>Color</th>
 		<th>Price</th>
 		<th>Quantity</th>
 		<th>Action</th>
 	</tr>
 	<?php 
 	$select=mysqli_query($connection,"SELECT * FROM Products");
 	$count=mysqli_num_rows($select);
 	if($count>0)
 	{
 		for ($i=0; $i < $count ; $i++) { 
 			$data=mysqli_fetch_array($select);
	 		echo "<tr>";
	 			echo "<td><img src='".$data['Image']."' width='200px'></td>";
	 			echo "<td>".$data['ModelNumber']."</td>";
	 			echo "<td>".$data['Brand']."</td>";
	 			echo "<td>".$data['Battery']."</td>";
	 			echo "<td>".$data['Color']."</td>";
	 			echo "<td>".$data['Price']."</td>";
	 			echo "<td>".$data['Quantity']."</td>";
	 			echo "<td><a href='ProductUpdate.php'>Update</a> | <a href='ProductDelete.php'>Delete</a></td>";
	 		echo "</tr>";
 		}
 	}
 	else
 	{
 		echo "No product found!";
 	}

 	 ?>
 </table>