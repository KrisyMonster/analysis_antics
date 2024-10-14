<?php session_start();
//course registration
?>
<?php include_once 'dbQueries.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
	h1 {text-align: center;}
	h4 {text-align: center;}
	p {text-align: center;}
	div {text-align: center;}
	form {text-align: center;}
	href {text-align: center;}
	</style>

	</head>
	<body>
			<a href="home.html">Home</a>
			<a href="profile.php">Profile</a>
			<a href="logout.html">Logout</a>
	<h1>Course Registration</h1>
	<p>Please select the courses you would like to register for</p>
	<div>
	<form method="post" action="courseRegistrtion.php">
        <?php 
        $sql = $con->prepare("SELECT * FROM offered_courses");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //echo $row['courseTitle'] . "<br/>";
				echo '<input type="checkbox" name="checkboxes[]" value ="' .$row["courseID"] . '">' .$row["courseTitle"] . '<br>';
			} 
        } 
        ?>
		<input type="submit" value="enroll">
		</form>
    </div>
</body>
</html>
