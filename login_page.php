<?php session_start();?>
<?php include_once 'dbQueries.php'; ?>

<?php

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $con->prepare("SELECT * FROM student_registration WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
	die ("Error logging in, please try again");
} else {
	
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$_SESSION['studentID'] = $row['studentID'];
		$_SESSION['fName'] = $row['fName'];
		$_SESSION['lName'] = $row['lName'];
		$_SESSION['email'] = $row['email'];
	}
	header("Location: profile.php");
	exit();
}
}
?>
