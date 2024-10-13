<?php session_start();
//course registration
?>
<?php 
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "cst499_OnlineRegistration";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = mysqli_connect($serverName, $user, $pass, $databaseName);

$result = $con->query("SELECT * FROM offered_courses");

while ($row = $result->fetch_assoc()) {
	echo "<div">;
	echo "<h2>" .$row['courseTitle'] . "<h2>";
	echo "<p>courseCredits: " .$row['courseCredits'] . "<p>";
	echo "<form method='post' action='enroll_in_course.php'>">;
	echo "<input type ='hidden' name='courseID' value='" . $row['courseID']."'>";
	echo "<input type='submit' value='Enroll in course'>";
	echo "</form>";
	echo "</div>";
}
?>