<?php
//manageCourse.php
include_once 'dbQueries.php';
include_once 'courseRegistration.php';
?>
<?php
if(isset($_POST["submit"])) {
	
if(ISSET($_POST["checkboxes"])) {
	foreach ($_POST["checkboxes"] as $courseID) {
		
	$studentID = $_SESSION["studentID"];
	$courseID = $_SESSION["courseID"];
	
	if ($con) {
		$stmt1= "SELECT studentID FROM student_registration WHERE studentID = ?";
		$stmt1=$con->prepare($stmt1);
		$stmt1->bind_param("i",$_SESSION["studentID"]);
		$stmt1->execute();
		$result1=$stmt1->get_result();
	
		
		$stmt2=("SELECT courseID FROM offered_courses WHERE courseID = ?");
		$stmt2=$con->prepare($stmt2);
		$stmt2->bind_param("i",$_SESSION["courseID"]);
		$stmt2->execute();
		$result2=$stmt2->get_result();
	
		if ($result1->num_rows > 0 && $result2->num_rows > 0) {
			$row1 = $result1->fetch_assoc();
			$row2 = $result2->fetch_assoc();
			
		
			$stmt3="INSERT INTO enrolled_courses (studentID, courseID) VALUES (?,?)";
			$stmt3=$con->prepare($stmt3);
			$stmt3->bind_param("ii", $row1["studentID"], $row2["courseID"]);
				if ($stmt3->execute()) {
					echo "Thank you for enrolling!";
					header("Location: profile.php");
					exit();
				}
				 else {
					echo "Error updating enrollment, please try again.";
				} 
		}
	}
	}
}
}


if (isset($_POST["removeBtn"])) {
    if (isset($_POST["checkboxes"])) {
        foreach ($_POST["checkboxes"] as $courseID) {
           
            $stmt = $con->prepare("DELETE FROM enrolled_courses WHERE studentID = ? AND courseID = ?");
            $stmt->bind_param("ii", $_SESSION["studentID"], $courseID);
            $stmt->execute();
 
        }
    }
}
?>
