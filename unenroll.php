<?php session_start();
//unenroll
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
	<h1>Manage Courses</h1>
	<p>View and remove enrolled courses</p>
	<div>
	<form method="post" action="manageCourse.php">
        <?php 
        $stmt1 = $con->prepare("SELECT courseID FROM enrolled_courses WHERE studentID = ?");
		$stmt1->bind_param("i",$_SESSION["studentID"]);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
		
		if ($result1->num_rows > 0) {
			while ($row1 = $result1->fetch_assoc()) {
			$courseID=$row1['courseID'];	
	
		$stmt2=$con->prepare("SELECT courseTitle FROM offered_courses WHERE courseID = ?");
		$stmt2->bind_param("i",$_SESSION["courseID"]);
		$stmt2->execute();
		$result2=$stmt2->get_result();
		
		if ($result2->num_rows > 0) {
			$row2 = $result2->fetch_assoc();
			echo '<input type="checkbox" name="checkboxes[]" value="' . $courseID . '">' . $row2["courseTitle"] . '<br>';	
			} 
        }
		}	
        ?>
		<input type="submit" name="removeBtn" value="Unenroll">
		</form>
    </div>
</body>
</html>