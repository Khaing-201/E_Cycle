<?php 
include('connect.php');

if(isset($_REQUEST['txtName']))
{
	echo "<script>alert('Please check FAQs before we submit your question!')</script>";
	$name=$_REQUEST['txtName'];
	$email=$_REQUEST['txtEmail'];
	$ask=$_REQUEST['txtAsk'];
}

if(isset($_POST['btnAsk']))
{
	$CName=$_POST['txtCName'];
	$CEmail=$_POST['txtCEmail'];
	$CAsk=$_POST['txtCAsk'];

	$insert=mysqli_query($connection,"INSERT INTO faqs(Question) VALUES ('$CAsk')");
	if($insert)
	{
		echo "<script>alert('Question Submitted! Thanks for asking, we will answer back to your email as soon as possible.')</script>";
		echo "<script>location='Contact Us.php'</script>";
	}
}

$select=mysqli_query($connection,"SELECT * FROM faqs");
$count=mysqli_num_rows($select);
 ?>

<form action="FAQs.php" method="post">
	<input type="hidden" name="txtCName" value="<?php echo $name ?>">
	<input type="hidden" name="txtCEmail" value="<?php echo $email ?>">
	<input type="hidden" name="txtCAsk" value="<?php echo $ask ?>">
	
	<h2>Frequently ask Questions</h2>

<?php 
for ($i=1; $i <=$count ; $i++) { 
	$row=mysqli_fetch_array($select);
	?>
	
	<div>
		<b><i>Question <?php echo $i ?> :</i></b>
		<?php echo $row['Question'] ?>
	</div>
	<div>
		<b><i>Answer <?php echo $i ?> :</i></b>
		<?php echo $row['Answer'] ?>
	</div>
	<?php
}
 ?>
 <input type="submit" name="btnAsk" value="Ask Anyway">
</form>