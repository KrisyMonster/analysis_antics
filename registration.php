<?php session_start();?>
<?php include_once 'dbQueries.php'; ?>

<?php
if(ISSET($_POST["submitBtn"])) {
	
	$u_fName = $_POST["firstName"];
	$u_lName = $_POST["lastName"];
	$u_address = $_POST["address"];
	$u_phone = $_POST["phone"];
	$u_email = $_POST["email"];
	$u_pass = $_POST["password"];
	
$saveResults = $con->prepare("INSERT into student_registration (fName, lName, address, phone, email, password) VALUES (?, ?, ?, ?, ?, ?)");
$saveResults->bind_param("ssssss", $u_fName, $u_lName, $u_address, $u_phone, $u_email, $u_pass);
$saveResults->execute();
if (!$saveResults) {
	die ("Error saving registration, please try again");
} else {
	header("Location: login_page.html");
}
$saveResults->close();

}
?>
