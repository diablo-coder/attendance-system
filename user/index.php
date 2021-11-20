<?php include '../functions.php'; 
	if (!isLoggedIn()){
    header('location: ../login.php');
  }
$IdKelas=$_SESSION['user']['idKelas'];
  $kelas = mysqli_query($db, "SELECT * FROM kelas WHERE idKelas='$IdKelas' LIMIT 1");
  $arr4 = mysqli_fetch_assoc($kelas);
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
			<li><a href="#"><i class="fas fa-home"></i>Home</a></li>
			<li><a href="studentList.php"><i class="fas fa-clipboard-check"></i>Student</a></li>
			<li><div class="as-dropdown">
				<button class="as-dropdownBtn">Attandance
					<i class="fas fa-caret-down"></i>
				</button>
				<div class="as-dropdown-content">
					<a href="newAttandance.php">Add new Attandance</a>
					<a href="attendanceList.php">List of Attandance</a>
				</div>
			</div></li>
			<li><a href="index.php?logout='1'"><i class="fas fa-project-diagram"></i>Log Out</a></li>
		</ul>
	</div>
	<!-- Main section -->
	<div class="as-main_content">
		<!-- Header section -->
		<div class="as-header"><h1>Web Dev</h1>
			<a href="#" style="text-align: right;">{<?php echo $_SESSION['user']['nama']; ?>}
				{<?php echo $arr4['namaKelas']; ?>}
			</a>
		</div>
		<div class="as-info">
			<div class="as-container">
				<div class="as-header">Main Page</div>
				<div class="as-content" style="border: thin solid black;">
					Hai sini main
				</div>
				<div class="as-content-sm" style="border: thin solid black;">
					first block
				</div>
				<div class="as-content-sm" style="border: thin solid black;">
					second block
				</div>
			</div>
		</div>
		<!-- Footer section -->
		<div class="as-footer">Attendance System 2021</div>
	</div>
</div>
</body>
</html>