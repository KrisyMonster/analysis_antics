<?php 
session_start();?>
<?php 

$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "cst499_OnlineRegistration";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = mysqli_connect($serverName, $user, $pass, $databaseName);

$sql = mysqli_query($con, "SELECT * FROM student_registration WHERE email='email' AND password='password'");

if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_array($sql);
    header("Location: profile.html");
    exit();
} else {
    header("Location: login_page.html");
	//echo "Invalid login credentials, please try again";
    exit();
}
?>

