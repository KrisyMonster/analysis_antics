<?php
session_start();
include_once 'dbQueries.php';
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
</style>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="registration.html">Register</a>
    <a href="logout.html">Logout</a>        
    <h1>Welcome</h1>
    <p>Student Profile</p>
    <div>
        <b>Name: <?php echo $_SESSION['fName'] . " " . $_SESSION['lName']; ?></b><br/>
        <b>Email: <?php echo $_SESSION['email']; ?></b><br/>
		<b>Scheduled Courses:
<div>
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
			while ($row2 = $result2->fetch_assoc()) {
		echo $row2["courseTitle"] . '<br>';
			}
		}
			}
		} else {
			echo "No courses enrolled. Click Register Courses to get started";
		}
	
    ?> 
	</b>
 </div>
    <form method="POST" action="courseRegistration.php">
        <input name="submitBtn" type="submit" id="registerCourseBtn" value="Register Courses">
    </form>
	 <form method="POST" action="unenroll.php">
        <input name="submitBtn" type="submit" id="manageCourseBtn" value="Manage Enrollments">
    </form>
</body>
</html>

