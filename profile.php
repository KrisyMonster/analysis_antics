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
	if(ISSET($_POST["submitBtn"])) {
    $studentID = $_SESSION['studentID']; 
    $sql = ("SELECT * FROM enrolled_courses WHERE studentID = ?;");
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $studentID);
	$stmt->execute();
	$result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['courseTitle'] . "<br/>";
        }
    }
	}
	
    ?> </b>
 </div>
    <form method="POST" action="courseRegistration.html">
        <input name="submitBtn" type="submit" id="registerCourseBtn" value="Register Courses">
    </form>
 <form method="POST" action="manageCourse.php">
        <input name="submitBtn" type="submit" id="manageCourseBtn" value="Manage Enrollments">
    </form>			
</body>
</html>

