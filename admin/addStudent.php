<?php include '../functions.php'; 
if (!isAdmin()){
    header('location: ../login.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Attendance System</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="as-wrapper">
	<!-- Side Navbar -->
	<div class="as-sidenav">
		<h2>Attendance System</h2>
		<ul>
			<li><a href="../index.php"><i class="fas fa-home"></i>Home</a></li>
			<li><a href="adminAttandance.php"><i class="fas fa-project-diagram"></i>Attendance</a></li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Student
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="#">Add new Student</a>
					<a href="adminStudentList.php">List of Student</a>
				</div>
			</div>
			</li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Lecturer
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="addLecturer.php">Add new Lecturer</a>
					<a href="adminLecturerList.php">List of Lecturer</a>
				</div>
			</div></li>
			<li><a href="../index.php?logout='1'"><i class="fas fa-project-diagram"></i>Log Out</a></li>
		</ul>
	</div>
	<!-- Main section -->
	<div class="as-main_content">
		<!-- Header section -->
		<div class="as-header">
			<h1>Web Dev</h1>
			<a href="#" style="text-align: right;"><?php echo $_SESSION['user']['username']; ?></a>
		</div>
		<div class="as-info">
			<div>
			</div>
		</div>
		<!-- Content section -->
		<form action="addStudent.php" method="post" class="as-container" >
			<div class="as-header">Add New Student</div>
				<div class="as-content">
					<h3>Student ID</h3>
					<input class="inp" type="text" name="idstudent" required>
					<h3>Student Name</h3>
					<input class="inp" type="text" name="fullname" required>
					<h3>Phone Number</h3>
					<input class="inp" type="text" name="numberstudent" required>
					<h3>Address</h3>
					<textarea class="inp" rows="10" cols="30" name="address" required></textarea>
				</div>
				<div class="as-content-sm">
					<div class="input-box">
						<p>Select Class:</p>
						<input type="radio" name="kelas" value="1" checked>
						<label for="UTHM">UTHM</label><br>
						<input type="radio" name="kelas" value="2">
						<label for="UTM">UTM</label><br>
						<input type="radio" name="kelas" value="3">
						<label for="UITM">UITM</label>
						<BR><input type="radio" name="kelas" value="4">
						<label for="UPNM">UPNM</label>
						<br><input type="radio" name="kelas" value="5">
						<label for="UIA">UIA</label>
					</div>
					<button class="btn-outline" style="width: 20%"type="submit"
					name="student_btn">Submit</button>
				</div>
		</form> 
		<!-- Footer section -->
		<div class="as-footer">Attendance System 2021</div>
	</div>
</div>
</body>
</html>