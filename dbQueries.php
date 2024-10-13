<?php

$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "cst499_OnlineRegistration";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = mysqli_connect($serverName, $user, $pass, $databaseName);

if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
    exit();
}
	
$tableQuery = mysqli_query($con,
"CREATE TABLE IF NOT EXISTS student_registration (
    studentID INT(255) UNIQUE NOT NULL AUTO_INCREMENT,
    fName VARCHAR(30) NOT NULL,
    lName VARCHAR(40) NOT NULL,
    address VARCHAR(256) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    email VARCHAR(320) NOT NULL,
    password VARCHAR(32) NOT NULL,
    PRIMARY KEY (studentID))");
	
if (!$tableQuery) {
    echo "Error creating Student Registration table: " . mysqli_error($con);
} else {
    echo "Student registration table created successfully!\n";
}
$courseTable = mysqli_query($con,
"CREATE TABLE IF NOT EXISTS offered_courses (
	courseID INT(255) UNIQUE NOT NULL AUTO_INCREMENT,
	courseTitle VARCHAR (50) NOT NULL,
	totalEnrollments INT (20) NOT NULL,
	courseCredits INT (9) NOT NULL,
	PRIMARY KEY (courseID))");
if (!$courseTable) {
    echo "Error creating Offered Courses table: " . mysqli_error($con);
} else {
    echo "Offered courses table created successfully!\n";
}
$enrolledTable = mysqli_query($con, 
"CREATE TABLE IF NOT EXISTS enrolled_courses (
	registerID INT (255) UNIQUE NOT NULL AUTO_INCREMENT,
	studentID INT,
	courseID INT,
	PRIMARY KEY (registerID),
	FOREIGN KEY (studentID) REFERENCES student_registration(studentID),
	FOREIGN KEY (courseID) REFERENCES offered_courses(courseID))");
	
if (!$enrolledTable) {
    echo "Error creating Enrolled Courses table: " . mysqli_error($con);
} else {
    echo "Enrolled Courses able created successfully!";
}
?>